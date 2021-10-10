<?php

namespace App\Models;

use Database\Seeders\CampaignsTableSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function publicate(){
        $this->is_publicated = true;
        $this->save();
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }


}
