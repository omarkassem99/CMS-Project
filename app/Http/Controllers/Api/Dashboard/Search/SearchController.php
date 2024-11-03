<?php

namespace App\Http\Controllers\Api\Dashboard\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Search\SearchRequest;
use App\Repository\Dashboard\Search\SearchRepo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $SearchRepo;

    public function __construct(SearchRepo $SearchRepo)
    {
        $this->SearchRepo = $SearchRepo;
    }

     /**
     * @OA\Post(
     *     path="/admin/search",
     *     tags={"Search"},
     *     summary="Search",
     *     description="Search",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"search"},
     *                 @OA\Property(property="search", type="string", description="Text to search")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Search results",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="users", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="admins", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="products", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="categories", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="clients", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="projects", type="array", @OA\Items(type="object")),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="search", type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    
    public function search(SearchRequest $request)
    {
        return $this->SearchRepo->search($request);
    }
}
