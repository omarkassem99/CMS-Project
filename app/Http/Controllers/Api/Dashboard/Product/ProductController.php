<?php

namespace App\Http\Controllers\Api\Dashboard\Product;


use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductRequest;
use App\Repository\Dashboard\Product\ProductRepo;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $ProdRepo;

    public function __construct(ProductRepo $ProdRepo)
    {
        $this->ProdRepo = $ProdRepo;
    }

    /**
     * @OA\Get(
     *    path="/admin/products",
     *    summary="Get all products",
     *    description="Retrieve a list of all products",
     *    tags={"Product"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(
     *       response=200,
     *       description="List of products",
     *       @OA\JsonContent(type="array",
     *           @OA\Items(
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="desc", type="string"),
     *               @OA\Property(property="category_id", type="integer"),
     *               @OA\Property(property="image", type="string"),
     *               @OA\Property(property="video", type="string")
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
        return $this->ProdRepo->index();
    }

    // Show the form for creating a new resource.

    public function create()
    {

    }

    /**
     * @OA\Post(
     *    path="/admin/products",
     *    summary="Create a new product",
     *    description="Add a new product to the inventory",
     *    tags={"Product"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="name", type="string", description="Product name"),
     *              @OA\Property(property="desc", type="string", description="Product description"),
     *              @OA\Property(property="category_id", type="integer", description="ID of the category"),
     *              @OA\Property(property="image[]",type="array",@OA\Items(type="string", format="binary"),description="Product images"),
     *              @OA\Property(property="video", type="string", format="binary", description="Product video"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=201,
     *       description="Product created successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product created successfully")
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
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Product Name"})
     *       )
     *    )
     * )
     */

    public function store(ProductRequest $request)
    {
        return $this->ProdRepo->store($request);
    }

    /**
     * @OA\Get(
     *    path="/admin/products/{id}",
     *    summary="Get a product by ID",
     *    description="get product",
     *    tags={"Product"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the product to retrieve",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Product details retrieved",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="id", type="integer"),
     *           @OA\Property(property="name", type="string"),
     *           @OA\Property(property="desc", type="string"),
     *           @OA\Property(property="category_id", type="integer"),
     *           @OA\Property(property="image", type="string"),
     *           @OA\Property(property="video", type="string"),
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
     *       description="Product not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product not found")
     *       )
     *    )
     * )
     */
    public function show($id)
    {
        return $this->ProdRepo->show($id);
    }

    
    //   Show the form for editing the specified resource.
    public function edit(string $id)
    {
        
    }

    /**
     * @OA\Post(
     *    path="/admin/products/{id}",
     *    summary="Update a product",
     *    description="Update product",
     *    tags={"Product"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the product to update",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="_method", type="string", default="PUT"),
     *              @OA\Property(property="name", type="string", description="Product name"),
     *              @OA\Property(property="desc", type="string", description="Product description"),
     *              @OA\Property(property="category_id", type="integer", description="ID of the category"),
     *              @OA\Property(property="image[]", type="array", @OA\Items(type="string", format="binary"), description="Product images"),
     *              @OA\Property(property="video", type="string", format="binary", description="Product video"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Product updated successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product updated successfully")
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
     *       description="Product not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product not found")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Product Name"})
     *       )
     *    )
     * )
     */
    public function update(ProductRequest $request, $id)
    {
        return $this->ProdRepo->update($request,$id);
    }

     /**
     * @OA\Delete(
     *    path="/admin/products/{id}",
     *    summary="Delete a product",
     *    description="Delete product",
     *    tags={"Product"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the product to Delete",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="_method", type="string", default="DELETE"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Product Deleted successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product Deleted successfully")
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
     *       description="Product not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product not found")
     *       )
     *    ),
     * )
     */
    
   
    public function destroy($id)
    {
        return $this->ProdRepo->delete($id);
    }

     /**
     * @OA\Delete(
     *    path="/admin/products/image/{imageId}",
     *    summary="Delete product image",
     *    description="Remove a specific image of a product",
     *    tags={"Product"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="imageId",
     *       in="path",
     *       required=true,
     *       description="ID of the image to delete",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Image deleted successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Image deleted successfully")
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
     *       description="Image not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Image not found")
     *       )
     *    )
     * )
     */
    public function deleteImg($imageId)
    {
        return $this->ProdRepo->deleteImg($imageId);
    }
}


