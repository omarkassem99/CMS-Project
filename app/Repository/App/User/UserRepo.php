<?php

namespace App\Repository\App\User;

use App\Http\Resources\Application\User\UserResource;
use App\Interfaces\ImageVideoHandle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepo
{
    protected $ImgVidHandle;

    public function __construct(ImageVideoHandle $imageVideoHandle)
    {
        $this->ImgVidHandle = $imageVideoHandle;
    }

    public function register($request)
    {

        $data = $request->except(['image', 'password']);

        if ($request->has('image')) {

            $data['image'] = $this->ImgVidHandle->storeImgVid($request->image, 'User');
        }

        $password = bcrypt($request->password);
        $data['password'] = $password;

        $store = User::create($data);

        $user_data = [
            'user' => UserResource::make($store),
            'token' => $store->createToken('UserToken')->accessToken
        ];

        return successResponseData($user_data, 'User Created Successfully');


    }

    public function login($request)
    {
        $credentials = [];

        if ($request->filled('phone')) {
            $credentials['phone'] = $request->phone;
        } elseif ($request->filled('email')) {
            $credentials['email'] = $request->email;
        }

        $credentials['password'] = $request->password;


        if (Auth::attempt($credentials)) {

            $user_token = Auth::user()->createToken('UserToken')->accessToken;

            return successResponseData(['token' => $user_token], "logged in");

        } else {
            return errorResponseMessage('Your Email or Phone is incorrect.');

        }


    }

    public function update($request)
    {

        $data = $request->except(['image', '_token']);
        $user = Auth::user();

        if ($request->has('image')) {

            $data['image'] = $this->ImgVidHandle->UpdateImgVid($request->image, 'User', $user->image);
        }

        $user->update($data);

        return successResponseData(UserResource::make($user), 'User Updated Successfully');


    }

    public function profile()
    {
        $user = Auth::user();

        return successResponseData(UserResource::make($user));



    }

    public function change_password($request)
    {

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return successResponseMessage("Password Updated");
        } else {

            return errorResponseMessage("current password is not matching");
        }
    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return successResponseMessage("logged out");
    }
}