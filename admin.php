<?php
session_start();

if( isset($_POST['logout']) ){
  session_unset();
}

if(isset($_SESSION["loggedin"])){
  // $con = mysqli_connect("localhost", "root", "" , "PitchDeck");
  $con = mysqli_connect("wp-4thwheel.cc5ugz0t5ghl.us-west-2.rds.amazonaws.com", "admin", "Qwer!234" , "PitchDeck");

  $query = "Select * from Users";
  $result = mysqli_query($con, $query);
  $num = mysqli_num_rows($result);
  function mysqli_result($res, $row, $field=0) {
      $res->data_seek($row);
      $datarow = $res->fetch_array();
      return $datarow[$field];
  }
}
else{
  header("Location: http://www.3mindsdigital.com/pitchdeck/login.php");
  // header("Location: http://localhost/pitch-deck/login.php");

}


?>
<html lang="en">

<head>
  <style>
  table {
    font-family: arial, sans-serif;
    font-size:22px;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
  </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Power Point Design Service Digital - Power Point</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body id="page-top" class="index">
  <div>
    <a href="index.php">Go to Home page </a>
  </div>
  <div>
    <form action="" method="post">
      <Button type="submit" name="logout">Logout</Button>
    </form>
  </div>
  <div class="container">
      <table>
        <tr>
        <th>Company/First Name</th>
        <th>E-mail</th>
        <th>Message</th>
        <th>PPT</th>
        </tr>
  <?php
$i=0;
while($i<$num){
  $name = mysqli_result($result,$i,"Name");
  $email = mysqli_result($result,$i,"Email");
  $msg = mysqli_result($result,$i,"Message");
  $ppt = mysqli_result($result,$i,"PPT");
  $pptname = explode('/',$ppt);

  ?>
  <tr>
    <td><?php echo $name ?></td>
    <td><?php echo $email ?></td>
    <td><?php echo $msg ?></td>
    <td><a href= <?php echo $ppt ?> ><?php echo $pptname[5]; ?></a></td>
  </tr>

<?php
$i++;
}
?>

</table>
</div>


    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->

    <script src="js/freelancer.min.js"></script>

  </body>

</html>
