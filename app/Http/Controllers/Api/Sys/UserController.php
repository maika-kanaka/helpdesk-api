<?php

namespace App\Http\Controllers\Api\Sys;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \Firebase\JWT\JWT;

use App\Models\Sys\User;
use App\Models\Sys\Group;
use App\Models\Sys\UserSupport;
use App\Models\Master\Support;

class UserController extends Controller
{

    public function data(Request $request)
    {
        # param
        $user_id = $request->get('user_id');

        # query
        $query = User::table()->orderBy('user_name');
        if(!empty($user_id)){
            $query->where('user_id', $user_id);
        }
        $users = $query->get();

        foreach($users as $k => $user)
        {
            // image default
            if(empty($user->user_photo)){
                $users[$k]->user_photo = asset("imgs/user/default.png");
            }

            unset($users[$k]->user_password);
        }

        return response()->json([
            'users' => $users,
            'status' => True
        ]);
    }

    public function update(Request $request)
    {
        # param
        $user_id = $request->input('user_id');

        # tangkap input
        $input['user_fullname'] = trim(htmlentities($request->input('fullname')));
        $input['user_name'] = trim(htmlentities($request->input('username')));
        $input['user_email'] = trim(htmlentities($request->input('email')));
        $password = trim($request->input('password'));
        if(!empty($password)){
            $input['user_password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $input['user_description'] = trim(htmlentities($request->input('description')));

        if(!empty($request->input('group_id'))){
            $input['group_id'] = trim(htmlentities($request->input('group_id')));
        }
        if(!empty($request->input('is_block'))){
            $input['is_block'] = $request->input('is_block') == 'false' ? 'N' : 'Y';
        }

        $input['is_new'] = 'N';
        $input['updated_at'] = date('Y-m-d H:i:s');

        # update
        User::table()->where('user_id', $user_id)->update($input);

        # lempar
        return response()->json([
            'status' => true
        ]);
    }

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
        if (empty($user)) {
            $message = __('auth.email_or_username_not_registered');

            return response()->json(array(
                'valid' => false,
                'message' => $message
            ));
        }

        # valid: password
        if (!password_verify($password, $user->user_password)) {
            $message = __("auth.combination_username_password_incorrect");

            return response()->json(array(
                'valid' => false,
                'message' => $message
            ));
        }

        # valid: is blocked ?
        if ($user->is_block == 'Y') {
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
        if ($user->group_id == 2) {
            $user_support = UserSupport::table()
                ->where('user_id', $user->user_id)
                ->orderBy('support_id')
                ->get();
        }

        # ambil hak akses berdasarkan group
        $can_access_menu = [];
        $group_access = Group::tableAccess()->where('group_id', $user->group_id)->get();
        if(!empty($group_access))
        {
            foreach($group_access as $kga => $vga)
            {
                if($vga->can_access == 'Y'){
                    $can_access_menu[] = $vga->menu_id;
                }
            }
        }

        $token = array(
            "iss" => config('jwt.iss'),
            "aud" => config('jwt.aud'),
            "iat" => config('jwt.iat'),
            "nbf" => config('jwt.nbf'),
            "user" => $user
        );

        $jwt = JWT::encode($token, config('jwt.key'));

        return response()->json(array(
            'valid' => true,
            'jwt' => $jwt,
            'user' => $user,
            'user_support' => $user_support,
            'can_access_menu' => $can_access_menu
        ));
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'errors' => $validator,
                'message' => ''
            ]);
        }

        # get input
        $input['created_at'] = date('Y-m-d H:i:s');
        $input['user_fullname'] = trim(htmlentities($request->input('fullname')));
        $input['user_name'] = trim(htmlentities($request->input('username')));
        $input['user_email'] = trim(htmlentities($request->input('email')));
        $input['user_password'] = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $input['is_new'] = 'Y';

        # valid: unique username
        $user = User::table()->where('user_name', $input['user_name'])->first();
        if(!empty($user)){
            return response()->json([
                'status' => False,
                'message' => __('auth.username_is_already')
            ]);
        }

        # valid: unique email
        $email = User::table()->where('user_email', $input['user_email'])->first();
        if(!empty($email)){
            return response()->json([
                'status' => False,
                'message' => __('auth.email_is_already')
            ]);
        }

        # valid: minimun requirement for password


        # insert
        $insert = User::table()->insert($input);

        # message
        return response()->json([
            'status' => $insert
        ]);
    }

    public function forgot_password()
    {

    }

}
