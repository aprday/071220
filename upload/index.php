<?
//
//   CF Image Hosting Script v1.0
//   -----------------------------
//   download the latest version from - http://codefuture.co.uk/projects/imagehost/
//   Copyright (c) 2010 codefuture.co.uk
//
////////////////////////////////////////////////////////////////////////////////////

	include_once('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="Description" content="Free Image Hosting" />
<meta name="Keywords" content="Free Image Hosting" />
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<meta name="Distribution" content="Global" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<title><?=$title;?></title>
<script type= "text/javascript">
/*<![CDATA[*/
function toggle() {
	var o = document.getElementById('suc');
	var d = document.getElementById('err');
	if(o) fade('suc',false);
	if(d) fade('err',false);
	fade('uploading',true);
}
	var fadeOpacity  = new Array();
	var fadeTimer    = new Array();
	var fadeInterval = 100;  // milliseconds

function fade(o,d){
	// o - Object to fade in or out.
	// d - Display, true =  fade in, false = fade out
	var obj = document.getElementById(o);
	if((fadeTimer[o])||(d&&obj.style.display!='block')||(!d&&obj.style.display!='none')){
		if(fadeTimer[o])
			clearInterval(fadeTimer[o]);
		else
			if(d) fadeOpacity[o] = 0;
			else  fadeOpacity[o] = 9;

		obj.style.opacity = "."+fadeOpacity[o].toString();
		obj.style.filter  = "alpha(opacity="+fadeOpacity[o].toString()+"0)";

		if(d){
			obj.style.display = 'block';
			fadeTimer[o] = setInterval('fadeAnimation("'+o+'",1);',fadeInterval);
		}else
			fadeTimer[o] = setInterval('fadeAnimation("'+o+'",-1);',fadeInterval);
	}
}

function fadeAnimation(o,i){
	// o - o - Object to fade in or out.
	// i - increment, 1 = Fade In
	var obj = document.getElementById(o);
	fadeOpacity[o] += i;
	obj.style.opacity = "."+fadeOpacity[o].toString();
	obj.style.filter  = "alpha(opacity="+fadeOpacity[o].toString()+"0)";

	if((fadeOpacity[o]=='9')|(fadeOpacity[o]=='0')){
		if(fadeOpacity[o]=='0')
			obj.style.display = 'none';
		else{
			obj.style.opacity = "1";
			obj.style.filter  = "alpha(opacity=100)";
		}
		clearInterval(fadeTimer[o]);
		delete(fadeTimer[o]);
		delete(fadeTimer[o]);
		delete(fadeOpacity[o]);
	}  
}
/*]]>*/
</script>
</head>
<body>
<div id="wrap">
	<div id="header">
		<h1 id="logo-text"><a href="https://chez.baidu.re"><b><?=$title ?></b></a></h1>
		
	</div>
	<div id="content">
<?php
// print errors to page
	echo error_note($Err);

// print image code
	echo $img_posted

?>
			<div id="uploading" class="loading">
				<label>正在上传中...稍等.....<img src="img/loading.gif" alt="Uploading Image" /></label>

			</div>
			<form enctype="multipart/form-data" action="<?= preg_replace('/\/([^\/]+?)$/', '/', $_SERVER['PHP_SELF']) ?>" method="post" onsubmit="toggle();">
				<label for="file">Image to upload: </label>
				<div class="file_input_div"><input type="text" id="fileName" class="text_input" readonly="readonly">
					<input type="button" value="浏览..." name="Search files" class="file_input_button" />
					<input type="file" name="file" id="file" class="file_input_hidden" onchange="javascript: document.getElementById('fileName').value = this.value"/>
				</div>
				<b>支持上传格式:<font color=#007cdc><?=$types;?></font> 
				文件限制: <font color= #ff1244><?=$maxsize_mb;?>MB</b></font> <br />
				<label for="alt">图片说明：（可不填）</label><input type="text" name="alt" id="alt" class="text_input" /><br><br>
				<input name="submit" type="submit" value="开始上传" class="button"> 
			</form>
		<div class="right_col">

		<ul>
			<b><li>图片上传，免费上传图片</li></b>
			<li>支持上传格式:png, jpg, jpeg, gif, ico, bmp  </li>
			<li>文件限制: 1.5MB</li>
			<li>禁止上传任何违反法律的图片.将被删除！</li>
			<li>本站仅提供图片/文件存储空间服务</li>
			<li>图片上传者应自行负责所上传图片/文件涉及的法律责任</li>
			<li>本站对图片合法性概不负责，亦不承担任何法律责任</li><br />
			<li><font color="red">违规图片投诉邮箱：jubao(at)baidu.re</font></li>
		</ul>

		</div>
		<div class="clear"></div>
	</div>
	<div id="footer">
		<p>Copyright &copy; 2009-<?=date('Y');?> <?=$title ?> - 本站由2009年稳定至今的chez.com驱动.<br/><br/>
		<span id="runtime_span"></span><br />
		<script type="text/javascript">function show_runtime(){window.setTimeout("show_runtime()",1000);X=new 
		Date("5/14/2019 12:00:00");
		Y=new Date();T=(Y.getTime()-X.getTime());M=24*60*60*1000;
		a=T/M;A=Math.floor(a);b=(a-A)*24;B=Math.floor(b);c=(b-B)*60;C=Math.floor((b-B)*60);D=Math.floor((c-C)*60);
		runtime_span.innerHTML="本站稳定运行: "+A+"天"+B+"小时"+C+"分"+D+"秒"}show_runtime();</script>
		</p>
	</div>
</div>
</body>
</html>