<?php
     session_start();
     include('connect.php');
	 ob_start();
	 if(empty($_SESSION['meliid'])){
		header('Location: https://localhost/prjsoft');	 
	 }

?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<head>
<title>سامانه زائر > ثبت نام</title>
<style>
.row-body {
	background-color: #FFF;
}

</style>
</head>

<body>
<div class="container mt-2"> 
  <?php
  $meliid=$_SESSION['meliid'];
  
  if(!empty($_POST['subpay'])){
	  
	      
	$p=30000;
	$MerchantID = '31f4aba4-9635-11e9-bbf9-000c29344814'; //Required
	$Amount = $p; //Amount will be based on Toman - Required
	$Description = '30 هزار تومن اولیه ثبت نام'.' '.$_SESSION['name'].' '.$_SESSION['family']; // Required
	$Email = 'UserEmail@Mail.Com'; // Optional
	$Mobile = '09120000000'; // Optional
	$CallbackURL = 'http://localhost/prjsoft/verify.php'; // Required
	
	
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
	$sqlbackup="INSERT INTO `paybackup` (`id`,`meliid`, `amount`, `authority`, `date`,`time`, `doc`, `status`)
		                     VALUES (NULL,'$meliid','$Amount' ,'$au','$date','$ti', '$Description','1')";
	$conn->exec($sqlbackup);
	
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
  <!-----------------row------------------->
  <div class="row row-body rounded">
    <div class="col-12 bg-info p-2 mb-3"> سلام <?php echo $_SESSION['name']." " ; ?>جان  خوش آمدی </div>
    <div class="alert alert-success  m-auto ticket col-12" role="alert">
      <h4 class="alert-heading">تابلو اعلانات</h4>
      <div class="alert alert-primary " ><div class="container t-d-r font-homa" >ثبت نام شما با موفقیت انجام شد</div></div>
     <?php echo $_SESSION['payerror'];  $_SESSION['payerror']=""; ?>
      <hr>
      <p> خوش آمدید جهت تکمیل ثبت نام ابتدا مبلغ 30 هزار تومان را واریز نماید <br>  جهت ارجا به صفحه پرداخت بر روی گزینه زیر کلیک نمایید</p>
      	<form name="pay" method="post" action="">
        	<input type="hidden" value="120" name="subpay">
           <button type="submit" class="btn btn-success  mt-3 mb-3" >جهت واریز مبلغ 30 هزار تومان کلیک نمایید</button>       
		</form>
        <a href="cpanel.php" class="btn btn-success  mt-3 mb-3">قبلا پرداخت کردم</a>
    </div>
  </div>
  
</div>
<!-----------------end container------------------->

</body>
<footer>
<?php




?>
  <script>
	
	</script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"
            integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</footer>
</html>