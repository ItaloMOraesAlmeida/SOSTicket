<!DOCTYPE html>

<?php
// Verificação do formulário de instalação!

$filename = 'view/form.install.php';
if (file_exists($filename)) {
    header('location: '.$filename);
    die;
} else {

?>

<!-- Formulário de Login SOSTicket -->

<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOSTicket</title>

    <!-- RESOUCERS -->
    <link href="resources/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="resoucers/js/bootstrap.min.js"></script>
    <script src="resoucers/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="resources/css/login.css">
</head>
<body>
    <section style="height: 100vh;">
        <div style="background-attachment: fixed; background-size: cover; width: 100%; height: 100%; position: fixed;"  >
            <div class="main">
                <form action="login" method="post">
                    <h1><span>SOSTicket</span></h1>
                    <div class="login-wrap">
                        <div class="login-html">
                            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
                            <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">Recuperar Senha</label>
                            <div class="login-form">
                                <div class="sign-in-htm">
                                    <div class="group">
                                        <label for="user" class="label">Usuário</label>
                                        <input id="user" type="text" class="input">
                                    </div>
                                    <div class="group">
                                        <label for="pass" class="label">Senha</label>
                                        <input id="pass" type="password" class="input" data-type="password">
                                    </div>
                                    <div class="group">
                                        <input id="check" type="checkbox" class="check" checked>
                                        <label for="check"><span class="icon"></span> Lembrar Senha</label>
                                    </div>
                                    <div class="group">
                                        <input type="submit" class="button" value="Entrar">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot-lnk">
                                        <label for="tab-2">Recuperar Senha?</label>
                                    </div>
                                </div>
                                <div class="for-pwd-htm">
                                    <div class="group">
                                        <label for="user" class="label">Usuário</label>
                                        <input id="user" type="text" class="input">
                                    </div>
                                    <div class="group">
                                        <input type="submit" class="button" value="Recuperar Senha">
                                    </div>
                                    <div class="hr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>

<!-- Fim do formulário -->

<?php

}

?>