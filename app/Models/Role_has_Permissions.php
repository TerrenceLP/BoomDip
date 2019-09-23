<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Role_has_Permissions
 * @package App\Models
 * @version September 17, 2019, 9:01 am UTC
 *
 * @property \App\Models\Permission permission
 * @property \App\Models\Role role
 * @property integer role_id
 */
class Role_has_Permissions extends Model
{

    public $table = 'role_has_permissions';

    public $timestamps = false;

    public $fillable = [
        'permission_id',
        'role_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'permission_id' => 'integer',
        'role_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permission_id' => 'required',
        'role_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function permission()
    {
        return $this->belongsTo(\App\Models\Permission::class, 'permission_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }
}
