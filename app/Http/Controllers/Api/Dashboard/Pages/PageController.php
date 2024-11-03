<?php

namespace App\Http\Controllers\Api\Dashboard\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Page\PageRequest;
use App\Repository\Dashboard\Page\PageRepo;
use OpenApi\Annotations as OA;

class PageController extends Controller
{
    protected $PageRepo;

    public function __construct(PageRepo $PageRepo)
    {
        $this->PageRepo = $PageRepo;
    }

    /**
     * @OA\Post(
     *    path="/admin/pages",
     *    summary="Create a new page",
     *    description="Add a new page to the website",
     *    tags={"Page"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="title", type="string", description="Page title"),
     *              @OA\Property(property="slug", type="string", description="Page slug"),
     *              @OA\Property(property="content", type="string", description="Page content"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=201,
     *       description="Page created successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Page created successfully")
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
     *           @OA\Property(property="errors", type="object", example={"title": "Please Enter Page Title"})
     *       )
     *    )
     * )
     */
    public function store(PageRequest $request)
    {
        return $this->PageRepo->store($request);
    }

    /**
     * @OA\Get(
     *    path="/admin/pages/{slug}",
     *    summary="Get a page by slug",
     *    description="Retrieve a specific page by its slug",
     *    tags={"Page"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="slug",
     *       in="path",
     *       required=true,
     *       description="Slug of the page to retrieve",
     *       @OA\Schema(type="string")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Page details retrieved",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="title", type="string"),
     *           @OA\Property(property="slug", type="string"),
     *           @OA\Property(property="content", type="string"),
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
     *       description="Page not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Page not found")
     *       )
     *    )
     * )
     */
    public function show($slug)
    {
        return $this->PageRepo->show($slug);
    }

    /**
     * @OA\Post(
     *    path="/admin/pages/{id}",
     *    summary="Update a page",
     *    description="Update page",
     *    tags={"Page"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the page to update",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\RequestBody(
     *       required=true,
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="_method", type="string", default="PUT"),
     *              @OA\Property(property="title", type="string", description="Page title"),
     *              @OA\Property(property="slug", type="string", description="Page slug"),
     *              @OA\Property(property="content", type="string", description="Page content"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Page updated successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Page updated successfully")
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
     *       description="Page not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Page not found")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"title": "Please Enter Page Title"})
     *       )
     *    )
     * )
     */
    public function update(PageRequest $request, $id)
    {
        return $this->PageRepo->update($request, $id);
    }

    /**
     * @OA\Delete(
     *    path="/admin/pages/{id}",
     *    summary="Delete a page",
     *    description="Remove a page by its ID",
     *    tags={"Page"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the page to delete",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=204,
     *       description="Page deleted successfully"
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
     *       description="Page not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Page not found")
     *       )
     *    )
     * )
     */
    public function destroy($id)
    {
        return $this->PageRepo->destroy($id);
    }
}
