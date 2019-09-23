<?php

namespace App\Repositories;

use App\Models\Role_has_Permissions;
use App\Repositories\BaseRepository;

/**
 * Class Role_has_PermissionsRepository
 * @package App\Repositories
 * @version September 17, 2019, 9:01 am UTC
*/

class Role_has_PermissionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role_has_Permissions::class;
    }
}
