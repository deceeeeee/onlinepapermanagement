<?php include("conn.php");


$msg="";

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['sub']))

{

  $bookname=$_POST['booksname'];
  $authorname=$_POST['authorname'];
  $id=$_POST['book_id'];  
  $copy=$_POST['copies'];
 $year=$_POST['years'];
  $avl_cpy=$copy;
  

  if($bookname!="" && $authorname!="" && $id!="" && $copy!="")
  {  
     
  
     $file_name = $_FILES['file']['name'];
	 $new_file_name=$id.".pdf";
     $file_tmp_loc = $_FILES['file']['tmp_name'];
	 $file_store = "ebooks/";
     $fpath=$file_store.$new_file_name;
	 $accepted=array("pdf");

	 
	 
	if(!in_array(pathinfo($file_name,PATHINFO_EXTENSION),$accepted))
	{
	$msg= $file_name."<br> is not acceptable file type";
	}
	else
	{
	  
	  move_uploaded_file($_FILES['file']['tmp_name'],$file_store.$new_file_name);
	  
	 }

       
      
      $sql="UPDATE `paper` SET "."`papername`='$authorname', "."`authorname`='$id',"." `publisher`='$copy', "."`year`='$year', "."`file_name`='$file_name',"." `path`='$fpath' "." WHERE `paper` . `id`="."'$bookname'";
      
     
      $data=mysqli_query($conn,$sql); 
      if($data)
	  {
      
	  
	    $msg= "Sccessfully Edited";
	  }
      else{
          $msg="Something Went Wrong";
      }
   }
	  else
	  {
	    $msg= "All field are required";
	  }

	
}

?>
<html>
<head>
<title>Edit_Book</title>


<style>
body{
  background: url(2.jpg);
}
.box{
  width:74%;
  height:160px;

  background-image: url(1.jpg);
  background-size: cover;
  margin-left: 13%;
  opacity: .9;
  border-radius:12px;
  box-shadow:0px 0px 15px lightgreen;
   border:solid 1px #CF0403;
  border-radius: 12px;
}

	 .header{
	         width:400px;
			color:#FFFFFF;
			 display: inline-block;
			 width:73.5%;
			 height:370px;
			 margin-left:13%;
       background-image: url(1.jpg);
       background-size: cover;
			 box-shadow:0px 0px 15px lightgreen;
       border-radius:12px;
         border:solid 1px #CF0403;

			 }


	.title
	       {
				color:#FFFFFF;
			   font-size:20px;
			 	font-weight:10px;
				
				background:rgba(0,0,0,0.5);
                margin-top: 4%;
				margin-right:56%;
				padding-left:10%;
				font-style:italic;
				}
	.title h2{
	           background:#660000;
			   border:none;
         margin-left:20px;
         margin-top: 10px;
			  padding-top:3px;
        padding-bottom: 2px;
			    padding-left:150px;
				border-radius:15px;
        width:280px;
	           }

	.container{
        margin-top: 15px;
	            margin-left:20%;

				font-weight:10px;
				height:350px;
				background:rgba(0,0,0,0.5);
				padding-left:3%;
                width:600px;
        box-shadow:0px 0px 15px lightgreen;
        border-radius:18px;
        overflow:auto;
				}

   .header input[type="submit"]
          {

		    font-size:25px;
		    text-align:center;
			border:none;
			height:40px;
			margin-left:110% ;
            margin-top: 10px;
			background:#660000;
			color:#FFFFFF;
			border-radius:18px;
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


</style>
</head>
<body>
  <div class="box">
   <table  style ="border-color:red; font-size:16pt"  align="center" width="100%" height="100%">
      <tr>
        <td style="color:black"><h1 align="center"><marquee>Welcome To online Academic Paper Management System</marquee></h1></td>
      </tr>
      <tr>
        <td style="color:blue" align="center"><b><i>Edit Paper &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</i></b></td>
      </tr>
    </table>
  </div>
<div class="nav">
<ul>
  <li><a href = "admin.php">Home</a></li>
  <li ><a href = "add_paper.php"  >Add Paper</a></li>
  <li><a href = "edit_paper.php"style="background-color:green">Edit Paper</a></li>
    <li><a href = "delpaper.php">Delete Paper</a></li>
  <li><a href = "index.php">Logout</a></li>
</ul>
<br><br><br>
</div>

<form action="" method="POST" enctype="multipart/form-data">
<div class = "header">


  <div class = "container">
    <div style="color:white" align="center">
    <h2>Edit Paper</h2>
      </div>

  <table style= "color:#FFFFFF;padding-top:10px;">
   <tr>
     <td>ID :</td>
     <td><input type="text" name="booksname" placeholder="Paper ID"/></td>
     </tr>
	<tr>
	  <td>Paper Name :</td>
    <td><input type="text" name="authorname" placeholder="Paper Name"/></td>
	</tr>
   <tr>
     <td>Author Name :</td>
     <td><input type="text" name="book_id" placeholder="Author Name"/></td>
     <td style="color:red;font-weight:bold;text-align:center"><?php echo $msg; ?></td>
	</tr>
	<tr>
	  <td>Publisher :</td>
    <td><input type="text" name="copies" placeholder="Publisher"/></td>
	</tr>
   
  <tr>
     <td>Year :</td>
     <td><input type="text" name="years" placeholder="Year"/></td>
     </tr>

	<tr>
	 <td>UPLOAD EPaper :</td>
	 <td><input type="file" name="file"  /></td>
	</tr>
      <tr>
      <td><h2><input style="margin-left:180%;margin-top:10%;" type="submit" name="sub" value="RE-UPLOAD"/></h2></td>
	  </tr>
   </table>

 </form>
</div>
</div>
</body>
</html>
x