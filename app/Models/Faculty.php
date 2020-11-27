<?php

namespace App\Models;

use App\Models\Affiliation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    public function affiliation() {
    	return $this->belongsTo(Affiliation::class);
    }
}
