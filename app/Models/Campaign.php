<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function activate(){
        $this->is_active = true;
        $this->save();
    }

    public function inactivate(){
        $this->is_active = false;
        $this->save();
    }

    public function approve(){
        $this->approved = true;
        $this->save();
    }

    public function disapprove(){
        $this->approved = false;
        $this->is_active = false;
        $this->save();
    }

}
