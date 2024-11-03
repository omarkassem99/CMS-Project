<?php

namespace App\Http\Controllers\Api\App\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\ContactUs\GeneralContactRequest;
use App\Repository\App\Contact_Us\GeneralRepo;
use Illuminate\Http\Request;


class GeneralContactController extends Controller
{
    protected $GeneralRepo;

    public function __construct(GeneralRepo $GeneralRepo)
    {
        $this->GeneralRepo = $GeneralRepo;
    }

     /**
     * @OA\Post(
     *    path="/api/contact/general",
     *    summary="Submit a General Contact Us form",
     *    description="Stores the contact form details",
     *    tags={"Contact Us"},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="full_name", type="string", description="Full name of the user", example="John Doe"),
     *              @OA\Property(property="email", type="string", format="email", description="Email address", example="john@example.com"),
     *              @OA\Property(property="subject", type="string", description="Subject of the message", example="Inquiry about service"),
     *              @OA\Property(property="details", type="string", description="Details of the inquiry", example="I would like to know more about your services.")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Form submitted successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="data", type="object")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Validation Error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Validation error message")
     *       )
     *    )
     * )
     */

    public function store(GeneralContactRequest $request)
    {
        return $this->GeneralRepo->store($request);
    }
}