<?php

namespace App\Models\Roles;

use App\Models\User;
use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function permissions() {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }


    public function scopeSelection($query, $val = 'name', $id = 'id')
    {
        $data = $query->addSelect([$id, $val])->get()->toArray();

        return (is_array($data) && count($data) )? array_combine(array_column($data, $id), array_column($data, $val))
            : array();
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
