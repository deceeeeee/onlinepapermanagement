<?php include("conn.php");

session_start();

$name = $_SESSION["sname"];
$email = $_SESSION["semail"];
$namecap = ucwords($name);

$query = "SELECT * FROM paper";

if (isset($_POST['submit'])) {
  $search = $_POST['search'];

  $query .= " WHERE papername LIKE '%$search%' OR authorname LIKE '%$search%' OR publisher LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);
$dataTable = array();

while ($row = mysqli_fetch_assoc($result)) {
  $dataTable[] = $row;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Researcher DashBoard</title>
  <style>
    body {
      background: url("2.jpg");
    }

    .box {
      width: 74%;
      height: 160px;

      background-image: url("1.jpg");
      background-size: cover;
      margin-left: 13%;
      opacity: .9;
      box-shadow: 0px 0px 15px lightgreen;
      border-radius: 12px;
      border: solid 1px #CF0403;
    }

    .boxtwo {
      background-image: url("1.jpg");
      background-size: cover;
      box-shadow: 0px 0px 15px lightgreen;
      border: solid 1px #CF0403;

    }

    ul {
      padding: 10;
      list-style: none;
    }

    ul li {
      float: left;
      width: 248px;
      height: 40px;

      background-color: purple;
      opacity: .8;
      line-height: 40px;
      text-align: center;
      font-size: 20px;
      margin-right: 2px;
    }

    ul li a {
      text-decoration: none;

      color: white;
      display: block;
    }

    ul li a:hover {
      background-color: green;
    }

    ul li ul li {
      display: none;
    }

    ul li:hover ul li {
      display: block;

    }

    .nav {
      float: center;
      padding-left: 50%;


    }

    .box-cnt {

      box-shadow: 0px 0px 15px lightgreen;
      background: rgba(0, 0, 0, 0.38);
      float: left;
      margin-left: 13%;
      border-radius: 12px;
      overflow: auto;
      height: 400px;
      width: 900px;
      margin: 2% 2%;
      float: center;

    }

    .box-cnt-h {
      color: white;
      text-align: center;
      padding-top: 2px;
      padding-bottom: 2px;
      background: #660000;
      border-radius: 12px;

    }

    .box-table {
      color: white;
      text-align: center;
      border-collapse: collapse;
      margin: 3%;
      box-shadow: 0px 0px 10px white;
      height: 150px;
      width: 700px;

    }

    .box-table td,
    tr {
      border: 1px solid white;
    }

    .box-table th {
      text-align: center;
    }

    a {

      color: white;
    }



    .srch {
      float: right;
      padding: 2px;
    }
  </style>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="jQueryA.js"></script>
  <script src="jquery-ui.js"></script>
  <link href="jquery-ui.css" rel="stylesheet">
  <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>



  <div class="box">
    <table style=" font-size:16pt" align="center" width="100%" height="100%">
      <tr>
        <td style="color:black">
          <h1 align="center">
            <marquee><i>Welcome To online Academic Paper Management System System</i> </marquee>
          </h1>
        </td>
      </tr>
      <tr>
        <td><mark style="color:white;background-color:maroon" ;> &nbsp;Welcome

            <b><?php echo $namecap; ?> &nbsp;</b></mark></td>
      </tr>
    </table>
  </div>

  <div class="nav">
    <ul>
      <li><a style="background-color: green" href="sdb.php">HOME</a></li>
      <li><a href="aboutus.php">ABOUT US</a></li>
      <li><a href="index.php">LOGOUT</a></li>
    </ul>

    <br><br>

  </div>

  <div class="boxtwo" style="border-radius: 10px; width:73.5%; height:900px; margin-left:13%;margin-top:10px;background-color:white">



    <!-----_____________________search bar________-->

    <div class="srch">
      <form class="navbar-form" method="post" name="form1">

        <input class="form-control" type="text" name="search" placeholder="Search papers.." required="">
        <button style="background-color: #6db6b9e6" type="submit" name="submit" class="btn btn-defult">
          <span class="glyphicon	glyphicon-search"> </span>
        </button>

      </form>
    </div>



    <div class="box-cnt">
      <h2 class="box-cnt-h">List of Academic Paper</h2>
      <table class="box-table">
        <thead>
          <tr>
            <th>Paper ID</th>
            <th>Paper Name</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Year</th>
            <th>E-paper Name</th>
            <th>Favorite</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($result) == 0) :
          ?>
            <tr>
              <td colspan="7"> <b style="color:red">Sorry! Not Found.</b> </td>
            </tr>
            <?php else :
            foreach ($dataTable as $data) :
            ?>
              <tr>
                <td><?= $data['id'] ?></td>
                <td><?= $data['papername'] ?></td>
                <td><?= $data['authorname'] ?></td>
                <td><?= $data['publisher'] ?></td>
                <td><?= $data['year'] ?></td>
                <td><?= $data['file_name'] ?></td>
                <td>
                  <label for="id-<?= $data['id'] ?>">
                    Favorite <i class="glyphicon glyphicon-star"></i>
                  </span>
                  <input type="checkbox" id="id-<?= $data['id'] ?>" name="<?= $data['id'] ?>">
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

    </div>



  </div>




</body>
<html>