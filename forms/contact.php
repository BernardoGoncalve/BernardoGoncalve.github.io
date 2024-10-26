<?php
require 'vendor/autoload.php';  // Certifique-se de que o Composer carregou a biblioteca Mailjet

use \Mailjet\Resources;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Configurações da API do Mailjet
    $apiKey = '7f279028f2b9f95c0a7445e5db063a27';
    $apiSecret = '88549da93104f2bfad7187ec3f08f6a5';

    $mj = new \Mailjet\Client($apiKey, $apiSecret, true, ['version' => 'v3.1']);
    
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $email,
                    'Name' => $name
                ],
                'To' => [
                    [
                        'Email' => 'bernardoprogramming@gmail.com',
                        'Name' => 'Recipient Name'
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => $message,
                'HTMLPart' => "<h3>$subject</h3><p>$message</p>",
                'CustomID' => 'AppGettingStartedTest'
            ]
        ]
    ];

    $response = $mj->post(Resources::$Email, ['body' => $body]);

    if ($response->success()) {
        echo 'Sua mensagem foi enviada. Obrigado!';
    } else {
        echo 'A mensagem não pode ser enviada. Erro: ' . $response->getReasonPhrase();
    }
} else {
    echo 'Método de solicitação inválido.';
}
?>