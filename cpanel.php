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
		
		header('Location:/prjsoft');		 
	 }
	 $IP = $_SERVER['REMOTE_ADDR']; 
	date_default_timezone_set("Asia/Tehran");
	$t=time();
	$date=date("Y/m/d",$t);
	$time=date("h:i:sa");
	$namefamilyvisit=$_SESSION[ 'name' ]." ".$_SESSION[ 'family' ];
	 
	$sqltablevisit="INSERT INTO `visit`(`id`, `ip`, `time`, `date`,`page`) VALUES (NULL,'$IP','$time','$date','$namefamilyvisit')";
	$conn->exec($sqltablevisit);	 
	

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
.alert{
	margin-bottom:0px !important;
}
.com {
	box-shadow: 5px 5px 10px 10px #333333;
}

.test {
	background-color: red;
}
a{color:#000;}
a:hover{color:#000; text-decoration:none;}
a:hover img{transform:scale(1.2,1.2); }
.t-d-r{text-align:right;}
/*******************************************************************/
.title{
	text-align:right;
	padding-top:1%;
}
.logo-uni{
	float:left;
	direction:rtl;		
}
.logo-uni img{
	float:left;
			
}
.icon{
	text-align:center;
	padding:3%;
}



</style>
<body>
<div class="container">

 <div class="row col-12 alert alert-dark mt-5">
         
         <div class="col-6 title">
       	    <h2>سامانه</h2>
         </div>
        
        
        <div class="col-6 logo-uni mt-1" >
            
        
          <a href="#" class="btn btn-outline-danger float-left ml-2 " >تماس با ما</a>
           <a href="#" class="btn btn-outline-danger float-left ml-2 " >اطلاعات</a>
           <div class="exit float-left ml-2 ">
          <form name="sing-out" method="get">
            <input name="singout" value="yes" type="hidden" />
            <input type="submit" class="btn btn-outline-danger " value="خروج" />
          </form>
      
    </div>
         </div>
 </div><!--- row col-lg-12 alert alert-dark  --->
 <!--------------------------------------------------------------------------------------------------------------------------------->

 <div class="row col-md-12 alert-success">
     <div class="col-md-4 icon">
           <a href="trac.php">
    	   <img src="image/app_largeicons.png" width="100" height="100" />
           <h5>تراکنش های مالی</h5>
           </a>
     </div>
     
     
     
     <div class="col-md-4 icon">
          <a href="variz.php">
          <img src="image/folder_add.png" width="100" height="100" />
          <h5>واریز وجه ماهیانه</h5>
          </a>
     </div>
     
     
     <div class="col-md-4 icon">
    	  <a href="edit-profile.php">
          <img src="image/files_edit.png" width="100" height="100" />
          <h5>ویرایش اطلاعات</h5>
          </a>
     </div>
     
     
      <div class="col-md-4 icon">
           <a href="vam.php">
    	   <img src="image/app_largeicons.png" width="100" height="100" />
           <h5> تسهیلات (وام)</h5>
           </a>
     </div>
     
     <div class="col-md-4 icon">
    	  <a href="#">
          <img src="image/files_edit.png" width="100" height="100" />
          <h5>اطلاعات بیشتر<span class="badge badge-danger">غیرفعال</span></h5>
          </a>
     </div>
     
     <div class="col-md-4 icon">
          <a href="#">
          <img src="image/folder_add.png" width="100" height="100" />
          <h5>وضعیت صندوق<span class="badge badge-danger">غیرفعال</span></h5>
          </a>
     </div>
     
 </div><!--- row col-12 alert-success  --->
<!--------------------------------------------------------------------------------------------------------------------------------->


<div class="row col-12 alert alert-dark">
  
  <div class="col-6 logo-uni float-left" >
  
    
  </div>
</div>
<!--- row col-lg-12 alert alert-dark  --->
<div class="col-md-12 col-lg-12 bg-info row">

<div class="col-12">
<p>
وایت برد
</p>

</div>
</div>
<div class="row col-12 alert alert-dark">
  <div class="col-6 title">
    <h2>کاربر: <?php echo $_SESSION[ 'name' ]." " . $_SESSION[ 'family' ] ?></h2>
  </div>
  <div class="col-6 logo-uni" >
    
  </div>
</div>
<!--- row col-lg-12 alert alert-dark  --->
         
 
 
</div><!--- container  --->
<?php



?>
</body>
</html>

