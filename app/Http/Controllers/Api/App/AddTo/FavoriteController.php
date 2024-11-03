<?php

namespace App\Http\Controllers\Api\App\AddTo;

use App\Http\Controllers\Controller;
use App\Repository\App\AddTo\FavRepo;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    protected $FavRepo;

    public function __construct(FavRepo $FavRepo)
    {
        $this->FavRepo = $FavRepo;
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
     *    path="/api/favorites",
     *    summary="Add product to Favorite",
     *    description="Adds a product to Favorite",
     *    tags={"Favorite"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="product_id", type="integer", description="Product ID ")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Product added to favorites",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product Added To Favorite")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Product Already in Favorites",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product Already in Favorite")
     *       )
     *    ),
     * )
     */
    public function store(Request $request)
    {
        return $this->FavRepo->store($request);
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
     *    path="/api/favorites/{product_id}",
     *    summary="Remove product from Favorites",
     *    description="Removes a product from favorites",
     *    tags={"Favorite"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="product_id",
     *       in="path",
     *       required=true,
     *       description="Product ID",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Product removed from favorites",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product removed from favorites")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Product not in Favorites",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Product not in Favorites")
     *       )
     *    ),
     * )
     */
    public function destroy($product_id)
    {
        return $this->FavRepo->delete($product_id);
    }
}