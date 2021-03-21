<?php include("conn.php");

session_start();

if(empty($_SESSION)) {
  header('Location: index.php');die;
}

$uid   = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$name = $_SESSION["sname"];
$email = $_SESSION["semail"];
$namecap = ucwords($name);

$search = '';

define('ACTION_SEARCH', 1);
define('ACTION_FAVORITE', 2);

$query = "SELECT p.*, rfp.user_id FROM paper p LEFT JOIN researcher_favorite_paper rfp ON p.id = rfp.paper_id WHERE (user_id IS NULL OR user_id = $uid)";

if(isset($_POST['action']) && $action = $_POST['action']) {
  switch($action) {
    case ACTION_SEARCH:
      $search = isset($_POST['search']) ? trim($_POST['search']) : '';
      
      $query .= " AND papername LIKE '%$search%' OR authorname LIKE '%$search%' OR publisher LIKE '%$search%'";
      break;
    case ACTION_FAVORITE:
      $paper_id = isset($_POST['paper_id']) ? $_POST['paper_id'] : 0;
      $fav_or_not = isset($_POST['favorite']) && $_POST['favorite'] === 'true';
      $return_val = 0;

      if($paper_id) {
        if(!$fav_or_not) {
          $q = "DELETE FROM researcher_favorite_paper WHERE user_id = '$uid' AND paper_id = '$paper_id'";
        } else {
          $q = "INSERT INTO researcher_favorite_paper VALUES('$uid', '$paper_id')";
        }

        mysqli_query($conn, $q);

        $return_val = mysqli_affected_rows($conn);
      }

      echo $return_val;
      die;
      
      break;
  }
}

$result = mysqli_query($conn, $query);
$dataTable = array();

while ($row = mysqli_fetch_assoc($result)) {
  $dataTable[] = $row;
}

if($search !== '' && !empty($dataTable)) {
  $query = "INSERT INTO researcher_keyword VALUES($uid, '$search')";

  mysqli_query($conn, $query);
}

// Recommended papers
$res = mysqli_query($conn, "SELECT keyword FROM researcher_keyword WHERE user_id = $uid LIMIT 0, 10");
while ($row = mysqli_fetch_assoc($res)) {
  $keywords[] = "'%" . $row['keyword'] . "%'";
}

// Construct Query
if(isset($keywords) && count($keywords)) {
  $query_build = "SELECT * FROM paper WHERE ";
  $params = [];

  foreach($keywords as $keyword) {
    $params[] = "papername LIKE $keyword OR
                      authorname LIKE $keyword OR
                      publisher LIKE $keyword";
  }

  $query_build .= implode(" OR ", $params);

  $res = mysqli_query($conn, $query_build);
  while($row = mysqli_fetch_assoc($res)) {
    $recommendedPaper[] = $row;
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Researcher DashBoard</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- <script src="jQueryA.js"></script>
  <script src="jquery-ui.js"></script>
  <link href="jquery-ui.css" rel="stylesheet"> -->
  <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

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

    .text-notify {
      display: none;
      text-align: center;
    }

    .srch {
      float: right;
      padding: 2px;
    }
  </style>

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

  <div class="row" style="margin-left: 9%;">
    <div class="col-sm-10">
      <ul>
        <li><a style="background-color: green" href="sdb.php">HOME</a></li>
        <li><a href="aboutus.php">ABOUT US</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
      </ul>
      <br><br>    
    </div>

  </div>

  <div class="boxtwo" style="border-radius: 10px; width:73.5%; height:900px; margin-left:13%;margin-top:10px;background-color:white">



    <!-----_____________________search bar________-->

    <div class="srch">
      <form class="navbar-form" method="post" name="form1">

        <input class="form-control" type="text" name="search" placeholder="Search papers.." value="<?= $search ?>">
        <button style="background-color: #6db6b9e6" type="submit" name="action" value="<?= ACTION_SEARCH ?>" class="btn btn-default">
          <span class="glyphicon	glyphicon-search"> </span>
        </button>

      </form>
    </div>


    <div class="box-cnt">
      <h2 class="box-cnt-h">List of Academic Paper</h2>
      <div class="col-md-12">
        <span class="text-notify text-success text-center"></span>
      </div>
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
          if (count($dataTable) <= 0) :
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
                  <input type="checkbox" id="id-<?= $data['id'] ?>" class='fav-checkbox' value="<?= $data['id'] ?>" <?= ($data['user_id'] ? 'checked' : '' ) ?>>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

    </div>

    <?php if(count($keywords)): ?>
    <div class="box-cnt">
    <h2 class="box-cnt-h">Recommended Papers</h2>
      <table class="box-table">
        <thead>
          <tr>
            <th>Paper ID</th>
            <th>Paper Name</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Year</th>
            <th>E-paper Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (count($recommendedPaper) <= 0) :
          ?>
            <tr>
              <td colspan="7"> <b style="color:red">Sorry! Not Found.</b> </td>
            </tr>
            <?php else :
            foreach ($recommendedPaper as $data) :
            ?>
              <tr>
                <td><?= $data['id'] ?></td>
                <td><?= $data['papername'] ?></td>
                <td><?= $data['authorname'] ?></td>
                <td><?= $data['publisher'] ?></td>
                <td><?= $data['year'] ?></td>
                <td><?= $data['file_name'] ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

    </div>
    <?php endif; ?>

  </div>



<script>
  $(document).ready(function(){
    $('.fav-checkbox').change(function(){
      var paperId = $(this).val();
      var favs = $(this).prop("checked");

      $.ajax({
        url: location.href,
        type: 'POST',
        data: {
          action: <?= ACTION_FAVORITE ?>,
          paper_id: paperId,
          favorite: favs
        },
        dataType: 'JSON',
        success: function(res) {
          if(res > 0) {
            $('.text-notify').text('Successfully ' + (favs ? 'select' : 'unselect') + ' paper as favorite');
            $('.text-notify').show();
          } 

          setTimeout(function(){
            location.reload();
          }, 3000);
        }
      });
    });
  });
</script>

</body>
<html>