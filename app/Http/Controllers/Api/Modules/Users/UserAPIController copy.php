<?php

namespace App\Http\Controllers\Api\Modules\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;

class UserAPIController extends BaseController
{


    /**
     * @OA\Post(
     * path="/api/register",
     * summary="register",
     * description="register by name , email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Fill your Data",
     *    @OA\JsonContent(
     *       required={"name", "email","password"},
     *       @OA\Property(property="name", type="string", example="Ahmed"),
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     *
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = $request->all();
        $user = $this->create($data);
        return 'You have signed-in';
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'  => $data['role_id'],
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     *
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $user->createToken('token-name')->plainTextToken;
        }
        return 'Login details are not valid';
    }




    /**
     * @OA\Post(
     * path="/api/logout",
     * summary="Logout",
     * description="Logout user and invalidate token",
     * operationId="authLogout",
     * tags={"auth"},
     * security={ {"sanctum": {} }},
     * @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not authorized"),
     *    )
     * )
     * )
     */
    public function logout()
    {
        $user = auth('sanctum')->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return $this->ApiResponse(200, 'User loged out', null);
    }

    /**
     * @OA\Get(
     *     path="/api/profile",
     *     tags={"auth"},
     *     summary="return profile of user",
     *     operationId="Profile",
     *     @OA\Parameter(
     *        name="User_ID",
     *        in="query",
     *        required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     *
     * Logs out current logged in user session.
     *
     * @return \Illuminate\Http\Response
     */
    public function Profile(Request $request)
    {
        $user = auth('sanctum')->user();
        if ($user)
            return $this->ApiResponse(200, $user, null);
        else
            return $this->ApiResponse(204, 'user not found', null);
    }

    /**
     * @OA\Post(
     *     path="/api/Edit_profile",
     *     tags={"auth"},
     *     summary="Edit profile of user",
     *     operationId="Profile",
     *     @OA\Parameter(
     *        name="User_ID",
     *        in="query",
     *        required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *        description="Success"
     *     )
     * )
     *
     * Edit user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $user = auth('sanctum')->user();
        $validator = $request->validate([
            'name' => 'unique:users',
            'email' => 'email|unique:users',
            'password' => 'min:6',
        ]);
        if ($user) {
            if ($request->name != Null) {
                $user->name = $request->name;
            }
            if ($request->email != Null) {
                $user->email = $request->email;
            }
            if ($request->password != null) {
                $user->password = \Hash::make($request->password);
            }
            $user->save();
            return $this->ApiResponse(200, 'user updated successfully', null);
        } else
            return $this->ApiResponse(204, 'user not found', null);
    }
}
