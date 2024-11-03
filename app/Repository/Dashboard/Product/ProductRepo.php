<?php

namespace App\Repository\Dashboard\Product;

use App\Http\Resources\Dashboard\Product\ProductResource;
use App\Interfaces\ImageVideoHandle;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductRepo
{
    protected $ImgVidHandle;

    public function __construct(ImageVideoHandle $imageVideoHandle)
    {
        $this->ImgVidHandle = $imageVideoHandle;
    }

    public function index()
    {
        $products = Product::with('images')->get();
        $product = ProductResource::collection($products);

        return successResponseData($product);
        
    }
    public function store($request)
    {
        
        try 
        {
            $data = $request->except(['image', 'video', '_token']);

            $product = Product::create($data);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $img_path = $data['image'] = $this->ImgVidHandle->storeImgVid($image, 'Product/Product_images');

                    $prodImg = new ProductImage();
                    $prodImg->product_id = $product->id;
                    $prodImg->image = $img_path;
                    $prodImg->save();
                }
                ;
            }

            if ($request->hasFile('video')) {

                $data['video'] = $this->ImgVidHandle->storeImgVid($request->video, 'Product/Product_videos');
                $product->video = $data['video'];
                $product->save();

            }
            return successResponseData(ProductResource::make($product), 'Product Created Successfully');

        } 
        catch (\Exception $exception) {
            return errorResponseMessage($exception->getMessage());
        }
    }

    public function show($id)
    {

        $product = Product::with('images')->findOrFail($id);
        return successResponseData(new ProductResource($product));
    }

    public function update($request, $id)
    {
        try {

            $product = Product::findOrFail($id);

            $data = $request->except(['image', 'video', '_token']);

            $product->update($data);


            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $img_path = $this->ImgVidHandle->storeImgVid($image, 'Product/Product_images');

                    $prodImg = new ProductImage();
                    $prodImg->product_id = $product->id;
                    $prodImg->image = $img_path;
                    $prodImg->save();
                }
                ;
            }

            if ($request->hasFile('video')) {
                $this->ImgVidHandle->deleteImgVid($product->video);
                $data['video'] = $this->ImgVidHandle->storeImgVid($request->video, 'Product/Product_videos');

                $product->video = $data['video'];
                $product->save();

            }
            return successResponseData(ProductResource::make($product), 'Product Updated Successfully');
        } catch (\Exception $exception) {
            return errorResponseMessage($exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {

            $product = Product::with('images')->findOrFail($id);

            foreach($product->images as $image)
            {
                $this->ImgVidHandle->deleteImgVid($image->image);
                $image->delete();
            }
            
            if ($product->video) {
                $this->ImgVidHandle->deleteImgVid($product->video);
            }

            $product->delete();

            return successResponseMessage('Product deleted successfully!');
        } catch (\Exception $exception) {
            return errorResponseMessage($exception->getMessage()); 
        }
    }

    public function deleteImg($img_id)
    {
        try {

            $productImg = ProductImage::findOrFail($img_id);

            $this->ImgVidHandle->deleteImgVid($productImg);

            $productImg->delete();

            return successResponseMessage('Image deleted successfully!');
        } catch (\Exception $exception) {
            return errorResponseMessage($exception->getMessage());
        }
    }

}