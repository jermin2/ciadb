<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function allowTo($permission)
    {
        if(is_string($permission)){
            $permission = Permission::whereName($permission)->firstOrFail();
        }
        $this->permissions()->sync($permission, false);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
