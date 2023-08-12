<html>
<head>
<title> Custom Form Kit </title>
</head>
<body>
<center>

@php
function encrypt2($plainText,$key)
{
	$key = hextobin2(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	$encryptedText = bin2hex($openMode);
	return $encryptedText;
}

/*
* @param1 : Encrypted String
* @param2 : Working key provided by CCAvenue
* @return : Plain String
*/
function decrypt2($encryptedText,$key)
{
	$key = hextobin2(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$encryptedText = hextobin2($encryptedText);
	$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	return $decryptedText;
}

function hextobin2($hexString) 
 { 
	$length = strlen($hexString); 
	$binString="";   
	$count=0; 
	while($count<$length) 
	{       
	    $subString =substr($hexString,$count,2);           
	    $packedString = pack("H*",$subString); 
	    if ($count==0)
	    {
			$binString=$packedString;
	    } 
	    
	    else 
	    {
			$binString.=$packedString;
	    } 
	    
	    $count+=2; 
	} 
        return $binString; 
  } 


	error_reporting(0);
	
	$merchant_data='';
	$working_key='71C601249EB02EF527619F404F6536F6';//Shared by CCAVENUES
	$access_code='AVNJ21KB60BH74JNHB';//Shared by CCAVENUES
	// dd($_POST);
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.urlencode($value).'&';
	}

	// dd($merchant_data);

	$encrypted_data=encrypt2($merchant_data,$working_key); // Method for encrypting the data.
	// "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction

@endphp
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
@php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
@endphp
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

