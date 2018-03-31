<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $upload = '/images/';
    protected $fillable = ['path', 'car_id'];

    /**
     * @param $photo
     * @return string
     */
    public function getPathAttribute($photo) {
        return $this->upload . $photo;
    }

    /**
     * Uploading photo to server and update in DB
     * @param $file
     * @param $newName
     * @return $photo_id
     */
    public function photoUpload($file, $newName, $car_id){

        $name = uniqid($newName) . '.' . $file->getClientOriginalExtension();
        $file->move('images', $name);
        $car_id = isset($car_id) ? $car_id : '0';

        $photo = Photo::create(['path'=>$name, 'car_id'=>$car_id]);

        return $photo->id;
    }

    /**
     * returning if the picture is used for user or for post or else
     * @return string
     */
    public function photoSource() {
        $result = explode('/images/',$this->path);
        $result = explode('_',$result[1]);
        if(empty($result[0])) $result[0] = 'none';

        return $result[0];
    }

}
