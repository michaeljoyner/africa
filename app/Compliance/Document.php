<?php

namespace App\Compliance;

use App\Publishable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use Publishable;

    protected $table = 'documents';

    protected $fillable = ['title'];

    protected $casts = ['published' => 'boolean'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($doc) {
            $doc->clearFile();
        });
    }

    public function hasFile()
    {
        return Storage::disk('compliance')->exists($this->path);
    }

    public function setFile(UploadedFile $file)
    {
        $this->clearFile();
        $this->path = $file->store(null, 'compliance');
        $this->save();
    }

    protected function clearFile()
    {
        if($this->hasFile()) {
            unlink($this->fullPath());
        }
    }

    public function fullPath()
    {
        $storagePath = Storage::disk('compliance')->getDriver()->getAdapter()->getPathPrefix();
        return $storagePath . $this->path;
    }

    /**
     *@test
     */
    public function url()
    {
        return mb_substr($this->fullPath(), mb_stripos($this->fullPath(), 'public/') + 6);
    }
}
