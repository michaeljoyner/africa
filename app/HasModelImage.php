<?php


namespace App;


trait HasModelImage
{
    public function modelImage($conversion = '')
    {
        $src = $this->getFirstMediaUrl('default', $conversion);

        return $src ?: static::DEFAULT_MODEL_IMAGE_SRC ?? null;
    }

    public function setImage($image)
    {
        $newImage = $this->addMedia($image)->preservingOriginal()->toMediaLibrary();
        $this->removeOlderImages();

        return $newImage;
    }

    protected function removeOlderImages()
    {
        $this->getMedia()->reverse()->slice(1)->each(function ($media) {
            $media->delete();
        });
    }

    public function hasModelImageSet()
    {
        return !!$this->getFirstMediaUrl();
    }
}