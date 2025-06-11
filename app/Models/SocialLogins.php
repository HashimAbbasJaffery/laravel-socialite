<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLogins extends Model
{
    use HasFactory;

    protected $table = "socialises";
    protected $guarded = [ "id", "created_at", "updated_at" ];
}
