<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class LoginController extends Controller
{
    public $userRepository;

    /**
     * LoginController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Login using email and password
     *
     * @param LoginRequest $request
     * @return Response
     */
    public function index(LoginRequest $request)
    {
        $user = $this->userRepository->findOneBy(['email' => $request->get('email')]);

        if ($user instanceof User) {
            if (Hash::check($request->get('password'), $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client');
                return response(['access_token' => $token], 200);
            }else {
                return response(['message' => 'Password mismatch or invalid user.'], 422);
            }
        }else {
            return response(['message' => 'User doesn\'t exist.'], 422);
        }
    }

    /**
     * Logout a user from current device - sanctum guard.
     *
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        try {
            $user = \auth()->guard('sanctum')->user();
            if (!empty($user) && !$user instanceof User) {
                throw new AccessDeniedHttpException();
            }
            if ($user['email'] === $request['email']) {
                auth('sanctum')->user()->currentAccessToken()->delete();
                return response('Successfully logged out', 200);
            }
        }catch (\Exception $exception) {
            return response(['message' => 'Already logged out'], 200);
        }
    }

    /**
     * Logout a user from all devices - sanctum guard.
     *
     * @param Request $request
     * @return mixed
     */
    public function logout_from_all(Request $request)
    {
        try {
            $user = \auth()->guard('sanctum')->user();
            if (!empty($user) && !$user instanceof User) {
                throw new AccessDeniedHttpException();
            }
            if ($user['email'] === $request['email']) {
                auth('sanctum')->user()->tokens()->delete();
                return response('Successfully logged out', 200);
            }
        }catch (\Exception $exception) {
            return response(['message' => 'Already logged out'], 200);
        }
    }
}
