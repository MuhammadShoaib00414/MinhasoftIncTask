<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
       
        // Authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Generate an API token for the user
            $token = $user->createToken('api-token')->plainTextToken;

            // Save the token to the user's record in the database
            $user->api_token = $token;
            $user->save();

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        // Handle failed login attempt
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

}
