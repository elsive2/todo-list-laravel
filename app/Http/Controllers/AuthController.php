<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
    ) {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function login(Request $request): JsonResponse
    {
        $response = $this->authService->login($request->get('email'), $request->get('password'));

        return response()->json($response->toArray());
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $response = $this->authService->refresh();

        return response()->json($response->toArray());
    }
}
