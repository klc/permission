<?php

namespace KLC\Models;

use Illuminate\Database\Eloquent\Model;
use KLC\Permission\Models\Permission;
use KLC\Permission\Models\Role;

class RolePermission extends Model
{
    protected $table = 'role_permission';
    protected $fillable = ['role_id', 'permission_id'];
    protected $primaryKey = false;
    public $incrementing = false;
    public $timestamps = false;

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}