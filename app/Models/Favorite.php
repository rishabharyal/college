<?php

namespace App\Models;

use App\Models\College;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function college() {
    	return $this->belongsTo(College::class);
    }
}
