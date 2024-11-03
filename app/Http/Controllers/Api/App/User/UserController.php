<?php

namespace App\Http\Controllers\Api\App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\User\AuthRequest;
use App\Http\Requests\Application\User\LoginRequest;
use App\Http\Requests\Application\User\PasswordRequest;
use App\Http\Requests\Application\User\UpdateUserRequest;
use App\Repository\App\User\UserRepo;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
    protected $UserRepo;

    public function __construct(UserRepo $UserRepo)
    {
        $this->UserRepo = $UserRepo;
    }

    /**
     * @OA\Post(
     *    path="/api/register",
     *    summary="Register a new user",
     *    description="Registers a new user and returns an access token",
     *    tags={"User"},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="country_code", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="password", type="string", format="password"),
     *              @OA\Property(property="password_confirmation", type="string", format="password"),
     *              @OA\Property(property="image", type="string", format="binary")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="User created successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="user", type="object"),
     *           @OA\Property(property="token", type="string")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Validation Error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Validation error message")
     *       )
     *    )
     * )
     */
    public function register(AuthRequest $request)
    {
        return $this->UserRepo->register($request);
    }


    /**
     * @OA\Post(
     *    path="/api/login",
     *    summary="User login",
     *    description="User login using either email or phone and password",
     *    tags={"User"},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="email", type="string", format="email", description="User email"),
     *              @OA\Property(property="phone", type="string", format="digits", description="User phone number"),
     *              @OA\Property(property="password", type="string", format="password", description="User password")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Logged In successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="token", type="string")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Login failed, invalid credentials",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Your Login Is Incorrect")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation failed",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"email": "Please enter either email or phone"})
     *       )
     *    )
     * )
     */

        
    public function login(LoginRequest $request)
    {
        return $this->UserRepo->login($request);
    }

    /**
     * @OA\Post(
     *     path="/api/update",
     *     tags={"User"},
     *     summary="Update user details",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                type="object",
     *                @OA\Property(property="_method", type="string", default="PUT"),
     *                @OA\Property(property="name", type="string"),
     *                @OA\Property(property="email", type="string", format="email"),
     *                @OA\Property(property="country_code", type="string" ),
     *                @OA\Property(property="phone", type="string"),
     *                @OA\Property(property="image", type="string", format="binary", description="Profile image")
     *            )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User Updated in successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user", type="object"),
     *         )
     *     ),
     *    @OA\Response(
     *         response=400,
     *         description="Update Failed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Validation error message")
     *         )
     *      )
     * )
     */
    public function update(UpdateUserRequest $request)
    {
        return $this->UserRepo->update($request);
    }

    /**
     * @OA\Get(
     *     path="/api/profile",
     *     tags={"User"},
     *     summary="Get user profile",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User profile data",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="image", type="string", format="binary")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function profile()
    {
        return $this->UserRepo->profile();
    }


    /**
     * @OA\Post(
     *     path="/api/change_password",
     *     tags={"User"},
     *     summary="Change user password",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *                type="object",
     *                @OA\Property(property="_method", type="string", default="PUT"),
     *                @OA\Property(property="current_password", type="string", format="password", description="Current password"),
     *                @OA\Property(property="new_password", type="string", format="password", description="New password"),
     *                @OA\Property(property="new_password_confirmation", type="string", format="password", description="New password confirmation")
     *            )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(),
     *     ),
     *    @OA\Response(
     *         response=400,
     *         description="Change Password Failed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Validation error message")
     *         )
     * )
     * )
     */
    public function change_password(PasswordRequest $request)
    {
        return $this->UserRepo->change_password($request);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"User"},
     *     summary="Log out user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User logged out successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User logged out successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function logout()
    {
        return $this->UserRepo->logout();
    }
}
