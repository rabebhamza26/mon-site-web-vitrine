<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Inclure les fichiers nécessaires de PHPMailer
require '../vendor/autoload.php';


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    $mail = new PHPMailer(true);
    
    try {
       // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Activer les logs de débogage
        $mail->isSMTP();
        $mail->Host = 'smtp.topnet.tn';
        $mail->SMTPAuth = true;
        $mail->Username = 'moslem.hamzaoui@eci.com.tn';
        $mail->Password = '22074869a';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Port recommandé pour TLS

        $mail->setFrom('moslem.hamzaoui@eci.com.tn', 'Votre Nom');
        $mail->addAddress('moslem.hamzaoui@eci.com.tn');

        $mail->isHTML(true);
        $mail->Subject = "Message de $name: $subject";
        $mail->Body = "Nom: $name<br>Email: $email<br>Sujet: $subject<br>Message:<br>$message";
        $mail->AltBody = "Nom: $name\nEmail: $email\nSujet: $subject\nMessage:\n $message";

        $mail->send();
        echo "Votre message a été envoyé avec succès.";
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
    }
}

?>
<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($message_sent): ?>
        Swal.fire({
            title: 'Success!',
            text: 'Your message has been received.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>



