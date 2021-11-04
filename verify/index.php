<?php 
ob_start(); 
session_start();


?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Xác Thực Email</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/login.css">
    </head>
    <body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap py-5">
                        <h3 class="text-center mb-0">Verify Email</h3>
                        <center><?php
                        if (isset($_SESSION['mail'])){
                            echo  $_SESSION['mail'];
                            unset($_SESSION['mail']);
                        }
                        ?></center>
                        <p class="text-center">Chúng tôi đã gửi email xác thực về <?php if(isset($_SESSION['email'])){echo $_SESSION['email'];};?> của bạn vui lòng xác thực bằng cách nhấn vào link trong email</p>
                        <form action="" class="login-form" method="POST">
                            <div class="form-group">
                                <button type="submit" class="btn form-control btn-primary rounded submit px-3 disable" disabled name="verify" >Chưa nhận được email <div class="countdown"></div></button>
                                <a href="../logout/" class="btn btn-outline-primary btn-block rounded submit px-3">Đăng Xuất</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        var timer2 = "1:01";
        var interval = setInterval(function() {
            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
            if ((minutes==-1)){
                $('.countdown').empty();
                $('button[name="verify"]').prop('disabled', false);
            }
        }, 1000);
    </script>
    </body></html>
    <?php

     $_dir="/function/";
     $url = $_SERVER['DOCUMENT_ROOT'];
     require $url.$_dir."getinform.php";

     $_SESSION['isVerify']=isVerify($_SESSION['email']);
     if (isset($_SESSION['isVerify'])){
         if ($_SESSION['isVerify']){
            header("Location: ../") ;
            exit();
         }
     }else{
        header("Location: ../") ;
        exit();
     }
        if(isset($_SESSION['verify'])){
            header("Location: ../") ;
            exit();
        }
        if ((isset($_POST['verify']))&&(isset($_SESSION['email']))){
            createVerify($_SESSION['email']);
            header("Location: ./") ;
            exit();
        }
    ?>
    

    <?php ob_flush(); ?>