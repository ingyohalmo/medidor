<?php
include("connect.php"); 	
	
	$link=Connection();
	
	$sth1 = $link->prepare("SELECT fecha_hora FROM medidor ORDER BY fecha_hora DESC LIMIT 1");
	$sth1->execute();
    
    $sth2 = $link->prepare("SELECT ROUND(AVG(voltaje),2) as voltajeProm FROM medidor");
	$sth2->execute();
    
    $sth3 = $link->prepare("SELECT ROUND(AVG(corriente),2) as corrienteProm FROM medidor");
	$sth3->execute();
    
    
    $sth4 = $link->prepare("SELECT ROUND(AVG(energia),2) as energiaProm FROM medidor");
	$sth4->execute();
    
    $sth5 = $link->prepare("SELECT ROUND(SUM(voltaje),2) as voltajeSum FROM medidor");
	$sth5->execute();
    
    $sth6 = $link->prepare("SELECT ROUND(SUM(corriente),2) as corrienteSum FROM medidor");
	$sth6->execute();
    
    $sth7 = $link->prepare("SELECT ROUND(SUM(energia),2) as energiaSum FROM medidor");
	$sth7->execute();
    
foreach($sth1->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$fecha = $row['fecha_hora'];	
endforeach;

foreach($sth2->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$volt = $row['voltajeProm'];	
endforeach;

foreach($sth3->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$corr = $row['corrienteProm'];	
endforeach;

foreach($sth4->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$energ = $row['energiaProm'];	
endforeach;


foreach($sth5->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$volt1 = $row['voltajeSum'];	
endforeach;

foreach($sth6->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$corr1 = $row['corrienteSum'];	
endforeach;

foreach($sth7->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$energ1 = $row['energiaSum'];	
endforeach;


require("PHPMailer/PHPMailerAutoload.php");

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'yohalmito4@gmail.com';          // SMTP username
$mail->Password = 'yohalmo1395';                   // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('ing.yohalmo@hotmail.com', 'YohalmoDiaz');
$mail->addReplyTo('ing.yohalmo@hotmail.com', 'YohalmoDiaz');
$mail->addAddress('yohalmito4@gmail.com');   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '
        <h2>Consumo Promedio Hasta la Fecha</h2>
        <table style="border: 1px solid black;" border="1" style="width:100%">
            <td>Voltaje Prom (Volt) : '.$volt.'</td>
            <td>Corriente Prom (Amper) : '.$corr.'</td>
            <td>Energia Prom (KWh) : '.$energ.'</td>    
        </table><br>
        <h2>Consumo Acumulado Hasta la Fecha</h2>
        <table style="border: 1px solid black;" border="1" style="width:100%">
            <td>Voltaje Acum (Volt) : '.$volt1.'</td>
            <td>Corriente Acum (Amper) : '.$corr1.'</td>
            <td>Energia Acum (KWh) : '.$energ1.'</td>
        </table>';
$bodyContent .= '<p>Fecha: <b>'.$fecha.'</b></p>';

$mail->Subject = 'Correo enviado desde servidor por Yohalmo Diaz';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'no se pudo enviar mensaje.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'mesaje enviado exitosamente!';
}
?>
