<?php 

namespace App\Common;

use App\Models\Image;
use Illuminate\Support\Facades\File;

trait HasImage
{
    public function imageable()
    {
        return $this->morphTo();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function hasImage()
    {
        return (bool) $this->image()->count();
    }

    public function saveImage($request)
    {
        $path = public_path('tmp/uploads');

        if ( ! File::exists($path) ) {
            mkdir($path, 0777, true);
        }

        return $this->createOrUpdateImage($request,$path);
    }

    private function createOrUpdateImage($request,$path)
    {   
        if(! $request->has('image') ) {
           return $this;
        }

        $file = $request->file('image');
        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());

        if($this->hasImage()) {
           
            if(File::exists(public_path('tmp/uploads/'. $this->image->image))){
                File::delete(public_path('tmp/uploads/'. $this->image->image));
            }

            $file->move($path, $fileName);

            return $this->image()->update([
                'image' => $fileName
            ]);
        }
        
        $file->move($path, $fileName);

        return $this->image()->create([
            'image' => $fileName
        ]);
    }

}