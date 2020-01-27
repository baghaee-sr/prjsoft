<?php
     session_start();
     include('connect.php');
	 ob_start();
	$_SESSION['payerror']="";
	$MerchantID = '31f4aba4-9635-11e9-bbf9-000c29344814';
	$Amount = 30000; //Amount will be based on Toman
	$Authority = $_GET['Authority'];
	
	if ($_GET['Status'] == 'OK') {
	
		$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
		
		$result = $client->PaymentVerification(
		[
		'MerchantID' => $MerchantID,
		'Authority' => $Authority,
		'Amount' => $Amount,
		]
		);
		
			if ($result->Status == 100) {
				$refid=$result->RefID;
				$sqlupdate="UPDATE `pay` SET `refid`= $refid , `refstatus`= 'موفق' WHERE (`authority`=$Authority) ";
				$conn->exec($sqlupdate);
				$sqlupdatepaybackup="UPDATE `paybackup` SET `refid`= $refid , `refstatus`= 'موفق' WHERE (`authority`=$Authority) ";
				$conn->exec($sqlupdatepaybackup);
				
				echo 'Transaction success. RefID:'.$result->RefID;
				header('Location: '."cpanel.php");
			}
			else {
			echo 'Transaction failed. Status:'.$result->Status;
			$sqlupdate="UPDATE `pay` SET `refstatus`= 'خطا' WHERE (`authority`=$Authority) ";
			$conn->exec($sqlupdate);
			$sqlupdatepaybackup="UPDATE `paybackup` SET `refstatus`= 'خطا' WHERE (`authority`=$Authority) ";
			$conn->exec($sqlupdatepaybackup);
			$_SESSION['payerror']='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >پرداخت با مشکل مواجه شد لطفا مجدد تلاش کنید</div></div>';
			header('Location: '."pay.php");
			}
		}
		else {
		echo 'Transaction canceled by user';
		$sqlupdate="UPDATE `pay` SET `refstatus`= 'ناموفق' WHERE (`authority`=$Authority) ";
		$conn->exec($sqlupdate);
		$sqlupdatepaybackup="UPDATE `paybackup` SET `refstatus`= 'ناموفق' WHERE (`authority`=$Authority) ";
		$conn->exec($sqlupdatepaybackup);
		$_SESSION['payerror']='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >پرداخت با مشکل مواجه شد لطفا مجدد تلاش کنید</div></div>';
		header('Location: '."pay.php");
	}



?>