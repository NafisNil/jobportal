<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;
class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_id', 'description', 'roles', 'job_types','address','salary','application_close_date', 'feature_image', 'slug'];
    public function users(){
        return $this->belongsToMany(User::class, 'listing_user', 'listing_id', 'user_id')->withPivot('shortlisted')->withTimestamps();
    }
}
