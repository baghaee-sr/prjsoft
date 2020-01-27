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
		header('Location: https://bdvu.ir');	 
	 }
	 
	 $meliid=$_SESSION['meliid'];
	

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
    <h2>سامانه زائر-> تراکنش های مالی</h2>
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
 <div class="col-md-12 col-lg-12 bg-info row">
          
                <p class="mt-3 mb-3">
                    در این صفحه شما قادر خواهید بود تمامی  تراکنش های مالی خود را مشاهده کنید
                </p>
           
		</div>
<div class="row col-12 bg-secondary">
       
        
<!-- As a heading -->

<table class='table table-hover table-recently-t'>
<thead>
  <tr>
    <th scope='col'>#</th>
    <th scope='col'>مبلغ</th>
    <th scope='col'>کد رهگیری</th>
    <th scope='col'>تاریخ</th>
    <th scope='col'>توضیحات</th>
    <th scope='col'>وضعیت</th>
  </tr>
</thead>
<?php

	
	$bo="SELECT * FROM `pay` where `meliid` =$meliid";
	$boo= $conn->query($bo);
	foreach($boo as $rows)
	{
		echo "<tr>
		  <th scope='col'>#</th>
		  <th scope='col'>".$rows["amount"]."</th>
		  <th scope='col'>".$rows["refid"]."</th>
		  <th scope='col'>".$rows["date"]."</th>
		  <th scope='col'>".$rows["doc"]."</th>
		  <th scope='col'>".$rows["refstatus"]."</th>
	 	 </tr>";
	
	}

?>
</table>


  
    



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
