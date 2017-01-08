<?php

namespace App\Gallery;

use App\HasModelImage;
use App\Publishable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Album extends Model implements HasMediaConversions
{
    use Publishable, HasMediaTrait, HasModelImage;

    const DEFAULT_MODEL_IMAGE_SRC = '/images/defaults/default.jpeg';

    protected $table = 'albums';

    protected $fillable = ['title'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 300, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('large')
            ->setManipulations(['w' => 1400, 'h' => 800, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($album) {
            $album->getGallery()->delete();
        });
    }

    public function gallery()
    {
        return $this->hasOne(\App\Gallery\Gallery::class, 'album_id');
    }

    public function getGallery()
    {
        return $this->gallery()->firstOrCreate([]);
    }

    public function addGalleryImage($image)
    {
        return $this->getGallery()->addMedia($image)->preservingOriginal()->toMediaLibrary();
    }

    public function galleryImages($withMain = true)
    {
        if($withMain) {
            return $this->getMedia()->merge($this->getGallery()->getMedia());
        }

        return $this->getGallery()->getMedia();
    }
}
