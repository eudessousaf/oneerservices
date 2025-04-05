<?php
// Importa a lista de apps de outro arquivo
$apps = include 'apps.php';

// Captura a URL acessada
$uri = trim($_SERVER['REQUEST_URI'], '/');
$partes = explode('/', $uri);
$chave = $partes[count($partes) - 1];

// Verifica se a chave existe na lista de apps
if (!isset($apps[$chave])) {
    header("Location: https://oneer.com.br/baixar-app");
    exit();
}

// Detecta o tipo de aparelho do usuário
$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

if (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
    header("Location: " . $apps[$chave]['ios']);
    exit();
} elseif (strpos($userAgent, 'android') !== false) {
    header("Location: " . $apps[$chave]['android']);
    exit();
} else {
    header("Location: https://oneer.com.br/baixar-app");
    exit();
}
