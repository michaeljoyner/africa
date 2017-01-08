<?php


namespace App;


trait Publishable
{
    public function publish()
    {
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
}