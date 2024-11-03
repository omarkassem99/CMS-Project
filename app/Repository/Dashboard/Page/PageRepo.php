<?php

namespace App\Repository\Dashboard\Page;
use App\Models\Page;


class PageRepo
{
    public function store($request)
    {
        $data = $request->except('_token');
        $page = Page::create($data);
        return successResponseData($page, 'Page created successfully');

    }
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return successResponseData($page);
    }

    public function update($request, $id)
    {
        $page = Page::findOrFail($id);

        $data = $request->except('_token');

        $page->update($data);
        return successResponseData($page, 'Page updated successfully');

    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return successResponseMessage('Page Deleted successfully');
    }


}