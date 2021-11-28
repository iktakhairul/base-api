<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRole\IndexRequest;
use App\Http\Resources\RoleResourceCollection;
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
        $userRoles = $this->roleRepository->findBy($request->all());

        return new RoleResourceCollection($userRoles);
    }
}
