<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class UserModel extends Model{
	protected $table = 'think_user';
	// protected $table = array(
	// 	'think_user'
	// );
	public $timestamps = false;
    public function selectOne($data)
    {
        //调用表的方法有多种
        //第一种$this->table[0]
        //第二种DB::table('think_user')
        if ($data) {
            // $username = $data['username'];
            // $password = $data['password'];
            $result = $this->select('username', 'password')
                ->where('lock', '=', '0')
                ->where(function ($query) use ($data) {
                    if ($data['username']) {
                        $query->where('username', '=', $data['username']);
                    }
                    if ($data['password']) {
                        $query->where('password', '=', $data['password']);
                    }
                })
                ->first();
            if (!empty($result)) {
                return $result->toArray();
            } else {
                return [];
            }
        } else {
            return [];
        }
    }
}