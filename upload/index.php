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
				<label>�����ϴ���...�Ե�.....<img src="img/loading.gif" alt="Uploading Image" /></label>

			</div>
			<form enctype="multipart/form-data" action="<?= preg_replace('/\/([^\/]+?)$/', '/', $_SERVER['PHP_SELF']) ?>" method="post" onsubmit="toggle();">
				<label for="file">Image to upload: </label>
				<div class="file_input_div"><input type="text" id="fileName" class="text_input" readonly="readonly">
					<input type="button" value="���..." name="Search files" class="file_input_button" />
					<input type="file" name="file" id="file" class="file_input_hidden" onchange="javascript: document.getElementById('fileName').value = this.value"/>
				</div>
				<b>֧���ϴ���ʽ:<font color=#007cdc><?=$types;?></font> 
				�ļ�����: <font color= #ff1244><?=$maxsize_mb;?>MB</b></font> <br />
				<label for="alt">ͼƬ˵�������ɲ��</label><input type="text" name="alt" id="alt" class="text_input" /><br><br>
				<input name="submit" type="submit" value="��ʼ�ϴ�" class="button"> 
			</form>
		<div class="right_col">

		<ul>
			<b><li>ͼƬ�ϴ�������ϴ�ͼƬ</li></b>
			<li>֧���ϴ���ʽ:png, jpg, jpeg, gif, ico, bmp  </li>
			<li>�ļ�����: 1.5MB</li>
			<li>��ֹ�ϴ��κ�Υ�����ɵ�ͼƬ.����ɾ����</li>
			<li>��վ���ṩͼƬ/�ļ��洢�ռ����</li>
			<li>ͼƬ�ϴ���Ӧ���и������ϴ�ͼƬ/�ļ��漰�ķ�������</li>
			<li>��վ��ͼƬ�Ϸ��ԸŲ������಻�е��κη�������</li><br />
			<li><font color="red">Υ��ͼƬͶ�����䣺jubao(at)baidu.re</font></li>
		</ul>

		</div>
		<div class="clear"></div>
	</div>
	<div id="footer">
		<p>Copyright &copy; 2009-<?=date('Y');?> <?=$title ?> - ��վ��2009���ȶ������chez.com����.<br/><br/>
		<span id="runtime_span"></span><br />
		<script type="text/javascript">function show_runtime(){window.setTimeout("show_runtime()",1000);X=new 
		Date("5/14/2019 12:00:00");
		Y=new Date();T=(Y.getTime()-X.getTime());M=24*60*60*1000;
		a=T/M;A=Math.floor(a);b=(a-A)*24;B=Math.floor(b);c=(b-B)*60;C=Math.floor((b-B)*60);D=Math.floor((c-C)*60);
		runtime_span.innerHTML="��վ�ȶ�����: "+A+"��"+B+"Сʱ"+C+"��"+D+"��"}show_runtime();</script>
		</p>
	</div>
</div>
</body>
</html>