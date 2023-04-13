<?php
function waf($str){
    return preg_match("/or|information_schema|load|updatexml|and|sleep|if|\/\*\*\/|=|;/i",$str);
}
$conn = mysqli_connect("127.0.0.1","root","root","test");
$name = $_FILES['file']['name'];

if(waf($name)){
    die("文件名包含非法字符\n");
}
if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload_file/1.txt')){
    print_r("文件上传成功,路径为upload_file/1.txt\n");
}
$sql = "select * from users where username='$name';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

if($row){
    print_r("{$row['username']}用户存在,文件保留");
}
else{
    print_r("用户不存在,文件删除");
    unlink("upload_file/1.txt");
}
