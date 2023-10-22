<?php

namespace App\Post;
use App\Models\Listing;
use Illuminate\Support\Str;
class JobPost {

    protected $listing; 
    public function __construct(Listing $listing){
        $this->listing = $listing;
    }

    public function store($data){
        $imagePath = $data->file('feature_image')->store('images', 'public');
       $this->listing = new Listing;
       $this->listing->feature_image = $imagePath;
       $this->listing->user_id = auth()->user()->id;
       $this->listing->title = $data['title'];
       $this->listing->description = $data['description'];
       $this->listing->roles = $data['roles'];
       $this->listing->job_types = $data['job_type'];
       $this->listing->address = $data['address'];
       $this->listing->application_close_date = $data['date'];
       $this->listing->salary = $data['salary'];
       $this->listing->slug = Str::slug($data['title']).'.'.Str::uuid();
       $this->listing->save();
    }
}

?>