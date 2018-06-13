<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Models\JsonModel;
use App\Http\Models\UserModel;
use Illuminate\Support\Facades\Log;
use Session,Redirect;
//use Illuminate\Support\Facades\Request;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->creatJson = new JsonModel();
        $this->user = new UserModel();
    }
    public function index()
    {
        return view('user.login');
    }
    public function userCenter()
    {
        return view('user.index');
    }
    public function userTop()
    {
        return view('user.top');
    }
    public function userLeft()
    {
        return view('user.left');
    }
    public function userRight()
    {
        return view('user.right');
    }
    //登陆验证，保存
    public function store(Request $request)
    {       
        //$method=$request->method();
        if($request->isMethod('post')){
            //$data = request::all();//获取全部表单信息
            $username=$request->input('username');
            $password=$request->input('password');
            if (empty($username)) {
                $data = array(
                    'status' => 1,
                    'msg' => '请输入用户名'
                );
                return $this->creatJson->echo_json($data);
            }
            if (empty($password)) {
                $data = array(
                    'status' => 1,
                    'msg' => '请输入密码'
                );
                return $this->creatJson->echo_json($data);
            }
            //模型操作数据库
            $userinfo = array(
                'username' => $username,
                'password' =>MD5($password)
            );
            $result = $this->user->selectOne($userinfo);
            if(!empty($result)){
                //session赋值
                Session::put('_uid', $result['username']);
                $data = array(
                    'status' => 0,
                    'msg' => '登陆成功'
                );
            }else{
                $data = array(
                    'status' => 1,
                    'msg' => '没有该用户'
                );
            }
            return $this->creatJson->echo_json($data);
        }else{
            $data = array(
                'status' => 1,
                'msg' => '非法访问'
            );
            return $this->creatJson->echo_json($data);
        }
        
    }
    public function loginout()
    {
        Session::put('_uid', '');
        return redirect('login');
    }
}
