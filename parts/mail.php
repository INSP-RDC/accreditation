<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuration du serveur
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com';   // Votre serveur SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'votre@email.com';    // Votre identifiant
    $mail->Password   = 'votre_mot_de_passe'; // Votre mot de passe
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Destinataires
    $mail->setFrom('votre@email.com', 'Votre Nom');
    $mail->addAddress('destinataire@gmail.com');

    // Contenu
    $mail->isHTML(true);
    $mail->Subject = 'Sujet de l\'email';
    $mail->Body    = 'Ceci est le corps du message en <b>HTML</b>';
    $mail->AltBody = 'Ceci est le message en texte brut pour les clients non-HTML';

    $mail->send();
    echo 'Message envoyé !';
} catch (Exception $e) {
    echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
}