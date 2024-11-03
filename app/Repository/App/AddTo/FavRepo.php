<?php

namespace App\Repository\App\AddTo;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class FavRepo
{
    public function store($request)
    {
        $data = $request->except('_token');
        $user = Auth::user();

        if (Product::findOrFail($data['product_id'])) {
            $productId = $data['product_id'];

            if ($user->favorites()->where('product_id', $productId)->exists()) {

                return errorResponseMessage('Product is already in Favorites');
            }

            $user->favorites()->create(["product_id" => $productId]);

            return successResponseMessage('Product Added To Favorites');

        }


    }

    public function delete($product_id)
    {
        if ((Product::findOrFail($product_id))) {
            $user = Auth::user();


            if (!($user->favorites()->where('product_id', $product_id)->exists())) {
                return errorResponseMessage('Product not in Favorite');
            }

            $user->favorites()->delete();

            return successResponseMessage('Product removed from favorites');
        }

    }
}