<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use File;

class Photo extends Model
{

    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    protected $baseDir = 'images/photos';

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public static function named($name)
    {
        return (new static)->saveAs($name);
    }


    public function saveAs($name)
    {
        $this->name = sprintf('%s-%s', time(), $name);
        $this->path = sprintf('%s/%s', $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf('%s/tn-%s', $this->baseDir, $this->name);

        return $this;
    }

    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;
    }

    public function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(150)
            ->save($this->thumbnail_path);
    }


    public function delete()
    {
        File::delete([
            $this->path,
            $this->thumbnail,
        ]);
        parent::delete();
    }
}
