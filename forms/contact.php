<?php
require '../vendor/autoload.php';  // Ajuste o caminho conforme necessário

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

    try {
        $response = $mj->post(Resources::$Email, ['body' => $body]);

        // Exibir a resposta completa para depuração
        echo '<pre>';
        print_r($response->getData());
        echo '</pre>';

        if ($response->success()) {
            echo 'Sua mensagem foi enviada. Obrigado!';
        } else {
            echo 'A mensagem não pode ser enviada. Erro: ' . $response->getReasonPhrase() . ' - Código: ' . $response->getStatus();
        }
    } catch (Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
} else {
    echo 'Método de solicitação inválido.';
}
?>