<?php

if(!function_exists('successResponseData'))
{
    function successResponseData($data, $msg='Success', $status=200)
    {
        return response()->json([
            "statusType"=>true,
            "message" => $msg,
            "data" => $data,
        ], $status);
    }
}

if(!function_exists('successResponseMessage'))
{
    function successResponseMessage($msg="success", $status=200)
    {
        return response()->json([
            "statusType"=>true,
            "message" => $msg,
        ], $status);
    }
}

if(!function_exists('errorResponseMessage'))
{
    function errorResponseMessage($error, $status=400)
    {
        return response()->json([
            "statusType"=>false,
            "error" => $error,
        ], $status);
    }
}