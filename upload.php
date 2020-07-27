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
	.btn_form{
		width:100%;
		margin-top:4px;
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
			<p class="alert alert-warning">这里是通知文档发送平台，所有的通知将以OFFICE文档格式上传到本平台，由于服务器资源有限，单个文档不得大于2MB</p>
		</div>
	</div>
	<div class="panel panel-danger">
		<div class="panel-heading">
			<div class="panel-title">
				<b>上传附件</b> <small style="color:green;margin-left:15px;">[<a href="index.php">回到首页</a>]</small>
			</div>	
		</div>
		<div class="panel-body">
			<form action="?act=upload" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-md-2 control-label">文件名:</label>
					<div class="col-md-10">
						<input class="form-control" name="name" type="text" value="" required="required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">选择文件:</label>
					<div class="col-md-10">
						<input class="form-control" name="file" type="file" required="required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">授权码:</label>
					<div class="col-md-10">
						<input class="form-control" name="code" type="text" value="" required="required">
					</div>
				</div>
				<div class="col-md-offset-2 form-group">
						<div class="col-md-6"><input type="submit" name="submit" class="btn btn_form btn-primary" value="上传发布"> </div>
						<div class="col-md-6"><input type="reset" class="btn btn_form btn-danger" value="重置"> </div>
				</div>	
			</form>
		</div>
		<div class="panel-footer">
			<p>Copyright © 2017 by rains. All rights reserved.</p>
		</div>
	</div>
</div>
</body>
</html>
<?php
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
require_once("config.php");
 if($_GET['act'] == 'upload'){
	if(@$_POST['code'] != $AuthorizationCode){
		die("<script>alert(\"授权失败无法上传！\");</script>");
	}
	if($_FILES['file']['error'] != 0){
		die("<script>alert(\"文件上传出错！\");</script>");
	}
	$format = explode('.',$_FILES['file']['name']);
	$format = $format[count($format)-1];
	//var_dump($format);
	if(($_FILES['file']['size']/1024) >= 2048 ){
		echo "<script>alert(\"{$format}上传文件大小不得超过2M\");</script>";
	}else{
		$time = date('Y-m-d H:i:s');
		$filename = md5($time).'.'.$format;
		//echo $filename;
		if($format == "doc" || $format == "docx"){
			move_uploaded_file($_FILES['file']['tmp_name'], './upload/'.$filename);
			file_put_contents('data.dat',"{$_POST['name']}|:|upload/{$filename}|:|{$time}|:|Word\r\n",FILE_APPEND | LOCK_EX);
			echo '<script>alert("上传发布成功");</script>';
		}elseif($format == "xls" || $format == "xlsx"){
			move_uploaded_file($_FILES['file']['tmp_name'], './upload/'.$filename);
			file_put_contents('data.dat',"{$_POST['name']}|:|upload/{$filename}|:|{$time}|:|Excel\r\n",FILE_APPEND | LOCK_EX);
			echo '<script>alert("上传发布成功");</script>';
		}else{
			echo '<script>alert("不允许上传非Excel以及Word文件");</script>';
		}
	}
}
?>