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
	 $se=$_SESSION[ 'se' ];
	 $name=$_SESSION[ 'name' ] ." ".$_SESSION[ 'family' ];
	

?>
<?php
 
   $error="";
  if(!empty($_POST['getrecuestvam'])){
	  $error="";
	  $amont=$_POST['amount'];
	  $mon=$_POST['mon'];
	 
	  $sql="INSERT INTO `vam`(`id`, `meliid`,`name` ,`se`, `amount`, `month`, `status`, `date`, `time`) VALUES (NULL,$meliid,'$name','$se',$amont,$mon,'0','','')";
	  $conn->exec($sql);
		if($conn){
		$error='<div class="alert alert-success col-12 mt-3 " ><div class="container t-d-r font-homa" >درخواست شما با موفقیت ثبت شد پس از بررسی مدیر کاروان نتیجه درخواست در همین صفحه قابل مشهاده خواهد بود</div></div>';
		
		}
		else{
			$error='<div class="alert alert-danger col-12 mt-3 " ><div class="container t-d-r font-homa" >ثبت درخواست با مشکل مواجه شد ، لطفا از سایت خارج شده و مجدد وارد  شده و درخواست بدهید</div></div>';	
		}
					
	

	  
  }
  
 
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
  <div class="col-6 logo-uni" >
   <img src="image/1_Velaiat.png" width="40" height="40" /> <img src="image/jz9z_-4.png" width="40" height="40" /> 
  
  
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
 <div class="col-12 row  bg-info ">
      <?php
	  echo $error;
	  
	  ?>    		
   			 <form name="getvam" method="post" class="col-12">
              <div class="col-lg-5">
                    <h5 class="float-right m-3">مبلغ وام :</h5>
                    <select name="amount" class="col-12 mt-5 form-control">
                     
                     <option value="400000">400.000 هزار تومان</option>
                     <option value="300000">300.000 هزار تومان</option>
                     <option value="200000">200.000 هزار تومان</option>
                     <option value="100000">100.000 هزار تومان </option>   
                     <option value="800000">800.000 هزار تومان ویژه </option>
                     <option value="500000">500.000 هزار تومان ویژه</option>
                      </select>
                </div>
              
              <div class="col-lg-5">
                    <h5 class="float-right m-3">تعدادماه های بازپرداخت :</h5>
                    <select name="mon" class="col-12 mt-5 form-control">
                      <option value="11">11 ماه </option>
                      <option value="10">10 ماه</option>
                      <option value="9">9 ماه </option>
                      <option value="8">8 ماه</option>
                      <option value="7">7 ماه </option>
                      <option value="6">6 ماه</option>
                      <option value="5">5 ماه </option>
                      <option value="4">4 ماه</option>
                      <option value="3">3 ماه </option>
                      <option value="2">2 ماه</option>
                      <option value="1">1 ماه </option>
                      </select>
                </div>
              		 <span></span>
                      <input type="submit" class="btn btn-success btn-lg btn-block mt-5 mb-3" value="ثبت درخواست وام" name="getrecuestvam">

             
             </form>   
           
		</div>
        
<div class="row col-12 alert alert-primary">

  <div class="col-6 title">
    <h4>درخواست های ثبت شده</h4>
  </div>
  
</div>


<div class="row col-12 bg-secondary">
       
        
<!-- As a heading -->

<table class='table table-hover table-recently-t'>
<thead>
  <tr>
    <th scope='col'>#</th>
    <th scope='col'>مبلغ</th>
    <th scope='col'>ماه</th>
    <th scope='col'>وضعیت</th>

  </tr>
</thead>
<?php

	
	$bo="SELECT * FROM `vam` where `meliid` =$meliid";
	$boo= $conn->query($bo);
	$statusvam="";
	
	foreach($boo as $rows)
	{
			if($rows["status"]==0){
			$statusvam="در صف انتظار جهت بررسی";
			$colorrecuesst="";
			}
			else if($rows["status"]==1){
				$statusvam="درخواست تایید شده است";
				$colorrecuesst="success";
			}
			else if($rows["status"]=='-1'){
				$statusvam="درخواست رد شده است";
				$colorrecuesst="danger";
			}
		echo "<tr class='bg-".$colorrecuesst."'>
		  <th scope='col'>#</th>
		  <th scope='col'>".$rows["amount"]."</th>
		  <th scope='col'>".$rows["month"]."</th>
		  <th scope='col'>".$statusvam."</th>

	 	 </tr>";
	
	}

?>
</table>
</div>
<!--- row col-12 alert-success  ---> 
  <div class="row col-12 alert alert-light">

  <div class="col-6 title">
    <h4>مشاهده بازپرداخت وام</h4>
  </div>
  
</div>

<div class="row col-12 alert alert-secondary">

  <table class='table table-hover table-recently-t'>
<thead>
  <tr>
    <th scope='col'>#</th>
    <th scope='col'>ماه</th>
    <th scope='col'>مبلغ</th>
    <th scope='col'>تاریخ پرداخت</th>
    <th scope='col'>مبلغ کل</th>
    <th scope='col'>فرآیند</th>

  </tr>
</thead>
<?php

	
	$vams="SELECT * FROM `uservam` WHERE `userid` =$meliid ORDER BY `uservam`.`id` ASC ";
	$vamss= $conn->query($vams);
	
	foreach($vamss as $rows)
	{
			
		echo "<tr class=''>
		  <th scope='col'>#</th>
		  <th scope='col'>".$rows["mon"]."</th>
		  <th scope='col'>".$rows["amount"]." تومان</th>
		  <th scope='col'>".$rows["date"]."</th>
		  <th scope='col'>".$rows["amountvam"]." تومان</th>
		  <th scope='col'><input type='submit' class='btn btn-outline-success ' value='پرداخت' name='' /></th>
		 

	 	 </tr>";
	
	}

?>
</table>
  
</div>

    




<!--- row col-12 alert-success  ---> 
<!--------------------------------------------------------------------------------------------------------------------------------->

<div class="row col-12 alert alert-dark ">
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
<script>


	/*var h=0;
	function amount(m){
		h++;
		if(h>3){
			
		document.getElementById("amountvam").value+=".";
		h=1;

		}
		}
*/


</script>
</html>
