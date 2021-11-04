<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$uri = $protocol.$_SERVER['HTTP_HOST'];
if ((isset($_SESSION['id']))&&(isset($_SESSION['email']))&&(isset($_SESSION['isVerify']))){
    if ($_SESSION['isVerify']==0){
        header("Location: ".$uri."verify/") ;
        exit(); 
    }
    header("Location: ".$uri."app/") ;
    exit(); 

}else{
    header("Location: ".$uri."dangnhap/") ;
    exit();  
}

?>