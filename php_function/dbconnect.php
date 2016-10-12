// <?php
//     $db =  
//     mysqli_connect('localhost', 'root', '', 'kakeibo_db') 
//         or die(mysqli_connect_error());
//     mysqli_set_charset($db, 'utf8');
    
// ?>

<?php
	    // A simple PHP script demonstrating how to connect to MySQL.
	    // Press the 'Run' button on the top to start the web server,
	    // then click the URL that is emitted to the Output tab of the console.
	
	    $servername = getenv('IP');
	   // $username = getenv('C9_USER');
	    $username = "root";
	    $password = "";
	    $database = "kakeibo_db";
	    $dbport = 3306;
	
	    // Create connection
	    $db = new mysqli($servername, $username, $password, $database, $dbport);
	
	    // Check connection
	    if ($db->connect_error) {
	        die("Connection failed: " . $db->connect_error);
	    } 
	   // echo "Connected successfully (".$db->host_info.")";
	    
	    // $db = new mysqli($servername, $username, $password, $database, $dbport) 
	    // 		or die(mysql_connect_errror());
	    // echo "Connected successfully (".$db->host_info.")";
	    mysqli_set_charset($db, "utf8");
	    
	    function mysql_connect_errror() {
	    	echo("Connection failed: ". $db->connect_error);
	    }

?>