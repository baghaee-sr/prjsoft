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
<?php
 
  
  if(!empty($_POST['subpay'])){
	  
	      
	$p=30000;
	$MerchantID = '31f4aba4-9635-11e9-bbf9-000c29344814'; //Required
	$Amount = $p; //Amount will be based on Toman - Required
	$Description = '30 هزار تومن اولیه ثبت نام'.' '.$_SESSION['name'].' '.$_SESSION['family']; // Required
	$Email = 'UserEmail@Mail.Com'; // Optional
	$Mobile = '09120000000'; // Optional
	$CallbackURL = 'http://bdvu.ir/verify.php'; // Required
	
	
	$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
	
	$result = $client->PaymentRequest(
					[
					'MerchantID' => $MerchantID,
					'Amount' => $Amount,
					'Description' => $Description,
					'Email' => $Email,
					'Mobile' => $Mobile,
					'CallbackURL' => $CallbackURL,
					]
	);
	$au=$result->Authority;
	$status=$result->Status;
	date_default_timezone_set("Asia/Tehran");

	$t=time();
	$date=date("Ymd",$t);
	
	$ti=date("h:i:sa");
	
	
	
	$sql="INSERT INTO `pay` (`id`,`meliid`, `amount`, `authority`, `date`,`time`, `doc`, `status`)
		                     VALUES (NULL,'$meliid','$Amount' ,'$au','$date','$ti', '$Description','1')";
	$conn->exec($sql);
	//Redirect to URL You can do it also by creating a form
	if ($result->Status == 100) {
	Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
	//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
	//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
	} else {
	echo'ERR: '.$result->Status;
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
    <h2>سامانه -> تراکنش های مالی</h2>
  </div>
  <div class="col-6 logo-uni" > 
  
  
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
          		
   			   <?php
				
				$paylog="SELECT * FROM `pay` where `meliid` ='$meliid' AND `status`='1' AND `refstatus`='موفق' ";
				$paylogquery= $conn->query($paylog);
				
				$paylognum=$paylogquery->fetchColumn();
				
				if($paylognum<1){
					echo "<p class='mt-3 mb-3'>
                  	کاربر گرامی شما ، هزینه ثبت نام اولیه را پرداخت نکرده اید و به منزله قطعی نبودن ثبت نام شما می باشد ، لطفا از طریق گزینه زیر اقدام به پرداخت نمایید
                	</p>
					
						<form name='pay' method='post' >
        				<input type='hidden' value='120' name='subpay'>
       				    <button type='submit' class='btn btn-success  mt-3 mb-3' >جهت واریز مبلغ 30 هزار تومان کلیک نمایید</button>       
						</form>
					
					
					
					";
				
					
				}
				?>          
           
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
  <div class="col-6 logo-uni" > 
   
  </div>
</div>
<!--- row col-lg-12 alert alert-dark  --->

</div>
<!--- container  --->
<div>



</div>
</body>
</html>
