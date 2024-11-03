<?php

namespace App\Http\Controllers\Api\App\AddTo;

use App\Http\Controllers\Controller;
use App\Repository\App\AddTo\CartRepo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $CartRepo;

    public function __construct(CartRepo $CartRepo)
    {
        $this->CartRepo = $CartRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     *    path="/api/carts",
     *    summary="Add product to cart",
     *    description="Add product to cart",
     *    tags={"Cart"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="product_id", type="integer", description="ID of the product to add")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Product added to cart",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product Added To Cart")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Product Already in Cart",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product Already in Cart")
     *       )
     *    ),
     * )
     */
    public function store(Request $request)
    {
        return $this->CartRepo->store($request);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

      /**
     * @OA\Delete(
     *    path="/api/carts/{product_id}",
     *    summary="Remove product from cart",
     *    description="Removes product from cart",
     *    tags={"Cart"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="product_id",
     *       in="path",
     *       description="ID of the product to remove",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Product removed from cart",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product removed from cart")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Product not in Cart",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product not in Cart")
     *       )
     *    ),
     * )
     */
    public function destroy($product_id)
    {
        return $this->CartRepo->delete($product_id);
    }
}

