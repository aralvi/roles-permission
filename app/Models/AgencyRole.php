<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyRole extends Model
{
    use HasFactory;
    public function Agencies()
    {
        return $this->belongsTo(Agency::class);
    }
}
