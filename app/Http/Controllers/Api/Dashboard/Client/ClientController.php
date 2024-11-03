<?php

namespace App\Http\Controllers\Api\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Client\ClientRequest;
use App\Repository\Dashboard\Client\ClientRepo;
use OpenApi\Annotations as OA;

class ClientController extends Controller
{
    protected $ClientRepo;

    public function __construct(ClientRepo $ClientRepo)
    {
        $this->ClientRepo = $ClientRepo;
    }

    /**
     * @OA\Get(
     *    path="/admin/clients",
     *    summary="Get all clients",
     *    description="Retrieve a list of all clients",
     *    tags={"Client"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(
     *       response=200,
     *       description="List of clients",
     *       @OA\JsonContent(
     *           type="array",
     *           @OA\Items(
     *               type="object",
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="country_code", type="string"),
     *               @OA\Property(property="phone", type="string"),
     *               @OA\Property(property="date_of_purchase", type="string"),
     *               @OA\Property(property="status", type="string"),
     *               @OA\Property(property="client_budget", type="number"),
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
        return $this->ClientRepo->index();
    }

    /**
     * @OA\Post(
     *    path="/admin/clients",
     *    summary="Create a new client",
     *    description="Add a new client",
     *    tags={"Client"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="name", type="string", description="Client name"),
     *              @OA\Property(property="country_code", type="string", description="country code"),
     *              @OA\Property(property="phone", type="string", description="Client phone"),
     *              @OA\Property(property="image", type="string", format="binary", description="Client image"),
     *              @OA\Property(property="date_of_purchase", type="string", description="Date of purchase (YYYY-MM-DD)"),
     *              @OA\Property(property="status", type="string", description="Client status (Pending/Done)"),
     *              @OA\Property(property="client_budget", type="number", description="Client budget"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=201,
     *       description="Client created successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Client created successfully")
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
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Client Name"})
     *       )
     *    )
     * )
     */
    public function store(ClientRequest $request)
    {
        return $this->ClientRepo->store($request);
    }

    /**
     * @OA\Get(
     *    path="/admin/clients/{id}",
     *    summary="Get client ",
     *    description="Retrieve a specific client by their ID",
     *    tags={"Client"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the client to retrieve",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Client details retrieved",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="id", type="integer"),
     *           @OA\Property(property="name", type="string"),
     *           @OA\Property(property="phone", type="string"),
     *           @OA\Property(property="date_of_purchase", type="string"),
     *           @OA\Property(property="status", type="string"),
     *           @OA\Property(property="client_budget", type="number"),
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
     *       description="Client not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Client not found")
     *       )
     *    )
     * )
     */
    public function show($id)
    {
        return $this->ClientRepo->show($id);
    }

    /**
     * @OA\Post(
     *    path="/admin/clients/{id}",
     *    summary="Update client",
     *    description="Update client",
     *    tags={"Client"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the client to update",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="_method", type="string", default="PUT"),
     *              @OA\Property(property="name", type="string", description="Client name"),
     *              @OA\Property(property="country_code", type="string"),
     *              @OA\Property(property="phone", type="string", description="Client phone"),
     *              @OA\Property(property="image", type="string", format="binary", description="Client image"),
     *              @OA\Property(property="date_of_purchase", type="string", description="Date of purchase"),
     *              @OA\Property(property="status", type="string", description="Client status (Pending/Done)"),
     *              @OA\Property(property="client_budget", type="number", description="Client budget"),
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Client updated successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Client updated successfully")
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
     *       description="Client not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Client not found")
     *       )
     *    ),
     *    @OA\Response(
     *       response=422,
     *       description="Validation error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="errors", type="object", example={"name": "Please Enter Client Name"})
     *       )
     *    )
     * )
     */
    public function update(ClientRequest $request, $id)
    {
        return $this->ClientRepo->update($request, $id);
    }

    /**
     * @OA\Delete(
     *    path="/admin/clients/{id}",
     *    summary="Delete a client",
     *    description="Remove a client by their ID",
     *    tags={"Client"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the client to delete",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response=204,
     *       description="Client deleted successfully"
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
     *       description="Client not found",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Client not found")
     *       )
     *    )
     * )
     */
    public function destroy($id)
    {
        return $this->ClientRepo->delete($id);
    }
}

