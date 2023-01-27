<?php

namespace KLC\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string slug
 * @property Carbon created_at
 * @property Carbon updated_at
 * @mixin Builder
 */
class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name', 'slug'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}