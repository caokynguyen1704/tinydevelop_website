
<?php
$_dir__="/function/";
$urlmain = $_SERVER['DOCUMENT_ROOT'];

function isVerify($mail){
    $_dir__="/function/";
    $urlmain = $_SERVER['DOCUMENT_ROOT'];

    require $urlmain.$_dir__."request.php";
    $sql="SELECT * from member where email= :mail";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':mail'=>$mail
    ));
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($rows)>0){
        return $rows[0]['isVerify'];
    }
    return 0;
}
function login($mail,$pass){
    $_dir__="/function/";
    $urlmain = $_SERVER['DOCUMENT_ROOT'];
    require $urlmain.$_dir__."request.php";
    $sql="SELECT * from member where email= :mail and pass= :pass";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':mail'=>$mail,
        ':pass'=>md5($pass)
    ));
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function checkMail($mail){
    $_dir__="/function/";
    $urlmain = $_SERVER['DOCUMENT_ROOT'];
    require $urlmain.$_dir__."request.php";
    $sql="SELECT * from member where email= :mail";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':mail'=>$mail
    ));
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($rows)>=1){
        return true;
    }
    return false;
}
function register($mail,$pass,$surname,$name,$gender,$birthday){
    $_dir__="/function/";
    $urlmain = $_SERVER['DOCUMENT_ROOT'];
    require $urlmain.$_dir__."request.php";
    $sql="INSERT INTO `member`(`email`, `pass`, `surname`, `name`, `gender`,`birthday`) VALUES (:mail, :pass, :surname, :name, :gender, :birthday)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':mail'=>$mail,
        ':pass'=>md5($pass),
        ':surname'=>$surname,
        ':name'=>$name,
        ':gender'=>$gender,
        ':birthday'=>$birthday
    ));
}
function sendVeify($mail,$code){
    $uri = $_SERVER['REQUEST_URI'];
    $to      = $mail;
    $subject = "Xác Thực Email- TinyDevelop.com";
    $message = "Vui lòng truy cập vào link này để xác thực tài khoản của bạn:\n".$uri."verify?code=".$code;
    $header  =  "From: kihitpro99@gmail.com \r\n";

    $success = mail ($to,$subject,$message,$header);

    if( $success == true )
    {
        $_SESSION['mail']="<small style='color:green'>Thành công!!!</small>";
       return true;
    }
    $_SESSION['mail']="<small style='color:red'>Lỗi!!!</small>";
    return false;
}

function getVerify($email){
    $_dir__="/function/";
    $urlmain = $_SERVER['DOCUMENT_ROOT'];
    require $urlmain.$_dir__."request.php";
    $sql="SELECT * from `verifyemail` where email= :mail";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':mail'=>$email
    ));
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function createVerify($email){
    $rows=getVerify($email);
    $code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -5);
    if(count($rows)>0){
        $_dir__="/function/";
        $urlmain = $_SERVER['DOCUMENT_ROOT'];
        require $urlmain.$_dir__."request.php";
       
        $sql="UPDATE `verifyemail` SET `verifyCode`=:code,`email`=:email WHERE id= :id";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
            ':code'=>md5($email.$code),
            ':email'=>$email,
            ':id'=>$rows[0]['id']
        ));
       
    }else{
        $sql="INSERT INTO `verifyemail`(`verifyCode`,`email`) VALUES (:code, :email)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
            ':code'=>md5($email.$code),
            ':email'=>$email
        ));
    }
    sendVeify($email,md5($email.$code));
}
?>