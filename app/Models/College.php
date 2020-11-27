<?php

namespace App\Models;

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
}
