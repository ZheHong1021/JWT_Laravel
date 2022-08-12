<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
/**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        # 同樣限定填入規則
        $validator = FacadesValidator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        /* 驗證一下有無權限，如沒有會回傳『false』，如有回傳『Token』 */
        $token = auth()->attempt($validator->validated());
        if (!$token ) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
/**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {

        # 限定填入條件，回傳
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|between:2,100', 
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        /*
            $validator->errors() : 將會回傳上面填入規則沒符合的資料。例如下面。 如符合條件則會回傳 []
            { 
                "email": ["The email has already been taken."],  
                "password": ["The password confirmation does not match."]
            }
        */
        if($validator->fails()){ // 如果不符合Validaotr條件，則回傳400
            return response()->json($validator->errors()->toJson(), 400);
        }


        /*
            $validator->validate() : 當上面符合條件後，會回傳一個 array(name、email、password的資料)
            {
                "name": "哈士奇",
                "email": "haha87@gmail.com",
                "password": "haha0000"
            }

            bcrypt($request->password) : 將Request進來的Password進行『雜湊加密』
            Hash::make($request->password) : 與上面功能一樣
            
            最後透過 array_merge將兩個 array進行合併，之後再透過create將該array結果儲存到資料庫中
        */
        return response()->json(bcrypt($request->password), 200);
        
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
/**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
/**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
/**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user() {
        $user = auth()->user();
        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(['user' => $user], 401); 
    }
/**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}