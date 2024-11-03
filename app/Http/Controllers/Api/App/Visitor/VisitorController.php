<?php

namespace App\Http\Controllers\Api\App\Visitor;

use App\Http\Controllers\Controller;
use App\Repository\Dashboard\Visitor\VisitorRepo;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    protected $VisitorRepo;

    public function __construct(VisitorRepo $VisitorRepo)
    {
        $this->VisitorRepo = $VisitorRepo;
    }

    /**
 * @OA\Post(
 *     path="/api/visitor",
 *     tags={"Visitor"},
 *     summary="Create new visitor",
 *     description="Checks if a visitor with the same IP address exists. If not, it creates a new visitor.",
 *     @OA\RequestBody(
 *         description="Visitor's IP address.",
 *         required=false,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Visitor created successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="ip_address", type="string", example="127.0.0.1"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Guest already exists",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Guest already exists")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="An error occurred while processing your request")
 *         )
 *     )
 * )
 */


    public function newVisitor(Request $request)
    {
        return $this->VisitorRepo->newVisitor($request);
    }
}
