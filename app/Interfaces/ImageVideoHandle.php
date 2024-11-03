<?php

namespace App\Interfaces;
use Illuminate\Support\Facades\File;


class ImageVideoHandle
{
    public function storeImgVid($img,$file)
    {
        $image = $img;
        $imageName = time().'_'. str_replace(' ','_', pathinfo($image->getClientOriginalName(),PATHINFO_FILENAME) .'.'. $image->getClientOriginalExtension());
        $dest = public_path('storage/images/'. $file);
        $image->move($dest,$imageName);
        $name = 'storage/images/'. $file .'/'. $imageName;
        return $name;
    }

    public function deleteImgVid($img_data) 
    {
        if(File::exists(public_path().$img_data))
        {
            File::delete(public_path().$img_data);
        }
    }

    public function UpdateImgVid($img,$file,$img_data)
    {
        if(File::exists(public_path().$img_data))
        {
            File::delete(public_path().$img_data);
        }

        $image = $img;
        $imageName = time().'.'. $image->getClientOriginalExtension();
        $dest = public_path('storage/images/'. $file);
        $image->move($dest,$imageName);
        $name = 'storage/images/'. $file .'/'. $imageName;
        return $name;
    }

}