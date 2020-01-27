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
<title>سامانه زائر > ثبت نام</title>
<style>


</style>

</head>
<body>
<div class="container login-singin mb-5"> 
  <!-----------------card------------------->
  <div class="card">
    <div class="card-header"> به سامانه زائر خوش آمدید </div>
    
    
    
    
    <div class="card-body">
   
   <?php
   
 echo 'User IP - '.$_SERVER['REMOTE_ADDR'];
 
	 ?>
     	<h2> ---------------------- </h2>
     <?php

			// PHP program to get IP address of client 
			$IP = $_SERVER['REMOTE_ADDR']; 
			
			// $IP stores the ip address of client 
			echo "Client's IP address is: $IP"; 
			
			// Print the ip address of client 
 


   ?>
   
        	<h2> ---------------------- </h2>

   
   <?php 

		$s="sssssssssssssssssssss";
		echo $s;
		$e="eeeeeeeeeeeeeeeeeeeeeeeeeee";
		echo $e;
		
		
?> 
     	<h2> ---------------------- </h2>
<?php

$l=$s.$e;
echo $l;


?>
<form method="get" name="f1">

<input type="submit" name="usermeliid" value="1312">

</form>

    </div>
    <!-----------------end card body------------------->
    
    <div class="card-footer text-muted text-center"> <a href="http://bdvu.ir" class="btn btn-info"  >ورود به سایت</a>
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