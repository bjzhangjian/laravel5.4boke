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
<form class="layui-form" action="" method="post">
  <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
  {{csrf_field()}}
  <div class="layui-form-item">
    <label class="layui-form-label">博客标题</label>
    <div class="layui-input-block">
      <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off"
             class="layui-input" value="<?php echo $result['title']; ?>">
    </div>
  </div>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">博客内容</label>
    <div class="layui-input-block">
      <textarea name="content" placeholder="请输入内容" class="layui-textarea"><?php echo $result['content']; ?></textarea>
    </div>
  </div>

  <!-- <div class="layui-form-item">
      <label class="layui-form-label">时间</label>
      <div class="layui-input-inline">
        <input type="text" name="test1" id="test1" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">当前时间</div>
    </div> -->
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
 <script src="{{ URL::asset('layui/layui.js') }}" charset="utf-8"></script>
<!--  <script src="{{ URL::asset('layui/laydate/laydate.js') }}" charset="utf-8"></script> -->
<script>
    // //执行一个laydate实例
    // laydate.render({
    //   elem: '#test1' //指定元素
    //   ,value: new Date()
    // });
    layui.use(['form', 'element'], function () {
        var form = layui.form;
        var $ = layui.jquery;//引入jquery
        form.on('submit(formDemo)', function (data) {
            //console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
            $.ajax({
                url: "{{ url('/boke/layui_bksave') }}",
                type: "POST",
                data: data.field,
                dataType: "json",
                success: function (data) {
                    if (data.state == 1) {
                        //layer.close(index);//关闭弹框
                        layer.msg("新增成功", {icon: 6});
                    } else {
                        layer.msg("新增失败", {icon: 5});
                    }
                }
            });
             window.location.href = '{{ url('/boke/bk_list') }}';
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
    });
</script>

</body>
</html>