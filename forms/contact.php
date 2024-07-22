<?php
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

//   // Replace contact@example.com with your real receiving email address
//   $receiving_email_address = 'bernardobarrocasgoncalves12@gmail.com';

//   if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//     include( $php_email_form );
//   } else {
//     die( 'Unable to load the "PHP Email Form" Library!');
//   }

//   $contact = new PHP_Email_Form;
//   $contact->ajax = true;

//   $contact->to = $receiving_email_address;
//   $contact->from_name = $_POST['name'];
//   $contact->from_email = $_POST['email'];
//   $contact->subject = $_POST['subject'];

//   // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
//   /*
//   $contact->smtp = array(
//     'host' => 'example.com',
//     'username' => 'example',
//     'password' => 'pass',
//     'port' => '587'
//   );
//   */

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

//   echo $contact->send();
//
?>

<!-- <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Configurações do e-mail
    $to = 'bernardoprogramming@gmail.com';
    $headers = "From: $email";

    // Corpo do e-mail
    $email_body = "Nome: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Assunto: $subject\n";
    $email_body .= "Mensagem:\n$message\n";

    // Enviar o e-mail
    if (mail($to, $subject, $email_body, $headers)) {
        echo 'Sua mensagem foi enviada. Obrigado!';
    } else {
        echo 'Houve um problema ao enviar sua mensagem. Tente novamente.';
    }
} else {
    echo 'Método de solicitação inválido.';
}
?> -->

<?php
require 'vendor/autoload.php';

use SendGrid\Mail\Mail;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $email = new Mail();
    $email->setFrom($email, $name);
    $email->setSubject($subject);
    $email->addTo('contact@example.com', 'Recipient');
    $email->addContent('text/plain', $message);

    $sendgrid = new \SendGrid('YOUR_SENDGRID_API_KEY');

    try {
        $response = $sendgrid->send($email);
        echo 'Sua mensagem foi enviada. Obrigado!';
    } catch (Exception $e) {
        echo 'A mensagem não pode ser enviada. Erro: ' . $e->getMessage();
    }
} else {
    echo 'Método de solicitação inválido.';
}