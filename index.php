<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8">
	<title>易班消息通知平台</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<style type="text/css">
	*{
		font-family: 微软雅黑;
	}
	</style>
</head>
<body>
<div class="container">
<h3 class="page-header">易班消息通知平台</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">
			<h4>通知平台</h4>
			</div>
		</div>
		<div class="panel-body">
			<p class="alert alert-warning">这里是通知文档发送平台，所有的通知将以OFFICE文档格式上传到本平台</p>
		</div>
	</div>
	<div class="panel panel-danger">
		<div class="panel-heading">
			<div class="panel-title">
				<b>通知文件列表</b> <small style="color:green;margin-left:15px;">[<a href="upload.php">发通知</a>]</small>
			</div>	
		</div>
		<table class="table table-striped table-hover table-bordered">
			<tr>
				<th>文件名</th>
				<th>上传日期</th>
			</tr>
<?php
error_reporting(0);
$con = file('data.dat');
$num = count($con);
for($i = $num - 1; $i >= 0; $i--){
	$text = explode("|:|",$con[$i]);
	echo'<tr>
			<td>
				<a href="'.$text[1].'"><img src="img/'.trim($text[3]).'.png" style="height:20px;margin-right:3px;" alt="'.$text[0].'" />'.$text[0].'</a>
			</td>
			<td>'.$text[2].'</td>
		</tr>';
}
?>
		</table>
		<div class="panel-footer">
			<p>Copyright © 2017 by rainerosion. All rights reserved.</p>
		</div>
	</div>
</div>
</body>
</html>