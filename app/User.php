<?php

namespace App;

use App\Blog\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        if( ! empty($password)) {
            return $this->attributes['password'] = bcrypt($password);
        }
    }

    public function resetPassword($newPassword)
    {
        $this->password = $newPassword;
        $this->save();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function createPost($title, $description = null)
    {
        return $this->posts()->create(['title' => $title, 'description' => $description]);
    }
}
