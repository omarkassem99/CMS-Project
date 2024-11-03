<?php

namespace App\Http\Controllers\Api\Dashboard\Stats;

use App\Http\Controllers\Controller;
use App\Repository\Dashboard\Stats\DashboardRepo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $DashRepo;

    public function __construct(DashboardRepo $DashRepo)
    {
        $this->DashRepo = $DashRepo;
    }

    /**
     * @OA\Get(
     *     path="/admin/dashboard",
     *     tags={"Dashboard"},
     *     summary="Get dashboard statistics",
     *     description="Dashboard Stats",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Dashboard statistics",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="Visitors", type="integer"),
     *                 @OA\Property(property="Running_Projects", type="integer"),
     *                 @OA\Property(property="Completed_Projects", type="integer"),
     *                 @OA\Property(
     *                     property="One Hand Team",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="name", type="string"),
     *                         @OA\Property(property="position", type="string")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="Clients",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="name", type="string"),
     *                         @OA\Property(
     *                             property="projects",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="name", type="string"),
     *                                 @OA\Property(property="status", type="string")
     *                             )
     *                         )
     *                     )
     *                 )
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

    public function index()
    {
        return $this->DashRepo->dashboardStats();
    }
}
