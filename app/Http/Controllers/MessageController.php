<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {   
        return view('messages.index');
    }

    public function show(Message $message){

        if ($message->status == 'unread') {
            $message->update([
                'status' => 'read'
            ]);
        }
       
        session(['message'=>$message]);
        return redirect()->route('message.index');
           
    }
    public function destroy(Message $message){

        $message->delete();
        return redirect()
        ->back()
        ->with('success', 'Message is Deleted, successfully');
    }
}
