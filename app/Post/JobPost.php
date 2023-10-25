<?php

namespace App\Post;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class JobPost {

    protected $listing; 
    public function __construct(Listing $listing){
        $this->listing = $listing;
    }

    public function getImagePath(Request $data){
        return $data->file('feature_image')->store('images', 'public');
    }

    public function store(Request $data){
        $imagePath = $this->getImagePath($data);
  
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


    public function updatePost(int $id, Request $data){
        if ($data->hasFile('feature_image')) {
            # code...
      #      $featureImage = $data->file('feature_image')->store('images', 'public');
            $this->listing->find($id)->update(['feature_image' => $this->getImagePath($data)]);
        }
        $this->listing->find($id)->update($data->except('feature_image'));

    }
}

?>