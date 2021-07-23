<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $subject = $request->route('subject');

        if($subject==null){
            return response()->json(['message'=>'The Subject cannot be found'], 404);
        }

        if($subject->user_id != auth()->user()->id){
            return response()->json(['message'=>'Unauthorized Access.'], 401);
        }

        return $next($request);
    }
}
