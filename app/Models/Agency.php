<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    public function AgencyUsers()
    {
        return $this->belongsToMany(AgencyUser::class, 'agency_user_agencies', 'user_id', 'agency_id');
    }
}
