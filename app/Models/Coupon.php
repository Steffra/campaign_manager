<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function activate(){
        $this->is_activated = true;
        $this->save();
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
