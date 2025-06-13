<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../../vendor/autoload.php';

$codigo = rand(1000, 9999);

$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username = $_ENV['MAIL_USER'];
$mail->Password = $_ENV['MAIL_PASS'];
$mail->setFrom($_ENV['MAIL_USER'], 'CineParaiso');
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;


// Receptor
$mail->addAddress($correo, 'Usuario');

// Contenido del correo
$mail->isHTML(true);                                  
$mail->Subject = 'Restablece tu contraseña de CineParaiso';
$mail->Body = '
<html>
<head>
  <meta charset="UTF-8">
  <title>Restablecimiento de contraseña</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
  <table width="100%" bgcolor="#f1f3f5" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" cellpadding="20" cellspacing="0" bgcolor="#f39a3f"">
          <tr>
            <td style="text-align: center;">
              <img src="https://pruebacineparaiso.free.nf/src/Logo.png" alt="CineParaiso" style="height: 50px; margin: 10px; filter: drop-shadow(4px 5px 1px black);">
            </td>
          </tr>
          <tr>
            <td style= "background-color: #f7e5c6; ">
              <h2>Hola, has solicitado restablecer tu contraseña.</h2>
              <p>Puedes restablecer la contraseña de tu cuenta de <strong>CineParaiso</strong> usando el siguiente código:</p>
              <div style="text-align: center; margin: 30px 0;">
                <h1 style="font-size: 32px; background-color: #8b4a28; color: white; padding: 15px; border-radius: 8px; display: inline-block;"><a href="localhost:8080/PHP/recuperar-password.php?codigo='.$codigo.'"  style="text-decoration: none; color: white;">Recuperar Contraseña</a></h1>
              </div>
              <p>Si no has solicitado este cambio, puedes ignorar este correo.</p>
              <p style="margin-top: 40px;">Disfruta viendo películas,<br><strong>CineParaiso</strong></p>
              <p style="font-size: 12px; color: #888;">Este mensaje fue enviado automáticamente. Por favor, no respondas a este correo.</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';


                
