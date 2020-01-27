<?php
	 session_start();
     include('connect.php');
	 ob_start();
	 
	  if(!empty( $_GET[ 'singout' ] ) ) {
		unset( $_SESSION[ 'idadmin' ] );

		}
	
	  if(empty($_SESSION['idadmin'])){
		
		header('Location:/prjsoft/admin.php');	 
	 }
	 
	 $se=$_SESSION[ 'gender' ];
	 
	$IP = $_SERVER['REMOTE_ADDR']; 
	date_default_timezone_set("Asia/Tehran");
	$t=time();
	$date=date("Y/m/d",$t);
	$time=date("h:i:sa");
	$sqltablevisit="INSERT INTO `visit`(`id`, `ip`, `time`, `date`,`page`) VALUES (NULL,'$IP','$time','$date','$se')";
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
       	    <h2>سامانه زائر</h2>
         </div>
        
        
        <div class="col-6 logo-uni mt-1" >
            <img src="image/1_Velaiat.png" width="40" height="40" />
            <img src="image/jz9z_-4.png" width="40" height="40" />
        

           <div class="exit float-left ml-2 ">
          <form name="sing-out" method="get">
            <input name="singout" value="yes" type="hidden" />
            <input type="submit" class="btn btn-outline-danger " value="خروج" />
          </form>
      
    </div>
         </div>
 </div><!--- row col-lg-12 alert alert-dark  --->
 <!--------------------------------------------------------------------------------------------------------------------------------->

 <div class="row col-md-12 alert-dark pb-3">
  
   
   
  
  
  
  <?php
	
	
	
	$bo="SELECT * FROM `user` where `se` =$se";
	
	$boo= $conn->query($bo);
	
				
	
	
	
	
	
	$num=1;
	foreach($boo as $rows)
	{
		
		$paylog="SELECT * FROM `pay` where `meliid` ='".$rows["meliid"]."' AND `status`='1' AND `refstatus`='موفق' ";
		$paylogquery= $conn->query($paylog);
		$paylognum=$paylogquery->fetchColumn();
		if($paylognum>1){
			$paylog="info";
		}else{
			$paylog="light";
		}
		
		
		echo "<a href='http://bdvu.ir/personaluser.php?usermeliid=".$rows["meliid"]."' class='alert alert-".$paylog." alert-primary col-lg-12 mt-3' role='alert'>
		
			<span>$num</span>
     	  	 <span  class='mr-4'>نام: </span>"." ".$rows["name"]." ".$rows["family"]."
     	  	 <span class='mr-4'>کد ملی: </span>"." ".$rows["meliid"]."
     	  	 <span class='mr-4'>گذرنامه:</span>"." ".$rows["passport"]."
			
			 	
			</a>
		  ";
		$num++;
	}

?>
  
  
 </div><!--- row col-12 alert-success  --->
 
 <div class="row col-12 alert alert-dark">

  <div class="col-6 title">
    <h4>درخواست های وام</h4>
  </div>
  
</div>

 <div class="row col-12 alert alert-light">       
<!-- As a heading -->
<?php
if(!empty($_POST['vamoky'])){
$vamid=$_POST['vamid'];
$sqleditvam="UPDATE `vam` SET `status`='1' WHERE `id`='$vamid' ";
$conn->exec($sqleditvam);
$vamamount=$_POST['vamamount'];
$vamusermeliid=$_POST['vamusermeliid'];
$vammonth=$_POST['vammonth'];
$vam_amount=round(($vamamount + $vamamount*2/100)/$vammonth);
$sqleditvaminsert="";
for($i=0;$i<$vammonth;$i++){
$shh="INSERT INTO `uservam`(`id`,`vamid` ,`userid`, `mon`,`monfull`, `amount`,`amountvam`) VALUES (NULL,'$vamid','$vamusermeliid','".($i+1)."','$vammonth','$vam_amount','$vamamount');";
$sqleditvaminsert=$sqleditvaminsert.$shh;
}

$conn->exec($sqleditvaminsert);

}
if(!empty($_POST['vamnot'])){
$vamid=$_POST['vamid'];
$sqleditvam="UPDATE `vam` SET `status`='-1' WHERE `id`='$vamid' ";
$conn->exec($sqleditvam);
}
if(!empty($_POST['vamreset'])){
$vamid=$_POST['vamid'];
$sqleditvam="UPDATE `vam` SET `status`='0' WHERE `id`='$vamid' ";
$conn->exec($sqleditvam);
}


?>
<table class='table table-hover table-recently-t' style="color:#000 !important;">
<thead>
  <tr>
     <th scope='col'>#</th>
     <th scope='col'>نام</th>
    <th scope='col'>مبلغ</th>
    <th scope='col'>ماه</th>
    <th scope='col'>وضعیت</th>
    <th scope='col'>فرایند</th>

  </tr>
</thead>
<?php
	if($se=='0'){
	$bovam="SELECT * FROM `vam` WHERE `se`=$se";
	}
	else{
		$bovam="SELECT * FROM `vam`";
		}
		
	$boovam= $conn->query($bovam);
	$statusvam="";

	
	foreach($boovam as $rowsvam)
	{
			if($rowsvam["status"]==0){
			$statusvam="در صف انتظار جهت بررسی";
			$colorrecuesst="";
			}
			else if($rowsvam["status"]==1){
				$statusvam="درخواست تایید شده است";
				$colorrecuesst="success";
			}
			else if($rowsvam["status"]=='-1'){
				$statusvam="درخواست رد شده است";
				$colorrecuesst="danger";
			}
		echo "<tr class='bg-".$colorrecuesst."'>
		  <th scope='col'>#</th>
		  <th scope='col'>".$rowsvam["name"]."</th>
		  <th scope='col'>".$rowsvam["amount"]."</th>
		  <th scope='col'>".$rowsvam["month"]."</th>
		  <th scope='col'>".$statusvam."</th>";
		  if($rowsvam["status"]==0){
		  echo "<form name='vamstatus' method='post' action=''>
			  	<input type='hidden' name='vamid' value='".$rowsvam["id"]."'>
				<input type='hidden' name='vamamount' value='".$rowsvam["amount"]."'>
				<input type='hidden' name='vamusermeliid' value='".$rowsvam["meliid"]."'>
				<input type='hidden' name='vammonth' value='".$rowsvam["month"]."'>
		    	<th scope='col'><input type='submit' class='btn btn-outline-success ' value='تایید' name='vamoky' /> <input type='submit' class='btn btn-outline-danger ' value='رد دادن' name='vamnot' /></th>
			</form>";
		  }else{
			   echo "<form name='vamstatus' method='post' action=''>
			  	<input type='hidden' name='vamid' value='".$rowsvam["id"]."'>
		    	<th scope='col'><input type='submit' class='btn btn-outline-info ' value='بازنشانی' name=''  /> </th>
			</form>";
		  }
	 	 echo "</tr>";
	
	}

?>
</table>
 </div> 

<!--------------------------------------------------------------------------------------------------------------------------------->

<div class="row col-12 alert alert-dark ">
  <div class="col-6 title">
    <h2>مدیریت کاروان</h2>
  </div>
  <div class="col-6 logo-uni" > <img src="image/1_Velaiat.png" width="40" height="40" /> <img src="image/jz9z_-4.png" width="40" height="40" />
    
  </div>
</div>
<!--- row col-lg-12 alert alert-dark  --->
         
 
 
</div><!--- container  --->

</body>
</html>

