<?php 
ob_start(); 
session_start();



?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Đăng nhập</title>
    
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
                        <h3 class="text-center mb-0">Đăng Nhập</h3>
                        <p class="text-center">Làm mọi thứ dễ dàng hơn</p>
                        <?php if(isset($_SESSION['error'])){
                            echo "<small style='color:red'>".$_SESSION['error']."</small>";
                            unset($_SESSION['error']);
                        };?>
                        <form action="" class="login-form" method="POST">
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-user"></span>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-lock"></span>
                                </div>
                                <input type="password" class="form-control" name="pass" placeholder="Password" required="">
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-100 text-md-right">
                                    <a href="../quenmatkhau/index.html">Quên mật khẩu</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login" class="btn form-control btn-primary rounded submit px-3">Đăng nhập</button>
                            </div>
                        </form>
                        <div class="w-100 text-center mt-4 text">
                            <p class="mb-0">Không có tài khoản?</p>
                            <a href="../dangky/">Đăng Ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    </body></html>
    <?php
     $_dir="/function/";
     $url = $_SERVER['DOCUMENT_ROOT'];
     require $url.$_dir."getinform.php";
    if (isset($_POST['login'])){
        if ((isset($_POST['email']))&&(isset($_POST['pass']))){
            $row=login($_POST['email'],$_POST['pass']);
            if (count($row)>0){
                $_SESSION['email']=$row[0]['email'];
                $_SESSION['id']=$row[0]['id'];
                $_SESSION['isVerify']=$row[0]['isVerify'];
            }else{
                $_SESSION['error']="Sai thông tin đăng nhập";
            }
            header("Location: ../") ;
            exit(); 
        }
    }
    ?>


<?php ob_flush(); ?>