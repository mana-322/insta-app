<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $message;
    private $user;

    public function __construct(Message $message, User $user){
        $this->message = $message;
        $this->user = $user;
    }

    #show the list of users the AUTH user has exchanged messages with
    public function index(){
        $partner_ids = [];

        foreach (Auth::user()->sentMessages as $sent) {
            $partner_ids[$sent->receiver_id] = true;
        }

        foreach (Auth::user()->receivedMessages as $received) {
            $partner_ids[$received->sender_id] = true;
        }

        $partners = $this->user->whereIn('id', array_keys($partner_ids))->get();

        return view('users.messages.index')->with('partners', $partners);
    }

    #show the conversation between the AUTH user and another user
    public function show($user_id){
        $partner = $this->user->findOrFail($user_id);

        $messages = $this->message
            ->where(function($query) use ($user_id){
                $query->where('sender_id', Auth::user()->id)->where('receiver_id', $user_id);
            })
            ->orWhere(function($query) use ($user_id){
                $query->where('sender_id', $user_id)->where('receiver_id', Auth::user()->id);
            })
            ->oldest()
            ->get();

        return view('users.messages.show')->with('partner', $partner)->with('messages', $messages);
    }

    #store a new message to database
    public function store(Request $request, $user_id){
        $request->validate([
            'body' => 'required|max:150'
        ], [
            'body.required' => 'You cannot send an empty message.',
            'body.max' => 'Your message must not have more than 150 characters.'
        ]);

        $this->message->body = $request->input('body');
        $this->message->sender_id = Auth::user()->id;
        $this->message->receiver_id = $user_id;
        $this->message->save();

        return redirect()->route('message.show', $user_id);
    }
}
