<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZHTXCMS</title>
<script type="text/javascript">
	var verifyUrl="<?php echo U(GROUP_NAME.'/Login/verify','','');?>";
	var CONTROL_U = "<?php echo U(GROUP_NAME. '/Login/checkusername');?>";
	var CONTROL_P = "<?php echo U(GROUP_NAME. '/Login/checkpassword');?>";
	var URLPATHDEPR= "<?php echo C('URL_PATHINFO_DEPR');?>";
</script>

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/login.js"></script>		
<link rel="stylesheet" href="__PUBLIC__/css/login.css" />
</head>	
<body>
	<div class="login">
		<div class="loginForm">	
			<form action="<?php echo U(GROUP_NAME.'/Login/login');?>" method="post" id="login">
			<div class="title">
				仁物设计后台管理中心			</div>
			<table width="100%">
				<tr>
					<th>管理员帐号:</th>
					<td>
						<input type="username" name="username" class="len220"/>
					</td>
				</tr>
				<tr>
					<th>密码:</th>
					<td>
						<input type="password" class="len220" name="password"/>
					</td>
				</tr>
				<tr>
					<th>验证码:</th>
				  <td>
						<input type="code" class="len220" name="code" autocomplete="off" /> <img src="<?php echo U(GROUP_NAME. '/Login/verify');?>" align="absmiddle" id="code"  class="vcode" onclick="change_code(this);"/>					</td>
				</tr>
				<tr>
					<td colspan="2" class="msg">
						
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:180px;"> <input type="submit" class="btn_blue" value="登录"/></td>
				</tr>
			</table>
		</form>
		</div>
	</div>

</body>
</html>