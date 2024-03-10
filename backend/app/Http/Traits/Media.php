<?php

namespace App\Http\Traits;

trait Media {
    public function upload_photo($img, $dir)
{
    if ($img) {
        $image = now()->timestamp. '.'. $img->getClientOriginalExtension();
        $img->move(public_path("/$dir/"), $image);
        return "/products/" . $image;
    }
    return null; // or handle the case where no file is uploaded
}
    public function delete_photo($photo_path, $old_img)
    {
        if(file_exists($photo_path))
        {
            if($old_img != null){
                unlink($photo_path);
            }
            
        }
    }
}