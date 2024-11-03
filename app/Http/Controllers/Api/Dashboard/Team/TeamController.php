<?php

namespace App\Http\Controllers\Api\Dashboard\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Team\TeamRequest;
use App\Repository\Dashboard\Team\TeamRepo;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $TeamRepo;

    public function __construct(TeamRepo $TeamRepo)
    {
        $this->TeamRepo = $TeamRepo;
    }
     /**
     * @OA\Get(
     *     path="/admin/teams",
     *     summary="Get a list of team members",
     *     tags={"Team"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="A list of team members",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="position", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="phone", type="string"),
     *                 @OA\Property(property="birth_date", type="string", format="date"),
     *                 @OA\Property(property="gender", type="string"),
     *                 @OA\Property(property="hire_date", type="string", format="date"),
     *                 @OA\Property(property="status", type="string"),
     *                 @OA\Property(property="salary", type="number", format="float")
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    )
     * )
     */
    public function index()
    {
        return $this->TeamRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

     /**
     * @OA\Post(
     *     path="/admin/teams",
     *     summary="Store a new team member",
     *     tags={"Team"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *          mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", description="Name of the team member"),
     *                 @OA\Property(property="position", type="string", description="Position of the team member"),
     *                 @OA\Property(property="email", type="string", description="Email of the team member"),
     *                 @OA\Property(property="country_code", type="string"),
     *                 @OA\Property(property="phone", type="string", description="Phone number of the team member"),
     *                 @OA\Property(property="birth_date", type="string", format="date", description="Birth date of the team member"),
     *                 @OA\Property(property="gender", type="string", description="Gender of the team member"),
     *                 @OA\Property(property="image", type="string",format="binary", description="Profile image of the team member"),
     *                 @OA\Property(property="hire_date", type="string", format="date", description="Hire date of the team member"),
     *                 @OA\Property(property="status", type="string", description="Status of the team member"),
     *                 @OA\Property(property="salary", type="number", format="float", description="Salary of the team member")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Team member created successfully",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Team member created successfully"))
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(@OA\Property(property="errors", type="object", example={"name": "Please Enter Team Member Name"}))
     *     ),
     *      @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    )
     * 
     * )
     */
    public function store(TeamRequest $request)
    {
        return $this->TeamRepo->store($request);
    }

    /**
     * @OA\Get(
     *     path="/admin/teams/{id}",
     *     summary="Get a specific team member",
     *     tags={"Team"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the team member to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details of the team member",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="image", type="string",format="binary"),
     *             @OA\Property(property="position", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="birth_date", type="string", format="date"),
     *             @OA\Property(property="gender", type="string"),
     *             @OA\Property(property="hire_date", type="string", format="date"),
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="salary", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Team member not found",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Team member not found"))
     *     ),
     *      @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    )
     * )
     */
    public function show($id)
    {
        return $this->TeamRepo->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

   /**
     * @OA\Post(
     *     path="/admin/teams/{id}",
     *     summary="Update a team member",
     *     tags={"Team"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the team member to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *          mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="_method", type="string", default="PUT"),
     *                 @OA\Property(property="name", type="string", description="Name of the team member"),
     *                 @OA\Property(property="position", type="string", description="Position of the team member"),
     *                 @OA\Property(property="email", type="string", description="Email of the team member"),
     *                 @OA\Property(property="country_code", type="string", description="country code", example="+20"),
     *                 @OA\Property(property="phone", type="string", description="Phone number of the team member"),
     *                 @OA\Property(property="birth_date", type="string", format="date", description="Birth date of the team member"),
     *                 @OA\Property(property="gender", type="string", description="Gender of the team member"),
     *                 @OA\Property(property="image", type="string",format="binary", description="Profile image of the team member"),
     *                 @OA\Property(property="hire_date", type="string", format="date", description="Hire date of the team member"),
     *                 @OA\Property(property="status", type="string", description="Status of the team member"),
     *                 @OA\Property(property="salary", type="number", format="float", description="Salary of the team member")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Team member updated successfully",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Team member updated successfully"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Team member not found",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Team member not found"))
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(@OA\Property(property="errors", type="object", example={"name": "Please Enter Team Member Name"}))
     *     ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    )
     * 
     * )
     */
    public function update(TeamRequest $request, $id)
    {
        return $this->TeamRepo->update($request,$id);
    }

     /**
     * @OA\Delete(
     *     path="/admin/teams/{id}",
     *     summary="Delete a team member",
     *     tags={"Team"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the team member to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Team member deleted successfully",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Team member deleted successfully"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Team member not found",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Team member not found"))
     *     ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    )
     * )
     */
    public function destroy($id)
    {
        return $this->TeamRepo->delete($id);
    }

}