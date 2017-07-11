<?php
session_start();
$con = mysqli_connect("localhost","root","","PitchDeck");
function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}
if(isset($_POST['submit'])){

  if(isset($_POST['username']))
  $username = $_POST['username'];

  if(isset($_POST['password'])){
    $password = $_POST['password'];
  }

  $query = "Select * FROM Admin WHERE username='$username'";

  $res = mysqli_query($con, $query);
  $row = mysqli_fetch_row($res);
  $hash = $row[2];
  $salt = $row[3];
  $adminid = $row[0];
  $saltpassword = $password . $salt;
  $userhash = hash('sha256',$saltpassword);

  if($userhash == $hash){
    $_SESSION["loggedin"] = "yes";
    date_default_timezone_set('Asia/Kolkata');
    $date = date('y/m/d h:i:s', time());
    $sql = "Insert into Logs VALUES('', '$date' , $adminid)";
    $result = mysqli_query($con,$sql);
    header("Location: http://localhost/pitch-deck/admin.php");
  }
  else{
    $_SESSION["loggedin"] = "no";
  }
}
?>
<html>
<head>
  <link href="http://localhost/pitch-deck/css/login.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      </form>
    <form class="login-form" action="login.php" method="post">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button name="submit" type="submit">login</button>
      <?php
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]=="no"){
      ?>
      <div class="alert alert-danger">
        <p>Invalid username or password</p>
      </div>
      <?php
      session_unset();

    }

       ?>

    </form>
  </div>
</div>
<script src="js/login.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
</body>
</html>
