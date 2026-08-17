<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    #To get the info of the sender
    public function sender(){
        return $this->belongsTo(User::class, 'sender_id')->withTrashed();
    }

    #To get the info of the receiver
    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id')->withTrashed();
    }
}
