<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: conta.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if (preg_match("/^\d{11}$/", $usuario)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: conta.php");
        exit;
    } else {
        $erro = "CPF inválido. O CPF deve ter 11 dígitos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Simulador de Caixa Eletrônico</title>
</head>
<body>

<div class="logo">
    <div class="skill-item">
        <img src="./Imagens/logo.png">
    </div>
</div>

<h2>Login Mercado Pago</h2>
<form method="POST" action="index.php">
    <div class="login">
    <label for="usuario">CPF:</label><br>
    

    
    <input type="text" id="usuario" name="usuario" required placeholder="Digite seu CPF" maxlength="11" pattern="\d{11}"><br><br>

    <label for="senha">Senha:</label><br>
    <input type="password" id="senha" name="senha" required placeholder="Digite qualquer senha"><br><br>

    <input type="submit" value="Login">
    </div>
</form>

<?php
if (isset($erro)) {
    echo "<p style='color: red;'>$erro</p>";
}
?>
</body>
</html>