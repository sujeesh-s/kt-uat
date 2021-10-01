<?php
	require('plugin/iPayBenefitPipe.php');
	
	$myObj =new iPayBenefitPipe(); 
	
	// modify the following to reflect your "Alias Name", "resource.cgn" file path, "keystore.pooh" file path.
	$myObj->setAlias("test17056950");
	$myObj->setResourcePath("resource/"); //only the path that contains the file; do not write the file name
	$myObj->setKeystorePath("resource/"); //only the path that contains the file; do not write the file name
	
	$trandata = "";
	$paymentID = "";
	$result = "";
	$responseCode = "";
	$transactionID = "";
	$referenceID = "";
	$trackID = "";
	$amount = "";
	$UDF1 = "";
	$UDF2 = "";
	$UDF3 = "";
	$UDF4 = "";
	$UDF5 = "";
	$authCode = "";
	$postDate = "";
	$errorCode = "";
	$errorText = "";
	echo 'aaaa';
	$trandata = isset($_POST["trandata"]) ? $_POST["trandata"] : "";
	
	if ($trandata != "")
	{ echo 'bbbbbbb';
		$returnValue = $myObj->parseEncryptedRequest($trandata);
		if ($returnValue == 0)
		{ echo 'sss';
		echo	$paymentID = $myObj->getPaymentId();
			$result = $myObj->getRef(); print_r($result);
			$responseCode = $myObj->getAuthRespCode();
			$transactionID = $myObj->getTransId();
			$referenceID = $myObj->getRef();
			$trackID = $myObj->getTrackId();
			$amount = $myObj->getAmt();
			$UDF1 = $myObj->getUdf1();
			$UDF2 = $myObj->getUdf2();
			$UDF3 = $myObj->getUdf3();
			$UDF4 = $myObj->getUdf4();
			$UDF5 = $myObj->getUdf5();
			$authCode = $myObj->getAuth();
			$postDate = $myObj->getDate();
			$errorCode = $myObj->getError();
			$errorText = $myObj->getError_text();
		}
		else
		{  echo 'ccc';
			$errorText = $myObj->getError_text();
		}
	}
	else if (isset($_POST["ErrorText"]))
    { echo 'dddd';
        $paymentID = $_POST["paymentid"];
        $trackID = $_POST["Trackid"];
        $amount = $_POST["amt"];
        $UDF1 =  $_POST["UDF1"];
        $UDF2 =  $_POST["UDF2"];
        $UDF3 =  $_POST["UDF3"];
        $UDF4 =  $_POST["UDF4"];
        $UDF5 = $_POST["UDF5"];
        $errorText = $_POST["ErrorText"];
    }
    else
    { echo 'eeee';
        $errorText = "Unknown Exception";
    }
		
	echo $paymentID;
	echo $result;
	echo $responseCode;
	echo $transactionID;
	echo $referenceID;
	echo $trackID;
	echo $amount;
	echo $UDF1;
	echo $UDF2;
	echo $UDF3;
	echo $UDF4;
	echo $UDF5;
	echo $authCode;
	echo $postDate;
	echo $errorCode;
	echo $errorText;
?>