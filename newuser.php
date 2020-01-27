<?php
     session_start();
     include('connect.php');
	 ob_start();

?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<head>
<title>سامانه  > ثبت نام</title>
<style>


</style>
<?php

$error="";	
$num=0;
if(!empty($_POST['sub'])){
	
		if(!empty($_POST['password']) && $_POST['password']==$_POST['password2']){
		
			
			if(!empty($_POST['name'])&!empty($_POST['phonenumber'])&!empty($_POST['meliid']))
			{
				$meliid=en_number($_POST['meliid']);
				$bo="SELECT * FROM `user` where `meliid` = '$meliid' ";
				$boo= $conn->query($bo);
				$num=$boo->fetchColumn();
				
				if($num<1){
				
				
				$name=$_POST['name'];$family=$_POST['family'];
				$stid=$_POST['stid']; $borndate=$_POST['borndate']; $mgname=$_POST['mgname'];
				$se=$_POST['se']; $phonenumber=$_POST['phonenumber']; $adress=$_POST['adress'];
				$phone2=$_POST['phone2']; $passport=$_POST['passport']; $passport_nu=$_POST['passport-nu']; $password=$_POST['password'];
		
				$sql="INSERT INTO `user` (`id`, `name`, `family`, `meliid`, `stid`, `borndate`, `mgname`, `se`, `phonenumber`,`adress`,`phone2`, `passport`,`passport-nu`,`password`)
		                       VALUES (NULL,'$name' ,'$family', '$meliid','$stid', '$borndate','$mgname', '$se','$phonenumber','$adress', '$phone2','$passport','$passport_nu', '$password')";
					$conn->exec($sql);
					
					$sqluserbackup="INSERT INTO `userbackup` (`id`, `name`, `family`, `meliid`, `stid`, `borndate`, `mgname`, `se`, `phonenumber`,`adress`,`phone2`, `passport`,`passport-nu`,`password`)
		                       VALUES (NULL,'$name' ,'$family', '$meliid','$stid', '$borndate','$mgname', '$se','$phonenumber','$adress', '$phone2','$passport','$passport_nu', '$password')";
					$conn->exec($sqluserbackup);
					
					if($conn){
					$error='<div class="alert alert-success " ><div class="container t-d-r font-homa" >زائر جدید ثبت شد</div></div>';
					$_SESSION['meliid']=$meliid;
					$_SESSION['name']=$_POST['name'];
					$_SESSION['family']=$_POST['family'];
					$_SESSION['se']=$_POST['se'];
					Header('Location:pay.php');
					}
					else{
						$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >ثبت نام با مشکل مواجه شد</div></div>';	
					}
					$conn = null;
			
			}//if($num<1){
			else{
					$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >این کد ملی قبلا ثبت نام شده است</div></div>';			
			}
			}//if(!empty($_POST['name'])&!empty($_POST['phonenumber'])&!e
			else{
				
				$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >فیلد های خالی را تکمیل نمایید</div></div>';			
					}
		}//	if(!empty($_POST['password']) && $_POST['password']==$
		else{
			$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >پسورد با تکرار آن مطابقت ندارد</div></div>';
					
		}
}//if(!empty($_POST['sub'])){
else{
	$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >فیلد های خالی را تکمیل نمایید</div></div>';	
}


function en_number($number)
{
   $en = array("0","1","2","3","4","5","6","7","8","9");
   $fa = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
   return str_replace($fa, $en, $number);
}

?>
	?>
</head>
<body>
<div class="container login-singin mb-5"> 
  <!-----------------card------------------->
  <div class="card">
    <div class="card-header"> به سامانه زائر خوش آمدید </div>
    
    
    
    
    <div class="card-body">
    <?php
		echo $error;
	
	?>
      <h5 class="card-title bg-light p-4 font-mehrdad">اطلاعات را با دقت کامل تکمیل نمایید</h5>
       <h5 class="card-title bg-warning p-4 font-mehrdad">در صورت داشتن گذرنامه شماره آن را وارد کنید  در غیر این صورت فیلد را خالی بگذارید</h5>
       <h5 class="card-title bg-warning p-4 font-mehrdad">در نوشتن رمز عبور فقط از اعداد و کاراکتر انگلیسی استفاده نمایید</h5>
     
      <!-----------------row login or singin ------------------->
      
      <form name="newuser" method="post" class="">
        <div class="row text-center col-lg-12  rounded mt-5" >
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">نام : <span class="badge badge-danger">الزامی</span></h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="name">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">نام خانوادگی : <span class="badge badge-danger">الزامی</span></h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="family">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3" >کد ملی : <span class="badge badge-danger">الزامی</span></h5>
            <input type="text" dir="ltr" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="meliid" maxlength="10">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3" >شماره دانشجویی : <span class="badge badge-danger">الزامی</span></h5>
            <input type="text" dir="ltr" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="stid"  maxlength="7">
          </div>
          <!-------------------------------------- line ---------------------------------------->
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">سال تولد :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="borndate">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">رشته :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="mgname">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">جنسیت : <span class="badge badge-danger">الزامی</span></h5>
            <select name="se" class="col-12 mr-4 mt-5 form-control">
              <option value="1">مرد </option>
              <option value="0">زن</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">شماره تماس  :</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="phonenumber">
          </div>
          <!-------------------------------------- line ---------------------------------------->
          <div class="col-lg-8 col-md-12">
            <h5 class="float-right m-3">آدرس منزل : <span class="badge badge-danger">الزامی</span></h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="adress">
          </div>
          <div class="col-lg-4 col-md-12">
            <h5 class="float-right m-3">شماره منزل یا والدین:</h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="phone2" >
          </div>
          <!-------------------------------------- line ---------------------------------------->
          
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">آیا گذر نامه دارید ؟</h5>
            <select name="passport" class="col-12 mr-4 mt-5 form-control" id="passno" onChange="ss(this.value)">
             <option value="no">خیر</option>
              <option value="yes">بله</option>
              <option value="action">اقدام کرده ام</option>
            </select>
         
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">شماره گذرنامه :</h5>
            <input type="tel" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" id="passnumber" name="passport-nu">
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3">رمز ورود : <span class="badge badge-danger">الزامی</span> </h5>
            <input type="password" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="password"
             style="font-family:Arial, Helvetica !important; direction:ltr !important;text-align:left !important; " >
          </div>
          <div class="col-lg-3 col-md-12">
            <h5 class="float-right m-3"> تکرار رمز ورود : <span class="badge badge-danger">الزامی</span></h5>
            
		<input type="password" class="form-control m-4 e-l-f" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="password2" 
		style="font-family:Arial, Helvetica !important; direction:ltr !important;text-align:left !important; " >
          
          </div>
          <div class="col-lg-12 col-md-12">
            <h5 class="float-right m-3">جواب را تایپ نمایید - 2+2=؟ <span class="badge badge-danger">الزامی</span></h5>
            <input type="text" class="form-control m-4" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="key">
          </div>
          <input type="submit" class="btn btn-success btn-lg btn-block mr-4 mt-5" value="ثبت نام" name="sub">
        </div>
        <!-----------------end row login or singin ------------------->
        
      </form>
    </div>
    <!-----------------end card body------------------->
    
    <div class="card-footer text-muted text-center"> <a href="/prjsoft" class="btn btn-info"  >ورود به سایت</a>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">تماس با  مدیر سایت</button>
     </div>
  </div>
  <!-----------------end card-------------------> 
  
</div>
<!-----------------end container------------------->

</body>
<footer>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">فراموشی رمز عبور</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        کاربر گرامی  جهت بازیابی رمزعبور با مسئولین کاروان خود تماس حاصل نمایید
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>


  	<script>
	document.getElementById("passnumber").value="غیر فعال";
 	document.getElementById("passnumber").disabled = true;
	
	function ss(m){
		if(m=='yes'){
			document.getElementById("passnumber").value="";
			document.getElementById("passnumber").disabled = false;
			
		}else{
				document.getElementById("passnumber").value="غیر فعال";
			 	document.getElementById("passnumber").disabled = true;

		}
		
	}
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