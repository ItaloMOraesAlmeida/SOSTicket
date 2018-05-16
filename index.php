<!DOCTYPE html>

<?php
// Verificação do formulário de instalação!

$filename = 'view/form.install.php';
if (file_exists($filename)) {
    header('location: '.$filename);
    die;
} else {

?>

<!-- Formulário de Login -->

<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOSTicket</title>
    
</head>
<body>
    Login
</body>
</html>

<!-- Fim do formulário -->

<?php

}

?>