<?php

namespace App\Http\Controllers\Api\App\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\ContactUs\ReqContactRequest;
use App\Repository\App\Contact_Us\RequestServiceRepo;
use Illuminate\Http\Request;

class RequestContactController extends Controller
{
    protected $RequestRepo;

    public function __construct(RequestServiceRepo $RequestRepo)
    {
        $this->RequestRepo = $RequestRepo;
    }

    /**
     * @OA\Post(
     *    path="/api/contact/requestService",
     *    summary="Submit a Contact Us form request",
     *    description="This endpoint allows a user to submit their contact information and project details.",
     *    tags={"Contact Us"},
     *    @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="full_name", type="string", description="User's full name", example="John Doe"),
     *              @OA\Property(property="company", type="string", description="Company name", example="Tech Solutions"),
     *              @OA\Property(property="email", type="string", format="email", description="Email address", example="johndoe@example.com"),
     *              @OA\Property(property="country_code", type="string", description="country code", example="+20"),
     *              @OA\Property(property="phone", type="string", description="User's phone number", example="01234567890"),
     *              @OA\Property(property="country", type="string", description="User's country", example="Egypt"),
     *              @OA\Property(property="project_budget", type="number", description="Budget for the project", example="5000"),
     *              @OA\Property(property="service", type="string", description="Service requested", example="Web Development"),
     *              @OA\Property(property="details", type="string", description="Details about the project", example="I need a website built for my business.")
     *          )
     *       )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Form submitted successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Your request has been submitted successfully.")
     *       )
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Validation Error",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", example="Validation error")
     *       )
     *    )
     * )
     */

    public function store(ReqContactRequest $request)
    {
        return $this->RequestRepo->store($request);
    }
}