<?php

namespace App\Http\Controllers\API\Agency;

use App\Http\Controllers\Controller;
use App\Models\AgencyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:agency', ['except' => ['login', 'register']]);
    }






    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:agency_users|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }







    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required|string|min:6',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->toJson(), 400);
        // }
        // $email = $request->email;
        // $password = Hash::make($request->password);

        // $user = AgencyUser::where('email',$email)->first();
        // if($token = ($user->password == $password)){
        //     return $this->respondWithToken($token);

        // }
        // $credentials = $request->only('email', 'password');

        // if ($token = $this->guard('agency_users')->attempt($credentials)) {
        //     return $this->respondWithToken($token);
        // }

        $credentials = $request->only('email', 'password');

        if ($token = Auth::guard('agency')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        //Authentication failed...
        // return $this->loginFailed();

        return response()->json(['error' => 'Unauthorized'], 401);

    }





    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:agency_users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = AgencyUser::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)]
        ))->sendEmailVerificationNotification();
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'message' => 'User successfully registered',
            'token' => $token,
            'user' => $user
        ], 201);
    }
    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard('agency')->user());
    }
    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard('agency')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('agency');
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
