<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRole_has_PermissionsRequest;
use App\Http\Requests\UpdateRole_has_PermissionsRequest;
use App\Repositories\Role_has_PermissionsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Role_has_PermissionsController extends AppBaseController
{
    /** @var  Role_has_PermissionsRepository */
    private $roleHasPermissionsRepository;

    public function __construct(Role_has_PermissionsRepository $roleHasPermissionsRepo)
    {
        $this->roleHasPermissionsRepository = $roleHasPermissionsRepo;
    }

    /**
     * Display a listing of the Role_has_Permissions.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roleHasPermissions = $this->roleHasPermissionsRepository->all();

        return view('role_has__permissions.index')
            ->with('roleHasPermissions', $roleHasPermissions);
    }

    /**
     * Show the form for creating a new Role_has_Permissions.
     *
     * @return Response
     */
    public function create()
    {
        return view('role_has__permissions.create');
    }

    /**
     * Store a newly created Role_has_Permissions in storage.
     *
     * @param CreateRole_has_PermissionsRequest $request
     *
     * @return Response
     */
    public function store(CreateRole_has_PermissionsRequest $request)
    {
        $input = $request->all();

        $roleHasPermissions = $this->roleHasPermissionsRepository->create($input);

        Flash::success('Role Has  Permissions saved successfully.');

        return redirect(route('roleHasPermissions.index'));
    }

    /**
     * Display the specified Role_has_Permissions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roleHasPermissions = $this->roleHasPermissionsRepository->find($id);

        if (empty($roleHasPermissions)) {
            Flash::error('Role Has  Permissions not found');

            return redirect(route('roleHasPermissions.index'));
        }

        return view('role_has__permissions.show')->with('roleHasPermissions', $roleHasPermissions);
    }

    /**
     * Show the form for editing the specified Role_has_Permissions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roleHasPermissions = $this->roleHasPermissionsRepository->find($id);

        if (empty($roleHasPermissions)) {
            Flash::error('Role Has  Permissions not found');

            return redirect(route('roleHasPermissions.index'));
        }

        return view('role_has__permissions.edit')->with('roleHasPermissions', $roleHasPermissions);
    }

    /**
     * Update the specified Role_has_Permissions in storage.
     *
     * @param int $id
     * @param UpdateRole_has_PermissionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRole_has_PermissionsRequest $request)
    {
        $roleHasPermissions = $this->roleHasPermissionsRepository->find($id);

        if (empty($roleHasPermissions)) {
            Flash::error('Role Has  Permissions not found');

            return redirect(route('roleHasPermissions.index'));
        }

        $roleHasPermissions = $this->roleHasPermissionsRepository->update($request->all(), $id);

        Flash::success('Role Has  Permissions updated successfully.');

        return redirect(route('roleHasPermissions.index'));
    }

    /**
     * Remove the specified Role_has_Permissions from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $roleHasPermissions = $this->roleHasPermissionsRepository->find($id);

        if (empty($roleHasPermissions)) {
            Flash::error('Role Has  Permissions not found');

            return redirect(route('roleHasPermissions.index'));
        }

        $this->roleHasPermissionsRepository->delete($id);

        Flash::success('Role Has  Permissions deleted successfully.');

        return redirect(route('roleHasPermissions.index'));
    }
}
