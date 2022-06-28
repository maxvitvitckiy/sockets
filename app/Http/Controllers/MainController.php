<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('main', ['users' => $user->dialogs()->get()]);
    }

    public function dialog($id)
    {
        $messages = Auth::user()->getMessages($id);
        return view('dialog', ['messages'=>$messages, 'id'=>$id]);
    }

    public function sendMessage($id, Request $request)
    {
        $request->validate([
            'message'=>['required', 'string', 'min:1', 'max:500']
        ]);
        $message = $request->get('message');
        Message::create(['from_id'=>Auth::id(), 'to_id'=>$id, 'message'=>$message]);
        return redirect()->back();
    }

    public function newDialog()
    {
        $emails = User::where('id', '!=', Auth::user()->id)->pluck('email', 'id');
        return view('new', ["emails"=>$emails]);
    }

    public function createDialog(Request $request)
    {
        $email = $request->get("email");
        $messages = Auth::user()->getMessages($email);
        return redirect()->route('dialog', ['messages'=>$messages, 'id'=>$email]);
    }
}
