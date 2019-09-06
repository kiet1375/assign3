<?php include("model/Register.php"); ?>
<?php include("model/AES256.php"); ?>

<?php
$obj = new Register;
$obj-> setName($_POST["name"]);
$obj-> setEmail($_POST["email"]);
$obj-> setPassword($_POST["password"]);
$en = new AES256;
$en-> encrypt($_POST["password"]);
?>

<html>
<body>
name: <?php $obj-> getName() ?><br>
Your email address is: <?php $obj-> getEmail() ?><br>
password: <?php $obj-> getPassword() ?>
password: <?php $en-> getEncypted()  ?>
 <?php $message = $en-> decrypt($en->secret, $en->encrypted)  ?>
password: <?php echo $message  ?>
</body>
</html>