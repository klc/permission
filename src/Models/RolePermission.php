<?php

namespace KLC\Models;

use Illuminate\Database\Eloquent\Model;

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