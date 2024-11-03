<?php

namespace App\Repository\Dashboard\Team;

use App\Http\Resources\Dashboard\Team\TeamResource;
use App\Interfaces\ImageVideoHandle;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class TeamRepo
{
    protected $ImgVidHandle;

    public function __construct(ImageVideoHandle $imageVideoHandle)
    {
        $this->ImgVidHandle = $imageVideoHandle;
    }
    public function index()
    {
        $member = Team::get()->all();

        return successResponseData(TeamResource::collection($member));

    }

    public function store($request)
    {
        $data = $request->except(['image', '_token']);

        if ($request->has('image')) {
            $data['image'] = $this->ImgVidHandle->storeImgVid($request->image, 'Member');
        }

        $member = Team::create($data);

        return successResponseData(TeamResource::make($member), 'New Member Added Successfully');
    }
    public function update($request, $id)
    {
        $member = Team::findOrFail($id);

        $data = $request->except(['image', '_token']);

        if ($request->has('image')) {
            $data['image'] = $this->ImgVidHandle->UpdateImgVid($request->image, 'Member', $member->image);
        }

        $member->update($data);

        return successResponseData(TeamResource::make($member), 'Member Updated Successfully');
    }

    public function show($id = null)
    {

        $member = Team::findOrFail($id);

        return successResponseData(new TeamResource($member));
    }

    public function delete($id)
    {
        $member = Team::findOrFail($id);

        $this->ImgVidHandle->deleteImgVid($member->image);
        $member->delete();

        return successResponseMessage("Member Deleted");
    }
}