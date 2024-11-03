<?php

namespace App\Repository\Dashboard\Client;

use App\Http\Resources\Dashboard\Client\ClientResource;
use App\Interfaces\ImageVideoHandle;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientRepo
{
    protected $ImgVidHandle;

    public function __construct(ImageVideoHandle $imageVideoHandle)
    {
        $this->ImgVidHandle = $imageVideoHandle;
    }
    public function index()
    {
        $clients = Client::get();

        return successResponseData(ClientResource::collection($clients));

    }

    public function store($request)
    {
        $data = $request->except('image', '_token');

        if ($request->has('image')) {
            $data['image'] = $this->ImgVidHandle->storeImgVid($request->image, 'Client');
        }

        $client = Client::create($data);

        return successResponseData(ClientResource::make($client), 'Client Added Successfully');
    }
    public function update($request, $id)
    {
        $client = Client::findOrFail($id);

        $data = $request->except('image', '_token');

        if ($request->has('image')) {

            $data['image'] = $this->ImgVidHandle->UpdateImgVid($request->image, 'Client', $client->image);

        }

        $client->update($data);

        return successResponseMessage(ClientResource::make($client));
    }

    public function show($id)
    {
        $client = Client::with('projects')->findOrFail($id);

        return successResponseData(new ClientResource($client));
    }

    public function delete($id)
    {
        $client = Client::findOrFail($id);

        $this->ImgVidHandle->deleteImgVid($client->image);

        $client->delete();

        return successResponseMessage("Client Deleted");


    }



}