<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Profile extends Component
{
    public $oldPassword = '';
    #[Validate('required|min:8|confirmed')]
    public $password = '';
    public $password_confirmation = '';

    public $securityQuestion = '';

    public $securityAnswer = '';

    public $editMode = false;

    public function changePassword()
    {
        if (Hash::check($this->oldPassword, Auth::user()->password)) {
            $user = Auth::user();
            $this->validate();
            $user->update([
                'password' => $this->password,
            ]);
            $this->reset();
            session()->flash('success', 'Password Changed Successfully!');
        } else {
            $this->reset();
            session()->flash('error', 'Make sure the current password you entered is correct!');
        }
    }
    public function storeSecurityQuestionAndAnswer()
    {
        try {
            $user = Auth::user();
            $validatedData = $this->validate([
                'securityQuestion' => 'required|min:5',
                'securityAnswer' => 'required|min:1',
            ]);
            //dd($validatedData);
            $user->update([
                'securityQuestion' => $validatedData['securityQuestion'],
                'securityAnswer' => Hash::make($validatedData['securityAnswer']),
            ]);
            $this->reset();
            session()->flash('success', 'Security Q&A Saved Successfully!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Q&A not saved!!, some error occurred');
        }
    }
    public function editSecurityQuestionAndAnswer()
    {
        $this->editMode = !$this->editMode;
    }
    public function render()
    {
        if ($this->editMode) {
            $this->securityQuestion = null;
            $this->securityAnswer = null;
        } else {
            $user = Auth::user();
            $this->securityQuestion = $user->securityQuestion;
            $this->securityAnswer = $user->securityAnswer;
        }

        return view('livewire.profile');
    }
}
