<?php
	 session_start();
     include('connect.php');
				ob_start();
				
	$IP = $_SERVER['REMOTE_ADDR']; 
	/*date_default_timezone_set("Asia/Tehran");
	$t=time();
	$date=date("Y/m/d",$t);
	$time=date("h:i:sa");
	$sqltablevisit="INSERT INTO `visit`(`id`, `ip`, `time`, `date`,`page`) VALUES (NULL,'$IP','$time','$date','index.php')";
	$conn->exec($sqltablevisit);*/



				$error="";
	 			if(!empty($_POST['login'])){
				if(!empty($_POST['username']) & !empty($_POST['password'])){
					
					$username=en_number($_POST['username']);
					$password=$_POST['password'];
					
					$bo="SELECT * FROM `user` where `meliid` =  '$username' ";

					$boo= $conn->query($bo);
					$num=$boo->fetchColumn();
				
					if($num>1){
					
					$stmt = $conn->prepare( "SELECT * FROM `user` where `meliid` = '$username' " );
						$stmt->bindValue( 1, $_POST[ 'username' ] );
						$stmt->execute();
						$user = $stmt->fetch( PDO::FETCH_OBJ );
						$pppp=$user->password;
						
						$error="";
						if($password==$user->password  ) {
							$_SESSION[ 'name' ] = $user->name;
							$_SESSION[ 'family' ] = $user->family;
							$_SESSION[ 'meliid' ] = $username;
							$_SESSION[ 'se' ] = $user->se;
							header('Location: '."cpanel.php");
							
						}//if($password==$user->password  ) {
						else{
							$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >نام کاربری یا گذرواژه صحیح نمی باشد</div></div>';
						}
					
					}//if($num<1){
					else{
							$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >کد ملی اشتباه است</div></div>';
						}
				}//if(!empty($_POST['username']) & !empty($_POST['password'])){
				else{
							$error='<div class="alert alert-danger " ><div class="container t-d-r font-homa" >فیلد های نام کاربری و گذرواژه را تکمیل نمایید</div></div>';	
					}
				
			}//if(!empty($_POST['login'])){
				
				
				
function en_number($number)
{
   $en = array("0","1","2","3","4","5","6","7","8","9");
   $fa = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
   return str_replace($fa, $en, $number);
}

				
	 
?>

<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

<head>
	<title>سامانه زائر</title>
	<style type="text/css">
	
	</style>
</head>
<body>
    <div class="container login-singin  ">
    	    		           <!-----------------card------------------->
                        <div class="card ">
                              <div class="card-header">
                                به سامانه خوش آمدید
                              </div>
                              <div class="card-body">
                                <h5 class="card-title bg-warning p-4 font-mehrdad">بازه زمانی ثبت نام ، ویژه تکمیل ظرفیت</h5>
                              
                                 <?php
									   echo $error;
									   
									   ?>
                                 <!-----------------row login or singin ------------------->
                                <div class="row text-center  rounded" > 
                                      
                                          <div class="col-lg-6 col-md-12">
                                          <form name="log"  method="post" >
                                           <h5 class="float-right m-3">نام کاربری یا کد ملی :</h5>
                                           <input type="text" name="username" class="form-control font-tahoma"  aria-label="Username" aria-describedby="addon-wrapping" maxlength="10"  
                                           style="font-family:Arial, Helvetica !important; direction:ltr !important;text-align:left !important;" >  
                                           <h5 class="float-right m-3">رمز عبور :</h5>
                                           <input type="password" name="password" class="form-control"  aria-label="password" aria-describedby="addon-wrapping"
                                            style="font-family:Arial, Helvetica !important; direction:ltr !important;text-align:left !important; "> 
                                          <input type="submit" class="btn btn-info btn-lg btn-block mt-3 " value="ورود" name="login">
                                          </form>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-12 mt-3">
                                           <a href="newuser.php"> 
                                           <img src="images/id-card.png" width="40%">
                                            <h2> ثبت نام </h2>
                                            </a>
                                        </div>
                                        
                                </div> 
                                <!-----------------end row login or singin ------------------->

                               </div>
                               <!-----------------end card body-------------------> 
                               
                               
                               <div class="card-footer text-muted text-center">
                               <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">فراموشی  رمز عبور</button>
                               <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal2">تماس با  مدیر سایت</button>
                               <button type="button" class="btn btn-info" >ip شما: <?php echo $IP; ?></button>

                                </div>
                               
                      </div>
                      <!-----------------end card------------------->
                         
    </div>
    <!-----------------end container------------------->

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


<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تماس با مدیر سایت</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
جهت تماس با مدیر سایت با شماره 

09136638049
تماس حاصل نمایید


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>


</body>
	<footer>
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