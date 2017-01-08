<?php

namespace App\Social;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table = 'social_links';

    protected $fillable = ['platform', 'url'];

    public function sociable()
    {
        return $this->morphTo();
    }
}
