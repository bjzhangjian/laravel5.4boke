<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<form action="" id="form">
	{{ csrf_field() }}
	用户名：<input type="text" name="username" v-model="loginName" id="username" class="form-control"><br>
	密码：<input type="text" name="password" v-model="password" id="password" class="form-control"><br>
	<input type="button" value="登陆" class="btn btn-primary btn-lg btn-block" v-on:click="doLogin">
</form>
<script type="text/javascript">
    new Vue({
        el: '#form',
        data: {
                _token: '',
                loginName: '',
                password: ''
        },
        methods: {
            doLogin: function () {
                axios.post('/store', 
                    {
                        _token: '{{ csrf_token() }}',
                        username: this.loginName,
                        password: this.password
                    }
                    ).then(function (response) {
                        if (response.data.status == 0) {
                            alert(response.data.msg);
                            window.location.href = '{{ url('/user') }}';
                        }else{
                            alert(response.data.msg);
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
            }
           
        }
    })
</script>