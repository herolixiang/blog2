<h3>登陆页面</h3>
<form action="{{url('/kao/login_do')}}" method="post">
	<table border="1" width="500">
<!-- 		<caption>管理员登录页面</caption> -->
        @csrf
		<p>
			用户名
			<input type="text" name="username">
		</p>
		<p>
			密码
			<input type="password" name="password">
		</p>
		<button>登录</button>
		
	</table>
</form>