<?php
include("conn.php");

define('ACTION_GET_KEYWORD_DETAIL', 1);

if(isset($_POST['action']) && $_POST['action'] == ACTION_GET_KEYWORD_DETAIL) {
  $keyword = trim($_POST['keyword']);

  $res = mysqli_query($conn, "SELECT papername, authorname, publisher 
  FROM paper 
  WHERE papername LIKE '%$keyword%' OR 
  authorname LIKE '%$keyword%' OR 
  authorname LIKE '%$keyword%'
  LIMIT 0, 3;");
  while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
  }

  echo json_encode($data);die;
}

?>

<html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
    body {
      background: url("2.jpg");
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      height: auto;
      text-align: center;
      color: white;
      font-weight: bold;

    }

    th {
      font-size: 17px;
      text-decoration: underline;
      font-style: italic;
    }

    .main {
      width: 80%;
      box-shadow: 0px 0px 20px red;
      border-radius: 20px;
      overflow: auto;
      margin-left: 10%;
      margin-top: 2%;
      height: 270px;
      background: rgba(0, 0, 0, 0.57);
    }

    .box {
      width: 74%;
      height: 160px;
      background-image: url("1.jpg");
      background-size: cover;
      margin-left: 13%;
      opacity: .9;
      border: solid 1px #CF0403;
      border-radius: 12px;

    }

    .boxtwo {
      background-image: url("1.jpg");
      background-size: cover;
      box-shadow: 0px 0px 15px lightgreen;
      border-radius: 12px;
    }

    ul {
      padding: 0;
      list-style: none;
    }

    ul li {
      float: left;
      width: 200px;
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
      padding-left: 12%;

    }

    .three {
      margin-left: 60%;
      margin-top: 5px;
      box-shadow: 0px 0px 15px green;
    }

    button {
      margin-top: 10px;
    }

    button.detail {
      border: none;
      outline: none;
      background-color: rgba(0,0,0,0);
      cursor: pointer;
      color: inherit;
    }

    button.detail:hover {
      text-decoration: underline;
    }

    /* Statistic box */
    .statistic-box {
      display: flex;
      padding: 10px;
      margin-top: 2rem;
    }

    .statistic-box .statistic-container {
      border-radius: 12px;
      background-color: rgba(0, 0, 0, 0.3);
      width: 50%;
      padding: 10px;
      color: white;
    }
  </style>


  <title>Admin Dasboard</title>
</head>

<body>


  <div class="box">
    <table style=" font-size:16pt" align="center" width="100%" height="100%">
      <tr>
        <td style="color:black">
          <h1 align="center">
            <marquee><i>Welcome To Online Academic Paper Management System</i> </marquee>
          </h1>
        </td>
      </tr>
      <tr>
        <td align="center"><b><i><mark style="color:white;background-color:maroon" ;>ADMIN PANEL</mark></i></b></td>
      </tr>
    </table>
  </div>



  <div class="nav">
    <ul>
      <li><a style="background-color: green" href="admin.php">Home</a></li>
      <li><a href="add_paper.php">Add Paper</a></li>
      <li><a href="edit_paper.php">Edit Paper</a></li>
      <li><a href="delpaper.php">Delete Paper</a></li>
      <li><a href="index.php">Logout</a></li>
    </ul>
  </div>
  <br><br>


  <div class="boxtwo" style="border:solid 1px #CF0403;border-radius: 10px; width:84%; min-height:360px; margin-left:9%;margin-top:10px;background-color:white">

    <!--    <input type="text" placeholder="search by paper id"><button type="button">search</button>  -->
    <p style="text-align:center;color:black;font-weight:bold">ALL Papers</p>
    <div class="main">

      <table>
        <tr>
          <th>ID</th>
          <th>Paper Name</th>
          <th>Author Name</th>
          <th>Publisher</th>
          <th>Year</th>
          <th>Epaper Name</th>
          <th>No.of favourites</th>
        </tr>

        <?php

        $data = mysqli_query($conn, "SELECT p.*, COUNT(rfp.user_id) AS fav_amount
        FROM paper p 
        LEFT JOIN researcher_favorite_paper rfp
        ON p.id = rfp.paper_id
        GROUP BY p.id, rfp.user_id");

        while($row = mysqli_fetch_assoc($data)):
        ?>

          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['papername'] ?></td>
            <td><?= $row['authorname'] ?></td>
            <td><?= $row['publisher'] ?></td>
            <td><?= $row['year'] ?></td>
            <td><?= $row['file_name'] ?></td>
            <td><?= $row['fav_amount'] ?></td>
          </tr>

        <?php endwhile; ?>

      </table>
    </div>

    
  </div>
  
  <div class="box statistic-box">
        <div class="statistic-container">
          <h3 style="margin: 0;"> Most Popular Keywords </h3>
            <?php 
              $res = mysqli_query($conn, "SELECT keyword, COUNT(keyword) AS keyword_count FROM researcher_keyword GROUP BY keyword;");
              while($row = mysqli_fetch_assoc($res)):
            ?>
              - "<?= $row['keyword'] ?>", <button class='detail' value="<?= $row['keyword'] ?>">Count: <?= $row['keyword_count'] ?></span>
            <?php endwhile; ?>
        </div>

        <div class="statistic-container" style="display: none;">
              <table>
                <thead>
                  <tr>
                    <th>Paper</th>
                    <th>Author</th>
                    <th>Publisher</th>
                  </tr>
                </thead>
                <tbody class="detail-content">

                </tbody>
              </table>
        </div>
  </div>

  <div style="background-color:orange; border:solid 2px orange;border-radius: 10px; width:84%; height:40px; margin-left:9%; margin-top:15px">
    <marquee behavior="alternate" direction="right" loop="1" style="margin-right:38%" align="center">
      <h6 style="line-height:1px;">All content copyright &copy; Bariyait, Inc .Thank You.</h6>
    </marquee>


  </div>


</body>

<script>
  $(document).ready(function(){
    $('.detail').click(function(){
      let keyword = $(this).val();

      $.ajax({
        url: location.href,
        type: "POST",
        data: {
          action: <?php echo ACTION_GET_KEYWORD_DETAIL ?>,
          keyword: keyword
        },
        dataType: "JSON",
        success: function(res){
          console.log(res);

          $(".detail-content").parents(".statistic-container").show();

          var length = res.length;
          var temp = "";

          for(var i = 0; i < length ; i++ ) {
            temp += `<tr><td> ` + res[i].papername + ` </td>` + `<td> ` + res[i].authorname + ` </td>` + `<td> ` + res[i].publisher + ` </td></tr>`;
          }

          $('.detail-content').html(temp);
        },
        failed: function(res) {
          console.log(res);
        }
      });
    });
  });
</script>

</html>