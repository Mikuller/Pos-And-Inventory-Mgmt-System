<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Laravel\Prompts\error;

class ForgetPassword extends Component
{
    public $securityVerificationSession = false;
    public $passwordChangeSession = false;
    public $securityQuestion = '';
    public $securityAnswer = '';

    public $email;
    public $user = null;

    #[Validate('required|min:8|confirmed')]
    public $password = '';
    public $password_confirmation = '';

    public function getSecurityInfo()
    {
        $this->user = User::where('email', $this->email)->first();
        if ($this->user != null) {
            $this->securityQuestion = $this->user->securityQuestion;
            $this->securityVerificationSession = true;
        } else {
            $this->addError('email', 'User not found with the email entered.');
        }
        $this->reset('email');
    }
    public function changePassword(){
       
           try {
            $this->validate();
            $this->user->update([
                'password' => $this->password,
            ]);
           
            session()->flash('success', 'Password Changed Successfully!');
            $this->redirect('/login');
           } catch (\Throwable $th) {
            session()->flash('error', 'Error, Password not Changed');

           }
           
        
    }
    public function verify_QA()
    {
        
        if ($this->user != null) {
            if (Hash::check($this->securityAnswer, $this->user->securityAnswer)) {
                $this->passwordChangeSession = true;
                $this->securityVerificationSession = false;
            } else {
                $this->addError('securityAnswer', 'Security Answer is not correct, Please contact your Admin');
            }
        } 
        
    }
    public function goBack()
    {
        $this->securityVerificationSession = false;
    }
    public function render()
    {
        return view('livewire.forget-password');
    }
}
