<?php

namespace App\Http\Controllers\Api\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Repository\Dashboard\Category\CategoryRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $CatRepo;

    public function __construct(CategoryRepo $CatRepo)
    {
        $this->CatRepo = $CatRepo;
    }

    /**
     * @OA\Get(
     *    path="/admin/categories",
     *    summary="Get all categories",
     *    description="Retrieve a list of all categories",
     *    tags={"Category"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(
     *       response=200,
     *       description="List of categories",
     *       @OA\JsonContent(
     *           type="array",
     *           @OA\Items(
     *               type="object",
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="desc", type="string")
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
        return $this->CatRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * @OA\Post(
     *    path="/admin/categories",
     *    summary="Create a new category",
     *    description="Add a new category",
     *    tags={"Category"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="name", type="string", description="Category name"),
     *              @OA\Property(property="desc", type="string", description="Category description")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=201,
     *       description="Category created successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Category created successfully")
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
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Category Name"})
     *       )
     *    )
     * )
     */
    public function store(CategoryRequest $request)
    {
        return $this->CatRepo->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
     *    path="/admin/categories/{id}",
     *    summary="Update a category",
     *    description="Update an existing category by its ID",
     *    tags={"Category"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the category to update",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="_method", type="string", default="PUT"),
     *              @OA\Property(property="name", type="string", description="Category name"),
     *              @OA\Property(property="desc", type="string", description="Category description")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Category updated successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Category updated successfully")
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
     *       description="Category not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Category not found")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Category Name"})
     *       )
     *    )
     * )
     */
    public function update(CategoryRequest $request, $id)
    {
        return $this->CatRepo->update($request,$id);
    }

     /**
     * @OA\Delete(
     *    path="/admin/categories/{id}",
     *    summary="Delete a category",
     *    description="Remove a category by its ID",
     *    tags={"Category"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the category to delete",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Category deleted successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Category deleted successfully")
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
     *       description="Category not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Category not found")
     *       )
     *    )
     * )
     */
    public function destroy($id)
    {
        return $this->CatRepo->delete($id);
    }
}
