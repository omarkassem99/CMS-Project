<?php

namespace App\Http\Controllers\Api\Dashboard\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Project\ProjectRequest;
use App\Repository\Dashboard\Project\ProjectRepo;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $ProjectRepo;

    public function __construct(ProjectRepo $ProjectRepo)
    {
        $this->ProjectRepo = $ProjectRepo;
    }
    
    /**
     * @OA\Get(
     *    path="/admin/projects",
     *    summary="Get list of projects",
     *    description="Retrieve a list of all projects",
     *    tags={"Project"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(
     *       response=200,
     *       description="List of projects",
     *       @OA\JsonContent(type="array",
     *           @OA\Items(
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="desc", type="string"),
     *               @OA\Property(property="client_id", type="integer"),
     *               @OA\Property(property="status", type="string"),
     *           )
     *       )
     *    ),
     *    @OA\Response(
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
        return $this->ProjectRepo->index();
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
     *    path="/admin/projects",
     *    summary="Create a new project",
     *    description="Add a new project ",
     *    tags={"Project"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="name", type="string", description="Project name"),
     *              @OA\Property(property="desc", type="string", description="Project description"),
     *              @OA\Property(property="client_id", type="integer", description="ID of the client"),
     *              @OA\Property(property="status", type="string", description="Project status"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=201,
     *       description="Project created successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Project created successfully")
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Project Name"})
     *       )
     *    )
     * )
     */
    public function store(ProjectRequest $request)
    {
        return $this->ProjectRepo->store($request);
    }

     /**
     * @OA\Get(
     *    path="/admin/projects/{id}",
     *    summary="Get a project by ID",
     *    description="get project ",
     *    tags={"Project"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the project to retrieve",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Project details retrieved",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="id", type="integer"),
     *           @OA\Property(property="name", type="string"),
     *           @OA\Property(property="desc", type="string"),
     *           @OA\Property(property="client_id", type="integer"),
     *           @OA\Property(property="status", type="string"),
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    ),
     *    @OA\Response(
     *       response=404,
     *       description="Project not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Project not found")
     *       )
     *    )
     * )
     */
    public function show($id)
    {
        return $this->ProjectRepo->show($id);
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
     *    path="/admin/projects/{id}",
     *    summary="Update a project",
     *    description="Update project ",
     *    tags={"Project"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the project to update",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="_method", type="string", default="PUT"),
     *              @OA\Property(property="name", type="string", description="Project name"),
     *              @OA\Property(property="desc", type="string", description="Project description"),
     *              @OA\Property(property="client_id", type="integer", description="ID of the client"),
     *              @OA\Property(property="status", type="string", description="Project status"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Project updated successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Project updated successfully")
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    ),
     *    @OA\Response(
     *       response=404,
     *       description="Project not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Project not found")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Project Name"})
     *       )
     *    )
     * )
     */
    public function update(ProjectRequest $request, $id)
    {
        return $this->ProjectRepo->update($request,$id);
    }

    /**
     * @OA\Delete(
     *    path="/admin/projects/{id}",
     *    summary="Delete a project",
     *    description="Remove a project by its ID",
     *    tags={"Project"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the project to delete",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Project deleted successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Project deleted successfully")
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Unauthorized access")
     *       )
     *    ),
     *    @OA\Response(
     *       response=404,
     *       description="Project not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Project not found")
     *       )
     *    )
     * )
     */
    public function destroy($id)
    {
        return $this->ProjectRepo->delete($id);
    }
}