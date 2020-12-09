<?php

namespace App\Models;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    public function affiliation() {
    	return $this->faculty->affiliation();
    }

    public function level() {
    	return $this->belongsTo(Level::class);
    }

    public function faculty() {
    	return $this->belongsTo(Faculty::class);
    }

    public function students() {
        return $this
            ->belongsToMany(User::class, 'user_colleges')
            ->withPivot(['user_id', 'college_id', 'is_verified', 'id', 'updated_at', 'faculty_id', 'verification_document']);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }
}
