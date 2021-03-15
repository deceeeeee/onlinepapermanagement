<?php include("conn.php");
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit']))

{
  $name=$_POST['name1'];
  $phone=$_POST['phone'];
  
  $email=$_POST['email'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];

  $_SESSION["sname"]=$name;
  $_SESSION["semail"]=$email;
    
    
    
    if($name!="" && $phone!=""  && $email!="" && $password!=""  )
  { 
    if ($password==$cpassword) {
        $insert="INSERT INTO `researcher_registration`(`name`,`phone`,`emailid`,`password`) VALUES('".$name."','".$phone."','".$email."','".$password."')";
      $data=mysqli_query($conn,$insert); 
      if($data)
	  {
	  
	  
          echo '<script>alert("Registration Successful!")</script>';
          header('Refresh: 0; URL=index.php'); 
    } else
    {
      echo '<script>alert("username or email already exist")</script>';
    }
	  }
        else
        {
            echo '<script>alert("Your passwords dont match!!! Please Try Again" )</script>';
        }
        
    }
    else{
        echo "Fields Should Not Be Empty..!!";
    }
}


?>

<!DOCTYPE html>
<html>

<style type="text/css">
body{
  background: url("2.jpg");
}
.box{
  width:74%;
  height:165px;
 border:solid 1px #CF0403;
  background-image: url("1.jpg");
  background-size: cover;
  margin-left: 13%;
  opacity: .9;
  border-radius:12px;
}
.title h2{
           background:#660000;
       border:none;
       margin-left:-10px;
      margin-top: -05px;
      padding-top:3px;
      padding-bottom: 2px;
        padding-left:120px;
      border-radius:15px;
      width:77.2%;
      color:white;
           }
.one{
  margin-top: 1.5%;
  margin-left:52%;
  margin-right:2%;
  opacity: .9;
  box-shadow:0px 0px 15px lightgreen;
  height:320px;
  background:rgba(0,0,0,0.5);
}
.boxtwo{
  background-image: url("1.jpg");
  background-size: cover;
  box-shadow:0px 0px 15px lightgreen;
  border-radius:12px;
}
.boxtwo input[type="submit"]
       {

     font-size:25px;
     text-align:center;
   border:none;
   height:40px;
   margin-left:60% ;
   margin-top: 10px;
   background:#660000;
   color:#FFFFFF;
   border-radius:18px;
   }

</style>









<head><title>REGISTRATION</title></head>
<body>
  <div class="box">
   <table  style =" font-size:16pt" align="center" width="100%" height="100%">
      <tr>
        <td style="color:blakc"><h1 align="center"><marquee ><i>Welcome To Online Academic Paper Management System</i>  </marquee></h1></td>
      </tr>
      <tr>
          <td  align="center"><b><i><mark style="color:white;background-color:maroon";>RESEARCHER REGISTRATION PAGE</mark></i></b></td>
      </tr>
    </table>
    
  </div>
  <br><br>
  <div  class="boxtwo" style="border:solid 1px #CF0403;border-radius: 10px; width:73.5%; height:370px; margin-left:13%;margin-top:10px;background-color:white">


<fieldset align="center" style="color:blue;" class="one">
  <div class="title">
  <h2>YOUR DETAILS</h2>
    </div>

    

<form action="" method="post"> <b>
<table align="center" style="color:white;font-size:13pt"></b> 


	  <tr>
			<td>NAME:</td> 
 <td ><input type="text" placeholder="username"  required="required" name="name1" size="17"
 maxlength="30" style="color:blue"/></td> 

	  </tr>    
<tr>
<td>Phone NO.:</td> 
 <td><input type="number" name="phone" placeholder="Phone No." required="required" size="17"
 maxlength="30" style="color:blue"/></td></tr>


<tr><td>E-MAIL ID:</td>
 <td><input type="email" placeholder="Email"  name="email" required="required" size="17"
 maxlength="30" style="color:blue"/></td></tr>
<tr>
<td>
PASSWORD:</td>
 <td><input type="password" placeholder="Password"  name="password" required="required" size="17"
 maxlength="30" style="color:blue"/>  
<br>
 <input type="password" placeholder="Confirm Password" name="cpassword" required="required" size="17"
 maxlength="30" style="color:blue"/> </br>
</td></tr>

 <tr>
  <td><input type="submit" name="submit"
   value="REGISTER"></td>

  </tr>
<tr> 

<td style="color:white;font-size:12pt"><b> <br>Have Account ?</br></b></td>

<td style="font-size:10pt"><a href="index.php" style="color:white"><br>Click Here</br></a></td>
      </p></tr>



 </table>
</form>
 </fieldset>
</div>






  <div class="boxthree" style="background-color:orange; border:solid 2px orange;border-radius: 10px; width:73.5%; height:40px; margin-left:13%; margin-top:15px" >
    <marquee behavior="alternate" direction="right" loop="1" style="margin-right:38%" align="center"><h6 style="line-height:1px;">All content copyright &copy; Bariyait, Inc .Thank You.</h6></marquee>


  </div>

 </body>
</html>
