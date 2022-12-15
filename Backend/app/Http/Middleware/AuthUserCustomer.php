<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\users;
use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthUserCustomer
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
        
        $url=$request->url();
        $contains = Str::contains($url, 'customer');
        // return response()->json($contains,401);
        
        if ($key && $contains)
        {
            
            $token=Token::where('token',$key)
                        ->where('role',"CUSTOMER")
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