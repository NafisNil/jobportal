<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_id', 'description', 'roles', 'job_types','address','salary','application_close_date', 'feature_image', 'slug'];
}
