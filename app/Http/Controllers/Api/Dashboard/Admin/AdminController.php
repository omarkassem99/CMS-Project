<?php

namespace App\Http\Controllers\Api\Dashboard\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Admin\AdminRequest;
use App\Http\Requests\Dashboard\Admin\LoginAdminRequest;
use App\Http\Requests\Dashboard\Admin\PasswordAdminRequest;
use App\Http\Requests\Dashboard\Admin\UpdateAdminRequest;
use App\Repository\Dashboard\Admin\AdminRepo;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    protected $AdminRepo;

    public function __construct(AdminRepo $AdminRepo)
    {
        $this->AdminRepo = $AdminRepo;
    }

     /**
     * @OA\Post(
     *     path="/admin/newAdmin",
     *     summary="Create a new admin",
     *     tags={"Admin"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", description="Admin name"),
     *                 @OA\Property(property="email", type="string", description="Admin email"),
     *                 @OA\Property(property="country_code", type="string"),
     *                 @OA\Property(property="phone", type="string", description="Admin phone number"),
     *                 @OA\Property(property="image", type="string", format="binary", description="Admin profile image"),
     *                 @OA\Property(property="password", type="string", description="Admin password")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Admin created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Admin created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="object", example="Validation error message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Unauthorized access")
     *         )
     *     )
     * )
     */

    public function store(AdminRequest $request)
    {
        return $this->AdminRepo->store($request);
    }

    /**
     * @OA\Post(
     *    path="/admin/login",
     *    summary="Admin login",
     *    description="Admin login using either email or phone and password",
     *    tags={"Admin"},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="email", type="string", format="email", description="Admin email"),
     *              @OA\Property(property="phone", type="string", format="digits", description="Admin phone number"),
     *              @OA\Property(property="password", type="string", format="password", description="Admin password")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Login successful",
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

    public function login(LoginAdminRequest $request)
    {
        return $this->AdminRepo->login($request);
    }
 /**
 * @OA\Post(
 *     path="/admin/update",
 *     tags={"Admin"},
 *     summary="Update Admin details",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *            mediaType="multipart/form-data",
 *            @OA\Schema(
 *                type="object",
 *                @OA\Property(property="_method", type="string", default="PUT"),
 *                @OA\Property(property="name", type="string", description="Admin name"),
 *                @OA\Property(property="email", type="string", format="email", description="Admin email"),
 *                @OA\Property(property="country_code", type="string"),
 *                @OA\Property(property="phone", type="string", format="digits", description="Admin phone number"),
 *                @OA\Property(property="image", type="string", format="binary", description="Profile image")
 *            )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Admin updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Admin updated successfully"),
 *             @OA\Property(property="admin", type="object")
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
 *  )
 */
    public function update(UpdateAdminRequest $request)
    {
        return $this->AdminRepo->update($request);
    }
     /**
     * @OA\Get(
     *    path="/admin/show",
     *    summary="Show admin details",
     *    description="Get Admin Profile",
     *    tags={"Admin"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(
     *       response=200,
     *       description="Admin details retrieved",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="name", type="string"),
     *           @OA\Property(property="email", type="string"),
     *           @OA\Property(property="phone", type="string")
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized")
     *       )
     *    )
     * )
     */

    public function show()
    {
        return $this->AdminRepo->show();
    }

    /**
     * @OA\Post(
     *    path="/admin/logout",
     *    summary="Logout admin",
     *    description="Log out",
     *    tags={"Admin"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(
     *       response=200,
     *       description="Admin logged out",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Admin logged out successfully")
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized")
     *       )
     *    )
     * )
     */

    public function logout()
    {
        return $this->AdminRepo->logout();
    }

     /**
     * @OA\Post(
     *    path="/admin/change_password",
     *    summary="Change admin password",
     *    description="Allows the admin to change their password",
     *    tags={"Admin"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          @OA\Property(property="_method", type="string", default="PUT"),
     *          @OA\Property(property="current_password", type="string", description="Current password"),
     *          @OA\Property(property="new_password", type="string", format="password", description="New password"),
     *          @OA\Property(property="new_password_confirmation", type="string", format="password", description="Confirm new password")
     *       )
     *      )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Password changed successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Password changed successfully")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Failed to change password",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Password change failed")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"new_password": "The new password confirmation does not match"})
     *       )
     *    )
     * )
     */

    public function change_password(PasswordAdminRequest $request)
    {
        return $this->AdminRepo->change_password($request);
    }

    /**
 * @OA\Get(
 *     path="/admin/insertAdmin",
 *     summary="Create a new admin",
 *     description="This endpoint creates a new admin with a hashed password.",
 *     operationId="insertAdmin",
 *     tags={"Admin"},
 *     @OA\Response(
 *         response=200,
 *         description="Admin created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Admin created successfully")
 *         )
 *     )
 * )
 */

    public function insertAdmin()
    {
        return $this->AdminRepo->insertAdmin();
    }



}
