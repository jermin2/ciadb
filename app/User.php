<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'person_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function lastTenEvents()
    {
        if($this->events != null)
            $lastten = $this->events->sortByDesc(function ($obj)
        {
            return \Carbon\Carbon::createFromFormat('D, jS M H:i Y', $obj->time);
        });
            return $lastten->take(10);
        return null;
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'author_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        if(is_string($role)){
            $role = Role::whereName($role)->firstOrFail();
        }
        $this->roles()->sync($role, false);
    }

    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    public function goals()
    {
        return $this->hasMany(Goal::class, 'author_id');
    }

    public function hasPermission($permission)
    {
        if($this->roles->contains('name','admin')) return true;

        return $this->permissions()->contains($permission);
    }

    public function usertags()
    {
        return $this->hasMany(Usertag::class);
    }

}
