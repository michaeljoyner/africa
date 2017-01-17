<?php

namespace App\Blog;

use App\Events\PostFirstPublished;
use App\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Post extends Model implements HasMediaConversions
{
    use Sluggable, HasMediaTrait, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = ['title', 'description', 'body'];

    protected $dates = ['published_on', 'deleted_at'];

    protected $casts = ['published' => 'boolean'];

    protected $defaultTitleImages = [
        '/images/defaults/post1.jpg',
        '/images/defaults/post1.jpg'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => $this->hasNeverBeenPublished()
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
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setBody($body)
    {
        $this->body = $body;
        $this->save();

        return $this;
    }

    public function publish()
    {
        if($this->hasNeverBeenPublished()) {
            $this->published_on = Carbon::now();
            $this->save();
            event(new PostFirstPublished($this));
        }
        return $this->setPublishedStatus(true);
    }

    public function retract()
    {
        return $this->setPublishedStatus(false);
    }

    protected function setPublishedStatus($toPublish)
    {
        $this->published = $toPublish;
        $this->save();

        return $this->published;
    }

    public function hasNeverBeenPublished()
    {
        return $this->published_on === null;
    }

    public function addImage($image)
    {
        return $this->addMedia($image)->preservingOriginal()->toMediaLibrary();
    }

    public function setFeaturedImage(Media $image)
    {
        if ($this->doesNotOwnImage($image)) {
            throw new \Exception('Image must belong to post to be set as featured.');
        }
        $this->resetPreviousFeaturedToFalse();
        $image->setCustomProperty('is_feature', true);
        $image->save();
    }

    protected function doesNotOwnImage($image)
    {
        return ($image->model_type !== static::class) || (intval($image->model_id) !== $this->id);
    }

    protected function resetPreviousFeaturedToFalse()
    {
        $this->getMedia()->filter(function ($media) {
            return $media->getCustomProperty('is_feature');
        })->each(function ($media) {
            $media->setCustomProperty('is_feature', false);
            $media->save();
        });
    }

    public function featuredImage()
    {
        return $this->getMedia()->first(function ($media) {
            return $media->getCustomProperty('is_feature');
        });
    }

    public function titleImg($conversion = '')
    {
        $featured = $this->featuredImage();
        $titleImg = $featured ? $featured->getUrl($conversion) : $this->getFirstMediaUrl('default', $conversion);

        return $titleImg ?: collect($this->defaultTitleImages)->random();
    }
}
