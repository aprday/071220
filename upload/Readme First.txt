基于CF Image Hosting Script 1.0.2v 汉化修改版...

CF Image Hosting Script 官方最新版的已经v1.4.2。 不过不喜欢那个界面.

简单就行...

分享代码换成了 腾讯微博/新浪微博/人人网/QQ空间/腾讯朋友网/...

图片目录:u 
如果修改掉后请修改config.php里面的
     $filedir = "u"; 文件夹目录
     $imgurl = 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/\/([^\/]+?)$/', '/', $_SERVER['PHP_SELF']).'u/'.$newname;
里面的u/ 即可

Google广告自行修改下...

CF Image Hosting Script 1.0.2v
-------------------------------
download the latest version from - http://codefuture.co.uk/projects/imagehost/

update for 1.0.2v
***BUG FIX: Remote File Inclusion Vulnerability

update for 1.0.1v
***BUG FIX: File Disclosure Vulnerability

Install instructions :
To get the script woring open config.php with any text editor and folow the instructions.




Copyright (c) 2010 codefuture.co.uk
-----------------------------------

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.



