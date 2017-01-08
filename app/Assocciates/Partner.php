<?php

namespace App\Assocciates;

use App\HasModelImage;
use App\Publishable;
use App\Social\IsSociable;
use App\Social\SocialLink;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Partner extends Model implements HasMediaConversions
{
    use Publishable, HasModelImage, HasMediaTrait, IsSociable;

    const DEFAULT_MODEL_IMAGE_SRC = '/images/defaults/default.jpeg';

    protected $table = 'partners';

    protected $fillable = ['name', 'writeup'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 300, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($partner) {
            $partner->socialLinks->each(function($link) {
                $link->delete();
            });
        });
    }
}
