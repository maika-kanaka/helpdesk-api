<?php

namespace App\Http\Controllers\Api\Trx;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \Firebase\JWT\JWT;


use App\Libraries\Auth;
use App\Models\Master\Category;
use App\Models\Sys\User;
use App\Models\Sys\UserSupport;
use App\Models\Trx\Ticket;

class TicketController extends Controller
{

    public function data(Request $request)
    {
        # param
        $jwt = trim($request->input('jwt'));
        $ticket_id = $request->get('ticket_id');

        # authentification
        $data_jwt = JWT::decode($jwt, config('jwt.key'), array('HS256'));

        # query
        $query = Ticket::table('t_ticket')
                        ->select(\DB::raw('t_ticket.*, t_cat.category_name'))
                        ->leftJoin(Category::$table . " as t_cat", "t_cat.category_id", "=", "t_ticket.category_id")
                        ->orderBy('t_ticket.created_at', 'desc');

        # filter ambil data berdasarkan hak akses
        if (Auth::role_api($data_jwt->user->group_id, 'ticket_view_all') === False) {
            if (Auth::role_api($data_jwt->user->group_id, 'ticket_view_support')) {
                # ambil data sesuai teknisi
                $user_support = UserSupport::table()->where('user_id', $data_jwt->user->user_id)->get();

                if (!empty($user_support)) {
                    $user_support_id = [];
                    foreach ($user_support as $kus => $vus) {
                        $user_support_id[] = $vus->support_id;
                    }
                    $query->whereIn('t_ticket.support_id', $user_support_id);
                }
            } else {
                # ambil data inputan sendiri
                $query->where('t_ticket.created_by', $data_jwt->user->user_id);
            }
        }

        # filter view detail
        if(!empty($ticket_id)){
            $query->where('ticket_id', $ticket_id);
        }

        $tickets = $query->get();

        return response()->json([
            'tickets' => $tickets,
            'status' => True
        ]);
    }

    public function save(Request $request)
    {
        # param
        $jwt = trim($request->input('jwt'));

        # hak akses
        try {
            $data_jwt = JWT::decode($jwt, config('jwt.key'), config('jwt.algo'));
        } catch (\Exception $e) {
            $data_jwt = false;
        }

        if($data_jwt === false){
            return response()->json(array('is_valid' => false, 'message' => 'Token invalid!'));
        }

        # ambil input
        $input = $this->_getInput([
            'event' => 'add',
            'data_jwt' => $data_jwt,
            'request' => $request
        ]);

        # simpan
        Ticket::table()->insert($input['input']);
        if(!empty($input['image'])){
            \File::put(public_path(). '/imgs/ticket/' . $input['input']['ticket_photo'], base64_decode($input['image']));
        }

        # msg
        return response()->json([
            'success' => True
        ]);
    }

    private function _getInput($config = [])
    {
        # alias
        $req = $config['request'];

        if($config['event'] == 'add'){
            $input['ticket_id'] = Ticket::primaryKey();
            $input['ticket_code'] = Ticket::generateCode();
            $input['ticket_status'] = 'open';
        }

        $input['support_id'] = 1; // default IT
        $input['category_id'] = trim($req->input('category'));
        $input['ticket_title'] = trim($req->input('title'));
        $input['ticket_priority'] = $req->input('priority') == 'true' ? 'high' : 'low';

        $image = $req->input('photo-file');
        if(!empty($image) && $image != 'undefined')
        {
            $image = str_replace(['data:image/png;base64,', 'data:image/jpeg;base64,', 'data:image/jpg;base64,'], '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $input['ticket_id'] .'.'. 'jpg';
            $input['ticket_photo'] = $imageName;
        }
        $input['ticket_desc'] = trim($req->input('description'));

        $input['created_at'] = date('Y-m-d H:i:s');
        $input['created_by'] = $config['data_jwt']->user->user_id;

        return ['input' => $input, 'image' => $image];
    }
}

