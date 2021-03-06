<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;

class RolesPermission extends Model
{
    protected $fillable = [
        'permission_id', 'role_id'
    ];

    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
