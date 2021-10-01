<?php
    ob_start();
	require('BenefitAPIPlugin.php');

	$Pipe = new iPayBenefitPipe();
	
	// modify the following to reflect your "Tranportal ID", "Tranportal Password ", "Terminal Resourcekey"
	$Pipe->setkey("12232894503312232894503312232894");
	$Pipe->setid("17056950");
	$Pipe->setpassword("17056950");
	
	// Do NOT change the values of the following parameters at all.
	$Pipe->setaction("1");
	$Pipe->setcardType("D");
	$Pipe->setcurrencyCode("048");
	
	// modify the following to reflect your pages URLs
//	$Pipe->setresponseURL("https://www.yourWebsite.com/PG/response.php");
//	$Pipe->seterrorURL("https://www.yourWebsite.com/PG/error.php");
	$Pipe->setresponseURL("https://kt.estrradoweb.com//benefit/Response.php");
	$Pipe->seterrorURL("https://kt.estrradoweb.com//benefit/err.php");
	
	
	// set a unique track ID for each transaction so you can use it later to match transaction response and identify transactions in your system and “BENEFIT Payment Gateway” portal.
	$Pipe->settrackId("K0002");
	
	// set transaction amount
	$Pipe->setamt("1");
	
	// The following user-defined fields (UDF1, UDF2, UDF3, UDF4, UDF5) are optional fields.
	// However, we recommend setting theses optional fields with invoice/product/customer identification information as they will be reflected in “BENEFIT Payment Gateway” portal where you will be able to link transactions to respective customers. This is helpful for dispute cases. 
	$Pipe->setudf1("Merlin");
	$Pipe->setudf2("Merlin@estrrado.com");
	$Pipe->setudf3("8973732732");
	$Pipe->setudf4("Trivandrum");
	$Pipe->setudf5("Kerala");
	
	$isSuccess = $Pipe->performeTransaction();
	if($isSuccess==1){
		header('location:'.$Pipe->getresult());
	}
	else{
		echo 'Error: '.$Pipe->geterror().'<br />Error Text: '.$Pipe->geterrorText();
	}
?>