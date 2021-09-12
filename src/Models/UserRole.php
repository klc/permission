<?php

namespace KLC\Permission\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property int role_id
 * @mixin Builder
 */
class UserRole extends Model
{
    protected $table = 'user_role';
    protected $fillable = ['user_id', 'role_id'];
    protected $primaryKey = false;
    public $incrementing = false;
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}