<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    public function listener()
    {
        return $this->belongsTo(User::class);
    }
    public function member()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
     return $this->hasMany(ChatMessage::class);
    }

    public function getUnreadAttribute()
    {
        $type = Auth::user()->type;
        $unreads = $this->messages()
            ->whereHas('user', function ($q) use ($type) {


                if ($type === 'listener') {
                    $q->where('type', 'member');
                }


                if ($type === 'member') {
                    $q->where('type', 'listener');
                }

            })
            ->whereNull('read_at')
            ->get();

        return $unreads;

    }

    public function getLatestAttribute()
    {
        return $this->messages()->orderByDesc('created_at')->first();
    }

    public function getUnreadCountAttribute()
    {
        return $this->getUnreadAttribute()->count();
    }
}
