<?php

namespace App\Repository\Dashboard\Visitor;
use App\Models\Visitor;


class VisitorRepo
{
    public function newVisitor($request)
    {
        
        if(!(Visitor::where('ip_address',$request->ip())->exists()))
        {
            $visitor = Visitor::create([
                'ip_address'=> $request->ip()
            ]);
            return successResponseData($visitor);
        }
        else
        {
            return errorResponseMessage('Guest already exist');
        }

    }
}