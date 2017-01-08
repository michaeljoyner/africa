<?php


namespace App\Social;


trait IsSociable
{
    public function socialLinks()
    {
        return $this->morphMany(SocialLink::class, 'sociable');
    }

    public function socialLinkTo($platform)
    {
        if($this->hasSocialLinkFor($platform)) {
            return $this->socialLinks()->where('platform', $platform)->first()->url;
        }
    }

    public function addSocialLink($platform, $url)
    {
        return $this->socialLinks()->create([
            'platform' => $platform,
            'url' => $url
        ]);
    }

    public function setAllSocialLinks($links)
    {
        $this->deleteAllSocialLinks();

        collect($links)->each(function($url, $platform) {
            $this->addSocialLink($platform, $url);
        });
    }

    public function hasSocialLinkFor($platform)
    {
        return $this->socialLinks->pluck('platform')->contains($platform);
    }

    protected function deleteAllSocialLinks()
    {
        $this->socialLinks->each(function($link) {
            $link->delete();
        });
    }
}