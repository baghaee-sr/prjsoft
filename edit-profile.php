<?php
	 session_start();
     include('connect.php');
	 ob_start();
	 
	  if(!empty( $_GET[ 'singout' ] ) ) {
		unset( $_SESSION[ 'meliid' ] );
		unset( $_SESSION[ 'name' ] );
		unset( $_SESSION[ 'family' ] );

		}
	
	  if(empty($_SESSION['meliid'])){
		echo "out";
		header('Location:/prjsoft');	 
	 }
	 
	 $meliid=$_SESSION['meliid'];
	

?>


<?php

$error="";	
$num=0;


if(!empty($_POST['sub'])){
	
		
				$name=$_POST['name'];$family=$_POST['family'];
				$stid=$_POST['stid']; $borndate=$_POST['borndate']; $mgname=$_POST['mgname'];
				$se=$_POST['se']; $phonenumber=$_POST['phonenumber']; $adress=$_POST['adress'];
				$phone2=$_POST['phone2']; $passport_nu=$_POST['passport-nu'];
		
				$sql="UPDATE `user` SET `name`='$name',`family`='$family',`stid`='$stid',`borndate`='$borndate',`mgname`='$mgname',
							  `phonenumber`='$phonenumber',`adress`='$adress',`phone2`='$phone2',`passport-nu`='$passport_nu' WHERE `meliid`='$meliid' ";
							   
							 
							      
					$conn->exec($sql);
					if($conn){
					$error='<div class="alert alert-success col-12 mt-3 " ><div class="container t-d-r font-homa" >ویرایش اطلاعات با موفقیت انجام شد</div></div>';
					$_SESSION['name']=$_POST['name'];
					$_SESSION['family']=$_POST['family'];
					}
					else{
						$error='<div class="alert alert-danger col-12 mt-3 " ><div class="container t-d-r font-homa" >ویرایش اطلاعات با مشکل مواجه شد</div></div>';	
					}
					
					
					
					
					
			
}//if(!empty($_POST['sub'])){
		
		

?>
	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<title>داشبرد</title>
</head>
<style>
.alert {
	margin-bottom: 0px !important;
}
.com {
	box-shadow: 5px 5px 10px 10px #333333;
}
.test {
	background-color: red;
}
a {
	color: #000;
}
a:hover {
	color: #000;
	text-decoration: none;
}
a:hover img {
	transform: scale(1.2, 1.2);
}
.t-d-r {
	text-align: right;
}
/*******************************************************************/
.title {
	text-align: right;
	padding-top: 1%;
}
.logo-uni {
	float: left;
	direction: rtl;
}
.logo-uni img {
	float: left;
}
.icon {
	text-align: center;
	padding: 3%;
}
</style>
<body>
<div class="container">
<div class="row col-12 alert alert-dark mt-5">
  <div class="col-6 title">
    <h2>حساب کاربری</h2>
  </div>
  <div class="col-6 logo-uni" > <img src="image/1_Velaiat.png" width="40" height="40" /> <img src="image/jz9z_-4.png" width="40" height="40" /> 
  
  
  <a href="cpanel.php" class="btn btn-outline-danger float-left ml-2 " >صفحه نخست</a>
           <div class="exit float-left ml-2 ">
          <form name="sing-out" method="get">
            <input name="singout" value="yes" type="hidden" />
            <input type="submit" class="btn btn-outline-danger " value="خروج" />
          </form>
      
    </div>
  
  </div>
</div>
<!--- row col-lg-12 alert alert-dark  ---> 
<!--------------------------------------------------------------------------------------------------------------------------------->

<div class="row col-12 bg-secondary">

<?php

echo $error;

$data_user="SELECT * FROM `user` where `meliid` =$meliid";
$data_old= $conn->query($data_user);

foreach($data_old as $data_user_conn)
	{
		

?>
<!-- As a heading -->

 <form name="newuser" method="post" class="">
        <div class="row text-center col-lg-12  rounded mt-5" >
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">نام : </h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="name" value="<?php echo  $data_user_conn["name"]; ?>">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">نام خانوادگی :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="family" value="<?php echo  $data_user_conn["family"]; ?>">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3" >کد ملی :</h5>
  <input type="text" dir="ltr" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="meliid" maxlength="10" disabled="disabled" value="<?php echo $meliid; ?>">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3" >شماره دانشجویی :</h5>
       		 <input type="text" dir="ltr" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="stid"  maxlength="7" value="<?php echo  $data_user_conn["stid"]; ?>">
          </div>
          <!-------------------------------------- line ---------------------------------------->
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">سال تولد :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="borndate" value="<?php echo  $data_user_conn["borndate"]; ?>">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">رشته :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="mgname" value="<?php echo  $data_user_conn["mgname"]; ?>">
          </div>
          
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">شماره تماس  :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="phonenumber" value="<?php echo  $data_user_conn["phonenumber"]; ?>">
          </div>
           <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">شماره گذرنامه :</h5>
            <input type="tel" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" id="passnumber" name="passport-nu" value="<?php echo  $data_user_conn["passnumber"]; ?>">
          </div>
          <!-------------------------------------- line ---------------------------------------->
          <div class="col-lg-8 col-md-12">
            <h5 class="float-right m-3">آدرس منزل :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="adress" value="<?php echo  $data_user_conn["adress"]; ?>">
          </div>
          <div class="col-lg-4 col-md-12">
            <h5 class="float-right m-3">شماره منزل یا والدین:</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="phone2" value="<?php echo  $data_user_conn["phone2"]; ?>">
          </div>
          <!-------------------------------------- line ---------------------------------------->
          
      
         
        
       
          <input type="submit" class="btn btn-success btn-lg btn-block mr-4 mt-5 mb-3" value="ثبت و ویرایش اطلاعات" name="sub">
        </div>
        <!-----------------end row login or singin ------------------->
        
      </form>
<?php

}

?>

</div>
<!--- row col-12 alert-success  ---> 


<div class="row col-12 bg-secondary">


</div>
<!--- row col-12 alert-success  ---> 
<!--------------------------------------------------------------------------------------------------------------------------------->

<div class="row col-12 alert alert-dark">
  <div class="col-6 title">
    <h2>کاربر: <?php echo $_SESSION[ 'name' ]." " . $_SESSION[ 'family' ] ?></h2>
  </div>
  <div class="col-6 logo-uni" > <img src="image/1_Velaiat.png" width="40" height="40" /> <img src="image/jz9z_-4.png" width="40" height="40" />
   
  </div>
</div>
<!--- row col-lg-12 alert alert-dark  --->

</div>
<!--- container  --->
<div>



</div>
</body>
</html>
