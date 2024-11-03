<?php

namespace App\Repository\App\Contact_Us;
use App\Http\Resources\Application\ContactUs\RequestContactResource;
use App\Models\RequestContact;


class RequestServiceRepo
{
    public function store($request)
    {
       
        $data = RequestContact::create($request->all());

        return successResponseData(RequestContactResource::make($data ));


    }
}
