<?php 
include("conn.php");?>

<html>
<head>
<style>
body{
  background: url("2.jpg");
}
    table{
                width: 100%;
                border-collapse: collapse;
                height: auto;
        text-align: center;
        color: white;
        font-weight: bold;

            }
    
    th{
        font-size: 17px;
        text-decoration: underline;
        font-style: italic;
    }
    
    .main{
        width: 80%;
        box-shadow: 0px 0px 20px red;
        border-radius: 20px;
        overflow: auto;
        margin-left: 10%;
        margin-top: 2%;
        height:270px;
        background: rgba(0, 0, 0, 0.57);
    }
.box{
  width:74%;
  height:160px;
  background-image: url("1.jpg");
  background-size: cover;
  margin-left: 13%;
  opacity: .9;
 border:solid 1px #CF0403;
  border-radius: 12px;

}
.boxtwo{
  background-image: url("1.jpg");
  background-size: cover;
  box-shadow:0px 0px 15px lightgreen;
  border-radius:12px;

}
ul{
  padding: 0  ;
  list-style: none;
}
ul li{
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
ul li a{
  text-decoration: none;
  color: white;
  display: block;
}
ul li a:hover{
  background-color: green;
}
ul li ul li{
  display: none;
}
ul li:hover ul li{
  display: block;

}
.nav{
  padding-left:12%;

}
.three{
  margin-left: 60%;
  margin-top: 5px;
  box-shadow:0px 0px 15px green;
}
    button{
        margin-top: 10px;
    }
</style>


<title>Admin Dasboard</title>
</head>
<body>

  
    <div class="box">
     <table  style =" font-size:16pt"  align="center" width="100%" height="100%">
        <tr>
            <td style="color:black"><h1 align="center"><marquee><i>Welcome To Online Academic Paper Management System</i>  </marquee></h1></td></tr>
        <tr>
          <td align="center"><b><i><mark style="color:white;background-color:maroon";>ADMIN PANEL</mark></i></b></td>
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
          
          
  <div class="boxtwo" style="border:solid 1px #CF0403;border-radius: 10px; width:84%; height:360px; margin-left:9%;margin-top:10px;background-color:white">
      
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
           
           $data=mysqli_query($conn,"SELECT * FROM `paper`");
	              while($row = mysqli_fetch_array($data))
	               {   
                        echo "<tr>";
                        echo "<td>" ;echo $row["id"]; echo "</td>";
                        echo "<td>";echo $row["papername"]; echo "</td>";
                        echo "<td>"; echo $row["authorname"]; echo "</td>";
                        echo "<td>"; echo $row["publisher"]; echo "</td>";
                        echo "<td>"; echo $row["year"]; echo "</td>";
                        echo "<td>"; echo $row["file_name"]; echo "</td>";
                        echo "<td>"; echo $row["like"]; echo "</td>";
                        
                        echo "</tr>";
                        
                    } 
                   
	            ?>
              

              


                </table>      
           
      
      </div>   
   

  </div>
      
      
      
      
 




        <div  style="background-color:orange; border:solid 2px orange;border-radius: 10px; width:84%; height:40px; margin-left:9%; margin-top:15px" >
          <marquee behavior="alternate" direction="right" loop="1" style="margin-right:38%" align="center"><h6 style="line-height:1px;">All content copyright &copy; Bariyait, Inc .Thank You.</h6></marquee>


        </div>

   
    </body>
  
</html>