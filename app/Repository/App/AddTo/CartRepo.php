<?php

namespace App\Repository\App\AddTo;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartRepo
{
    public function store($request)
    {
        $data =$request->except('_token');
        $user = Auth::user();
      
        
        if((Product::findOrFail($data['product_id'])))
        {
            $productId = $data['product_id'];

            if ($user->carts()->where('product_id', $productId)->exists()) {
                
                return errorResponseMessage('Product Already in Cart');
            }
            
            $user->carts()->create(["product_id" => $productId]);
            
            return successResponseMessage('Product Added To Cart');
        }
       
    }

    public function delete($product_id)
    {
        if ((Product::findOrFail($product_id))) {
            
            $user = Auth::user();
            
            if (!($user->carts()->where('product_id', $product_id)->exists())) 
            {
                return  errorResponseMessage('Product not in Cart');
            }
            
            $user->carts()->delete();
            
            return successResponseMessage('Product removed from cart');
        }
       
    }
}