<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dialogs()
    {
        $messages_from = Message::query()->where('from_id', $this->id)->select('to_id')->distinct()->pluck('to_id');
        $messages_to = Message::query()->where('to_id', $this->id)->whereNotIn('to_id', $messages_from)->whereNotIn('from_id', $messages_from)->select('from_id')->distinct();
        return User::query()->whereIn('id', $messages_from)->orWhereIn('id', $messages_to)->distinct();
    }

    public function getMessages($id)
    {
        return Message::query()->where(function($q) use($id) {
           $q->where('from_id', $id)->where('to_id', $this->id);
        })->orWhere(function($q) use($id) {
            $q->where('to_id', $id)->where('from_id', $this->id);
        })->orderByDesc('created_at')->get();
//        return Message::query()->where('from_id', $this->id)->select('from_id')->distinct();
//        return Message::where('from_id', $this->id)->orWhere('to_id', $this->id);
    }
}
