<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'message',
    ];

    public function getFrom()
    {
        return User::where('id', $this->attributes['from_id'])->first()->email;
    }

    public function getToId()
    {
        return User::where('id', $this->attributes['to_id'])->first()->email;
    }
}
