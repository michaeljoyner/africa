<?php

namespace App\Expeditions;

use App\HasModelImage;
use App\Publishable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Expedition extends Model implements HasMediaConversions
{
    use Sluggable, Publishable, HasMediaTrait, HasModelImage;

    const DEFAULT_MODEL_IMAGE_SRC = '/images/defaults/default_banner.jpg';

    protected $table = 'expeditions';

    protected $fillable = [
        'name',
        'description',
        'writeup',
        'duration',
        'difficulty',
        'location',
        'capacity',
        'start_date'
    ];

    protected $casts = ['published' => 'boolean'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 400, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('banner')
            ->setManipulations(['w' => 1400, 'h' => 467, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
    }
}
