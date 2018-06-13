<?php
namespace App\Http\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BokeModel extends Model
{

    protected $table = 'think_bokes';//boke表数据太大，临时用think_bokes代替测试
    public $timestamps = false;
    public function boke_lists_page()
    {
        $blists = $this->select()->orderBy('id', 'desc')->paginate(10);
        return $blists;
    }

    //layui数据调用
    public function layui_boke_lists($limit = 10, $where = '')
    {
        $blists = $this->select('id', 'title', 'content', 'addtime')->where($where)->orderBy('id', 'desc')->paginate($limit)->toArray();
        $result = array(
            'code' => 0,
            'msg' => '',
            'count' => $blists['total'],
            'data' => $blists['data']
        );
        return json_encode($result);
    }

    //layui数据调用
    public function layui_boke_del($where = '')
    {
        $result = $this->where($where)->delete();
        return $result;
    }

    public function layui_boke_edit($where = '')
    {
        $result = $this->where($where)->first()->toArray();
        return $result;
    }

    public function layui_boke_insert($data = array())
    {   

        if (!empty($data['id'])) {
            $where[] = ['id', '=', $data['id']];
            unset($data['id']);
            $result = $this->where($where)->update($data);
        }else{
            $result = $this->insert($data);
        }
        
        return $result;
    }
}