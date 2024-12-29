<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function chatRequests()
    {
        return $this->morphedByMany(ChatRequest::class, 'subjectable');
    }
}
