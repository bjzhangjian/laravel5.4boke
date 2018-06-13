<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\Boke;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Models\BokeModel;
use Illuminate\Support\Facades\Log;
use Session,Redirect;
//use Illuminate\Support\Facades\Request;
class BokeController extends Controller
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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->Boke = new BokeModel();
    }

    public function bk_list()
    {
        $search = $_GET ? $_GET : array('_token' => '', 'keyword' => '');
        return view('boke.bklist', ['search' => $search]);
    }

    //layui数据调用
    public function layui_bklist(Request $request)
    {
        $limit = $request->input('limit');
        $keyword = $request->input('keyword');
        $where = [];
        if (!empty($keyword)) {
            $where[] = ['title', '=', $keyword];
        }
        $bokelists = $this->Boke->layui_boke_lists($limit, $where);
        echo $bokelists;
    }

    //删除
    public function layui_bkdel(Request $request)
    {
        $id = $request->input('id');
        $where = [];
        if (!empty($id)) {
            $where[] = ['id', '=', $id];
        }
        $result = $this->Boke->layui_boke_del($where);
        if ($result) {
            $info = array(
                'state' => 1
            );
        } else {
            $info = array(
                'state' => 0
            );
        }
        echo json_encode($info);
    }

    //编辑模板
    public function layui_bkedit(Request $request)
    {
        $id = $request->input('id');
        $where = [];
        if (!empty($id)) {
            $where[] = ['id', '=', $id];
        }
        //$result = $this->Boke->layui_boke_edit($where);
        //return view('boke.edit', ['result' => $result]);
        return view('boke.edit');
    }

    //新增模板
    public function bk_add(Request $request)
    {   
        $id = $request->input('id');
        $where = [];
        $result = array(
            'id' => '',
            'title' => '',
            'content' => '',
        );
        if (!empty($id)) {
            $where[] = ['id', '=', $id];
            $result = $this->Boke->layui_boke_edit($where);
        }
        return view('boke.add', ['result' => $result]);
    }

    //编辑模板
    public function layui_bksave(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:2',
        ]);
        // foreach ($errors->all() as $message) {
        //         print_r($message);
        // }

        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');
        $data['id'] = $request->input('id');
        $result = $this->Boke->layui_boke_insert($data);
        if ($result) {
            $info = array(
                'state' => 1
            );
        } else {
            $info = array(
                'state' => 0
            );
        }
        echo json_encode($info);
    }

}
