<?php
//
//   CF Image Hosting Script v1.0.2
//   -------------------------------
//   v1.0.2 fix (02 may 2010)
//   Remote File Inclusion Vulnerability
//
//   UPDATE v1.0.1
//   Bug fix: File Disclosure Vulnerability
//
//   download the latest version from - http://codefuture.co.uk/projects/imagehost/
//   Copyright (c) 2010 codefuture.co.uk
//
////////////////////////////////////////////////////////////////////////////////////


// Site url points to the folder with the script in it (Without Trailing slash)
// e.g. $siteurl = "http://www.codefuture.co.uk/imagehost";
	$siteurl = "https://chez.baidu.re";

// Site Title
	$title = "摆渡图床";

// Site Slogan
	$slogan = "Free Image Host";

// Max File Size in bytes
// 1024*1024 is 1MB
// 1024*1024*1.5 is 1.5MB
// 1024*1024*2 is 2MB and so on
	$maxsize = 3000*3000*5;


////////////////////////////////////////////////////////////////////////////////////
//Optional - in most cases the there will be no need to edit below

// directory For Image Uploads
	$filedir = "u";

// Image Formats
	$accepted = array('png', 'jpg', 'jpeg', 'gif', 'ico', 'bmp');
	$acceptedtyp = array('image/png', 'image/x-png', 'image/pjpeg', 'image/jpg', 'image/jpeg', 'image/gif', 'image/ico', 'image/bmp');

// var for page
	$maxsize_mb = round(($maxsize / 1048576), 2);
	$types = implode(", ",$accepted);

////////////////////////////////////////////////////////////////////////////////////
// IMAGE LINK

	if (isset($_GET['img'])){
		$img_name= end(explode('/',input($_GET['img'])));
		preg_match('/\.([a-zA-Z]+?)$/', $img_name, $ext);
		$IMG_ADDRESS = $filedir."/".$img_name;
		if ($img_name !='' && file_exists($IMG_ADDRESS) && in_array(strtolower($ext[1]), $accepted)){
			header('Content-type: image/'.$ext[1]);
			readfile($IMG_ADDRESS);
			exit();
		}else
			$Err = "No Image by that name was found!";
	}

// IMAGE LINK END
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
// UPLOAD CODE START

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$get_img = @getimagesize($_FILES['file']['tmp_name']);
	$err_get_img	= false;

	//min size(pixels)
		if ($get_img[0] < 16 || $get_img[1] < 16 ){
			$err_get_img = true;
		}

	// max size(pixels)
		if ($get_img[0] > 1920 || $get_img[1] > 1920 ){
			$err_get_img = true;
		}

	//Check to see if the image is a accepted type
		preg_match('/\.([a-zA-Z]+?)$/', $_FILES['file']['name'], $ext);
		if ((in_array(strtolower($ext[1]), $accepted)) &&
			(in_array(strtolower($_FILES["file"]["type"]), $acceptedtyp)) &&
			!$err_get_img) {

		//Check if the file size is less than $maxsize
			if($_FILES['file']['size'] <= $maxsize) {

			//new random name
				$newname = rand(0,32).time().".".$ext[1];

			//Check the image size width & height
				$imgsize = getimagesize($_FILES['file']['tmp_name']);
				If ($imgsize[0]>=$imgsize[1])$img_size =' width="280"';
				else $img_size =' height="210"';

			//Attempt to move the uploaded file to it's new place
				if (move_uploaded_file($_FILES['file']['tmp_name'],$filedir."/".$newname)) {

				// Page output
					$linkurl = '$siteurl.preg_replace('/\/([^\/]+?)$/', '/', $_SERVER['PHP_SELF']).'#'.$newname;
					$linkurl = '$siteurl.preg_replace$siteurl.preg_replace('/\/([^\/]+?)$/', '/', $_SERVER['PHP_SELF']).'u/'.$newname;
					$alt = input($_POST["alt"]);
					$bookmarking = bookmarking($imgurl,$alt);
					$img_posted = '<div class="img_box"><a href="'.$imgurl.'" target="_blank"><img src="'.$imgurl.'"'.$img_size.' alt="chez.baidu.re" /></a></div>
						<div class="right_col">
						<label for="codebb">论坛代码:</label><input type="text" id="codebb" value="[IMG]'.$imgurl.'[/IMG]" onclick="javascript:this.focus();this.select();" readonly="true" class="text_input long" /><br />
						<label for="codelbb">带连接的论坛代码:</label><input type="text" id="codelbb" value="[URL='.$siteurl.'][IMG]'.$imgurl.'[/IMG][/URL]" onclick="javascript:this.focus();this.select();" readonly="true" class="text_input long" /><br />
						<label for="codehtml">HTML代码: </label><input type="text" id="codehtml" value=\'&lt;a href="'.$siteurl.'" title="'.$alt.'" &gt;&lt;img src="'.$imgurl.'" alt="'.$alt.'" /&gt;&lt/a&gt;\' onclick="javascript:this.focus();this.select();" readonly="true" class="text_input long" /><br />
						<label for="codedirect">图片外链地址:(email &amp; IM)</label><input type="text" id="codedirect" value="'.$imgurl.'" onclick="javascript:this.focus();this.select();" readonly="true" class="text_input long" />
					</div><div class="clear"></div><div id="suc" class="notification success"><div><b>图片上传成功！</b></div></div>';

	// Errors -------------------
				}else // move the uploaded file
					$Err .= "文件上传过程中出现的一个问题！<br/>";
			}else // more than 1mb $maxsize
				$Err .= "文件超过 $maxsize_mb MB大小,<br/>";
		}else // file type
			$Err .=  "只支持 $types 格式上传<br/>"; // bebug file type strtolower($_FILES["file"]["type"])
	}

// UPLOAD CODE END
////////////////////////////////////////////////////////////////////////////////////

function error_note($myproblem) {
	if(isset($myproblem))
		return "<div id=\"err\" class=\"notification error\"><div><b>发生错误:</b> ".$myproblem."</div></div>";
}

function input($in){
	$in = trim($in);
	if (strlen($in) == 0)
		return;
	return htmlspecialchars(stripslashes($in));
}

function bookmarking($document_url,$document_title){
	$social_sites = array(
		"tqq" => "http://v.t.qq.com/share/share.php?url={url}&title={title}&appkey=5ed332fb525f4fe0b8ae9ac3f10112c9&pic={url}",
		"sina" => "http://v.t.sina.com.cn/share/share.php?appkey=2514157622&url={url}&title={title}&pic={url}",
"qzone" => "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={url}&title={title}&pics={url}",

"pengyou" => "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?to=pengyou&url={url}&title={title}&pics={url}&site=upload.tf",
"renren" => "http://share.renren.com/share/buttonshare?link={url}&title={title}",

		
);
	krsort($social_sites);
	foreach($social_sites as $social_site=>$social_url){
		$social_icon = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $social_site));
		$url = str_replace("{title}",urlencode($document_title),str_replace("{url}",urlencode($document_url),$social_url));
		$text .= " <a href=\"$url\" title=\"Submit to $social_site\" rel=\"nofollow\" target=\"_blank\"><img src=\"img/$social_icon.png\" alt=\"Submit to $social_site\" /></a>";
	}
	return "<div class=\"bookmarking\">".$text."</div>\n";
}
?>