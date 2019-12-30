<?php namespace App\Http\Controllers\Api\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \Firebase\JWT\JWT;

use App\Models\Sys\User;
use App\Models\Sys\UserSupport;
use App\Models\Master\Support;

class UserController extends Controller
{

  public function login(Request $request)
  {
    # get input
    $email_or_username = trim($request->input('email_or_username'));
    $password = trim($request->input('password'));

    # db check
    $user = User::table()
                 ->where("user_email", $email_or_username)
                 ->orWhere("user_name", $email_or_username)
                 ->first();

    # valid: email
    if(empty($user))
    {
      $message = __('auth.email_or_username_not_registered');

      return response()->json(array(
        'valid' => false,
        'message' => $message
      ));
    }

    # valid: password
    if(!password_verify($password, $user->user_password))
    {
      $message = __("auth.combination_username_password_incorrect");

      return response()->json(array(
        'valid' => false,
        'message' => $message
      ));
    }

    # valid: is blocked ?
    if($user->is_block == 'Y'){
      $message = __('auth.your_account_is_blocked');

      return response()->json(array(
        'valid' => false,
        'message' => $message
      ));
    }

    unset($user->user_password);
    unset($user->is_block);
    unset($user->is_confirm);

    # ambil data user support ( teknisi )
    $user_support = [];
    if($user->group_id == 2)
    {
        $user_support = UserSupport::table()
                        ->where('user_id', $user->user_id)
                        ->orderBy('support_id')
                        ->get();
    }

    $token = array(
      "iss" => config('jwt.iss'),
      "aud" => config('jwt.aud'),
      "iat" => config('jwt.iat'),
      "nbf" => config('jwt.nbf'),
      "data" => $user
    );

    $jwt = JWT::encode($token, config('jwt.key'));

    return response()->json(array(
      'valid' => true,
      'jwt' => $jwt,
      'user' => $user,
      'user_support' => $user_support,
    ));
  }

}
