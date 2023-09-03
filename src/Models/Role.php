<?php

namespace KLC\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

/**
 * @property int id
 * @property string name
 * @property string slug
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection permissions
 * @mixin Builder
 */
class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'slug'];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function users()
    {
        return $this->belongsToMany(Config::get('auth.providers.users.model'), 'user_role');
    }
}