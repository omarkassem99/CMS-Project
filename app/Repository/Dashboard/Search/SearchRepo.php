<?php

namespace App\Repository\Dashboard\Search;

use App\Http\Resources\Application\User\UserResource;
use App\Http\Resources\Dashboard\Admin\AdminResource;
use App\Http\Resources\Dashboard\Category\CategoryResource;
use App\Http\Resources\Dashboard\Client\ClientResource;
use App\Http\Resources\Dashboard\Product\ProductResource;
use App\Http\Resources\Dashboard\Project\ProjectResource;
use App\Models\Client;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;


class SearchRepo
{
    public function search($request)
    {
        $data = $request->except('_token');
        $searchText = $data['search'];

        $users = User::where('name', "LIKE", "%{$searchText}%")->get();


        $admins = Admin::where('name', "LIKE", "%{$searchText}%")->get();

        $products = Product::where('name', "LIKE", "%{$searchText}%")->get();

        $categories = Category::where('name', "LIKE", "%{$searchText}%")->get();
        $clients = Client::where('name', "LIKE", "%{$searchText}%")->get();
        $projects = Category::where('name', "LIKE", "%{$searchText}%")->get();

        $searchResult = [
            "users" => UserResource::collection($users),
            "admins" => AdminResource::collection($admins),
            "products" => ProductResource::collection($products),
            "categories" => CategoryResource::collection($categories),
            "clients" => ClientResource::collection($clients),
            "projects" => ProjectResource::collection($projects),
        ];
        return successResponseData($searchResult);
    }
}