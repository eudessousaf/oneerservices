<?php
// Lista de apps com seus respectivos links
$apps = [
    'app1' => [
        'android' => 'https://play.google.com/store/apps/details?id=com.exemplo.app1',
        'ios' => 'https://apps.apple.com/app/id1111111111',
    ],
    'zeapp' => [
        'android' => 'https://play.google.com/store/apps/details?id=com.exemplo.zeapp',
        'ios' => 'https://apps.apple.com/app/id2222222222',
    ],
    'meucliente' => [
        'android' => 'https://play.google.com/store/apps/details?id=com.exemplo.meucliente',
        'ios' => 'https://apps.apple.com/app/id3333333333',
    ]
];

// Captura a URL acessada, por exemplo: "/redirecionar/app1"
$uri = trim($_SERVER['REQUEST_URI'], '/');

// Separa por barra e pega a última parte ("app1", "zeapp", etc)
$partes = explode('/', $uri);
$chave = $partes[count($partes) - 1];

// Verifica se a chave existe na lista de apps
if (!isset($apps[$chave])) {
    // Se não existir, redireciona para uma página padrão (pode ser sua landing de download)
    header("Location: https://oneer.com.br/baixar-app");
    exit();
}

// Detecta o tipo de aparelho do usuário
$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

if (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
    // Se for iOS, redireciona pro link da App Store
    header("Location: " . $apps[$chave]['ios']);
    exit();
} elseif (strpos($userAgent, 'android') !== false) {
    // Se for Android, redireciona pro link da Play Store
    header("Location: " . $apps[$chave]['android']);
    exit();
} else {
    // Se não for possível detectar, manda para a página padrão
    header("Location: https://oneer.com.br/baixar-app");
    exit();
}
?>
