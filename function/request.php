 <?php
 
    $databaseName="tinydeve_tinydevelop";
    // $databaseName="tinydevelop";
    $databaseUser="tinydeve_admin";//"root";
    $databasePass="Caoky99#";
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname='.$databaseName,$databaseUser,$databasePass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?> 