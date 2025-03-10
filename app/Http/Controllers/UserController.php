<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): UserResource
    {
        $data = $request->validated();

        if (User::where('username', $data['username'])->exists()) {
            throw new HttpResponseException(response()->json(['message' => 'Username already exists'], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return new UserResource($user);
    }
}
