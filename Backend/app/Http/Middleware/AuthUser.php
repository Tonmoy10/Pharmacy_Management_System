<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\users;
use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $key=$request->header("Authorization");
        
        if ($key)
        {
            $token=Token::where('token',$key)
                        ->whereNUll('expired_at')->first();
            if($token)
            {
                // return response()->json(["msg"=>"logged in"]);
                return $next($request);             
            }
            return response()->json(["msg"=>"Expired token"],401);
        }
        return response()->json(["msg"=>"Invalid"],401);
    }
}