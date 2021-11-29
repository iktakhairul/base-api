<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\IndexRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleResourceCollection;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RoleResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $roles = $this->roleRepository->findBy($request->all());

        return new RoleResourceCollection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RoleResource
     */
    public function store(StoreRequest $request)
    {
        $role = $this->roleRepository->save($request->all());

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return null
     * @throws RoleResource
     */
    public function show($id)
    {
        $role = $this->roleRepository->findOne($id);
        if (!$role instanceof Role) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $role = $this->roleRepository->update($role, $request->all());

        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return null
     */
    public function destroy(Role $role)
    {
        $this->roleRepository->delete($role);

        return response()->json(null, 204);
    }
}
