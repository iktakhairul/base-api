<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\JsonResponse;
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
     * @param Request $request
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
                return response(['message' => 'Password mismatch or not an admin user.'], 422);
            }
        }else {
            return response(['message' => 'User doesn\'t exist.'], 422);
        }
    }

    /**
     * Logout a user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $user = \auth()->guard('api')->user();
            if (!$user instanceof User) {
                throw new AccessDeniedHttpException();
            }
            $user->token()->revoke();

            return response('Successfully logged out', 200);
        }catch (\Exception $exception) {
            return response(['message' => 'Already logged out'], 200);
        }
    }
}
