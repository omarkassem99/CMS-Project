<?php

namespace App\Repository\Dashboard\Admin;

use App\Http\Resources\Dashboard\Admin\AdminResource;
use App\Interfaces\ImageVideoHandle;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class AdminRepo
{
    protected $ImgVidHandle;

    public function __construct(ImageVideoHandle $imageVideoHandle)
    {
        $this->ImgVidHandle = $imageVideoHandle;
    }

    public function insertAdmin()
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            "country_code" => "+20",
            "phone" => "1114466122",
            'password' => Hash::make('123456789'),
            "image" => 'admin_images/image1.jpg'
        ]);

        return successResponseData($admin);
    }

    public function store($request)
    {
        $data = $request->except(['image', 'password','_token']);

        if ($request->has('image')) {

            $data['image'] = $this->ImgVidHandle->storeImgVid($request->image, 'Admin');
        }

        $password = bcrypt($request->password);
        $data['password'] = $password;

        $admin = Admin::create($data);
            
        return successResponseData(AdminResource::make($admin), 'Admin Added Successfully');
    }

    public function login($request)
    {
        $credentials = [];

        if ($request->filled('phone')) {
            $credentials['phone'] = $request->phone;
            $col = 'phone';
        } elseif ($request->filled('email')) {
            $credentials['email'] = $request->email;
            $col = 'email';
        }

        $credentials['password'] = $request->password;

        $admin = Admin::where($col, $request->input($col))->first();

        if ($admin) {
            if ($admin && Hash::check($credentials['password'], $admin->password)) {
                $token = $admin->createToken('Admin_Token')->accessToken;

                return successResponseData($token, 'Logged in successfully');

            } else {

                return errorResponseMessage('Your Password is incorrect');
            }
        } else {
            return errorResponseMessage('Your Email or Phone is incorrect');
        }

    }

    public function update($request)
    {
        $data = $request->except(['image', '_token']);
        $admin = Auth::guard('admin')->user();


        if ($request->has('image')) {
            $data['image'] = $data['image'] = $this->ImgVidHandle->UpdateImgVid($request->image, 'Admin', $admin->image);
        }

        $admin->update($data);

        return successResponseData(AdminResource::make($admin), 'Admin Updated Successfully');


    }

    public function show()
    {
        $admin = Auth::guard('admin')->user();

        return successResponseData(AdminResource::make($admin));

    }

    public function logout()
    {
        $admin = Auth::guard('admin')->user();


        $admin->token()->revoke();

        return successResponseMessage("logged Out");
    }

    public function change_password($request)
    {
        $data = $request->except('_token');
        $admin = Auth::guard('admin')->user();

        if (Hash::check($data['current_password'], $admin->password)) {
            $admin->update([
                'password' => Hash::make($data['new_password'])
            ]);

            return successResponseMessage("Password Updated Successfully");
        } else {

            return errorResponseMessage("current password is not matching");
        }


    }
}