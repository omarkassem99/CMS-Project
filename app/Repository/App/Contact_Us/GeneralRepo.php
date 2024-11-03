<?php

namespace App\Repository\App\Contact_Us;
use App\Http\Resources\Application\ContactUs\GeneralContactResource;
use App\Models\GeneralContact;


class GeneralRepo
{
    public function store($request)
    {

        $data = GeneralContact::create($request->all());

        return successResponseData(GeneralContactResource::make($data));

    }
}
