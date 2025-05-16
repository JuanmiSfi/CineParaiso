<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../vendor/autoload.php';

$codigo = rand(1000, 9999);

$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'sfijuanmifp@gmail.com';
$mail->Password   = 'cfox exqz mopg aqfu';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;

// Emisor del correo
$mail->setFrom('sfijuanmifp@gmail.com', 'CineParaiso');

// Receptor
$mail->addAddress($correo, 'Usuario');

// Contenido del correo
$mail->isHTML(true);                                  // Permite HTML en el cuerpo
$mail->Subject = 'Bienvenido a CineParaiso';
$mail->Body    = '
                <html>
<head>
    <meta charset="UTF8" />
  <title>Código de verificación</title>
</head>
<body>

<img src="/src/Logo" style="width=100px">


<h2>Codigo de verificacion del correo electronico</h2>
<p>Introduce este codigo en la pantalla de verificación de identidad</p>
<h2>' . $codigo . '</h2>
</body>
</html>
                
                
                ';

                
