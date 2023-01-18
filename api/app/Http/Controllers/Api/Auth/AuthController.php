<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;

/**
 *
 */
class AuthController extends Controller
{

    /**
     * @param AuthRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function auth(AuthRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['O e-mail e/ou senha não conferem.'],
            ]);
        }

        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout realizado com sucesso.'
        ]);
    }

    /**
     * @return UserResource
     */
    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
