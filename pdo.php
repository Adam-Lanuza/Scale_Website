<!--Connects the php to mysql-->
<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=scalesite", "admin", "scaleable");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);?>

<!--If you want, you can change "admin" and "scaleable" into any username and password you want. Just make sure that they are the same values as the GRANT statement-->