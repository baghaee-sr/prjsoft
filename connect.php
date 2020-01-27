<?php
	
				
			$servername = "localhost";
			$username = "root";
			$password = "";
			
			try {
				$conn = new PDO("mysql:host=$servername;dbname=prjsoft", $username, $password);
			
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->exec("set names utf8");
				}
			catch(PDOException $e)
				{
				echo "Connection failed: " . $e->getMessage();
				}

	
	
	
	
	
?>