<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<form class="layui-form" action="{{ url('/boke/bk_list') }}" method="get">
  {{ csrf_field() }}
  <div class="layui-form-item">
    <label class="layui-form-label">关键词</label>
    <div class="layui-input-inline">
      <input type="text" name="keyword" id="keyword" lay-verify="keyword" autocomplete="off" placeholder="请输入关键词" class="layui-input" value="<?php echo($search['keyword']); ?>">
    </div>
    <button class="layui-btn" lay-submit="" lay-filter="demo1">搜索</button>
<!-- <button type="reset" class="layui-btn layui-btn-primary">重置</button> -->
  </div>

</form>
<table class="layui-hide" id="bklist" lay-filter="demo">

</table>
<script src="{{ URL::asset('layui/layui.js') }}" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['table', 'element'], function () {
        var table = layui.table;
        var $ = layui.jquery;//引入jquery

        table.render({
            elem: '#bklist',
            method: 'get',
            url: '{{ url('/boke/layui_bklist') }}',
            where: {
                token: '<?php echo($search['_token']); ?>',
                keyword: '<?php echo($search['keyword']); ?>'
            },
            cellMinWidth: 80, //全局定义常规单元格的最小宽度，layui 2.2.1 新增
            cols: [[
                {field: 'id', width: 100, title: 'ID', align: 'center', sort: true}
                , {field: 'title', width: 450, title: '用户名', align: 'center',}
                , {field: 'content', width: 200, title: '内容', align: 'center',}
                , {field: 'addtime', width: 180, title: '时间', align: 'center', sort: true}
                , {fixed: 'right', width: 150, title: '操作', align: 'center', toolbar: '#barDemo'} //这里的toolbar值是模板元素的选择器
            ]]
            , page: true
        });
//
//监听工具条,括号里的demo是table表格的lay-filter="demo"
        table.on('tool(demo)', function (obj) {
            var data = obj.data;
            if (obj.event === 'detail') {
                layer.msg('ID：' + data.id + ' 的查看操作');
            } else if (obj.event === 'del') {
                layer.confirm('确定删除么', function (index) {
                    if (index) {
                        $.ajax({
                            url: "{{ url('/boke/layui_bkdel') }}",
                            type: "POST",
                            data: {"id": data.id, "_token": '<?php echo csrf_token();?>'},
                            dataType: "json",
                            success: function (data) {
                                if (data.state == 1) {
                                    obj.del();//删除这一行
                                    layer.close(index);//关闭弹框
                                    layer.msg("删除成功", {icon: 6});
                                } else {
                                    layer.msg("删除失败", {icon: 5});
                                }
                            }
                        });
                    }

                });
            } else if (obj.event === 'edit') {
                if (data.id) {
                    // layer.msg('ID：'+ data.id + ' 的查看操作');
                    window.location.href = '{{ url('/boke/bk_add') }}?id=' + data.id;
                }
            }
        });
//

    });
</script>
<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
</body>
</html>