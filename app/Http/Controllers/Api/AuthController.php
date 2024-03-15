<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (!auth()->attempt($credentials))
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken(env('APP_KEY'))->accessToken;


            return $this->sendResponse([
                'user' => UserResource::make($user),
                'token' => $token,
            ], "Login Success");
        } catch (ValidationException $e) {
            return $this->sendError("Validation Error", $e->errors());
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->sendError("Internal Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
