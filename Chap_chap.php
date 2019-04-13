<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$Services    = $_POST["Services"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
$networkcode = $_POST["networkcode"];

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON What would you want to check \n";
    $response .= "1. My Account \n";
    $response .= "2. Services";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response = "1. Account number \n";
    $response = "2. Account balance";

}else if ($text == "2") {
    // Business logic for first level response
    $response = "1. Buy ";
	$response = "2. Sell ";
	


} else if($text == "1*1") { 
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "ACC1001";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your account number is".$accountNumber;

} else if ( $text == "1*2" ) {
    // This is a second level response where the user selected 1 in the first instance
    $balance  = "10,000 Tokens";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your balance is ".$balance;
	
} else if($text == "2*1") { 

    require 'dbconfig/config.php';
    // This is a second level response where the user selected 2 in the first instance
	    $response  ="1. Tokens \n ".$Services;
	    $Tokens    =$_POST["Tokens"]; 
	
	if(isset($_POST["Tokens"])){
		$tokens   = 20000;
		$tokens   = $_POST["tokens"];
        $Tokens   = $tokens - $balance;
}	
	//This is a terminal request. Note how we start the response with END
	$response = "END Your token balance is ".$Tokens;
 
} else if($text == "2*2") { 
     require 'dbconfig/config.php';
    // This is a second level response where the user selected 1 in the second instance
        $response  = "2. Quantity ".$Services;
	    $Quantity  =$_POST["quantity"]; 
	
	if(isset($_POST["quantity"])){
		$number1     = 90;
        $number2     = 1.840;
        $number3     = 0.2;
        $Conrate     = $number2 / $number1;
	    $result = ($Quantity * $Conrate) - ($number3 * ($Quantity - $conrate));
}
	// This is a terminal request. Note how we start the response with END
    $response = "END You have received '$result' tokens ".$result;	
}
// Echo the response back to the API
header('Content-type: text/plain');
echo $response;
?>
<form action="Chap_chap.php" method="POST">
	     <input type = "integer" name="Tokens" placeholder="Tokens">
		 <input type="Submit" placeholder="Balance">
	</form>
	
<form action="Chap_chap.php" method="POST">
	     <input type = "integer" name="quantity" placeholder="Quantity(Kg)">
		 <input type="Submit" placeholder="Get Tokens">
	</form>
	
