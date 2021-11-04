<?php 
ob_start(); 
session_start();

?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Đăng ký</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/dangky.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <form class="form-horizontal" role="form" method="POST">
                <h2>Registration</h2>
                <?php
                          if (isset($_SESSION['error'])){
                            echo "<small style='color:red;'>".$_SESSION['error']."</small>";
                            unset($_SESSION['error']);
                          }
                        ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Họ</label>
                      <input type="text" class="form-control" name="surname" placeholder="Họ" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tên</label>
                      <input type="text" class="form-control" name="name" placeholder="Tên" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="mail" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label>Nhập lại password</label>
                    <input type="password" class="form-control" name="repass" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label>Sinh nhật</label>
                    <input type="date" class="form-control" name="birthday" required>
                  </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Giới tính</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" checked value=0>Nữ
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value=1>Nam
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <small>Tất cả thông tin trên đều bắt buộc</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                <a href="../dangnhap/" class="btn btn-outline-primary btn-block">Trở về</a>

            </form> <!-- /form -->
        </div> <!-- ./container -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
<?php
  $_dir="/function/";
  $url = $_SERVER['DOCUMENT_ROOT'];
  require $url.$_dir."getinform.php";
  if (isset($_SESSION['email'])){
    header("Location: ../") ;
    exit(); 
  }
  if (isset($_POST)){
    if((isset($_POST['mail'])&&(isset($_POST['pass'])))){
    if (checkMail($_POST['mail'])==false){
      register($_POST['mail'],$_POST['pass'],$_POST['surname'],$_POST['name'],$_POST['gender'],$_POST['birthday']); 
      createVerify($_POST['mail']);
    }else{
      $_SESSION['error']="Email đã tồn tại!";
    }
    header("Location: ./") ;
    exit(); }
  }
?>


<?php ob_flush(); ?>