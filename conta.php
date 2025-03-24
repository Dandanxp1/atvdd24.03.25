<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
require_once 'funcao.php';

$saldo_usuario = 10000;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor_saque = (int)$_POST['valor'];

    if ($valor_saque <= 0) {
        $erro = "O valor do saque deve ser positivo.";
    } elseif ($valor_saque > $saldo_usuario) {
        $erro = "Você não tem saldo suficiente.";
    } else {

        $resultado = realizar_saque($valor_saque);

        if ($resultado['sucesso']) {
            $saldo_usuario -= $valor_saque;
            $sucesso = "Saque realizado com sucesso!";
            $notas = $resultado['notas'];
        } else {
            $erro = $resultado['erro'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Bancária</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Conta do Usuário: <?php echo $_SESSION['usuario']; ?></h2>
    <p>Saldo disponível: R$ <?php echo number_format($saldo_usuario, 2, ',', '.'); ?></p>

    <h3>Efetuar Saque</h3>
    <form method="POST" action="conta.php">
        <label for="valor">Valor do saque:</label><br>
        <input type="number" id="valor" name="valor" required><br><br>
        <input type="submit" value="Sacar">
    </form>

    <?php
    if (isset($erro)) {
        echo "<p class='erro'>$erro</p>";
    }

    if (isset($sucesso)) {
        echo "<p class='sucesso'>$sucesso</p>";
        echo "<h4>Notas entregues:</h4>";

        echo "<div class='notas'>";
        foreach ($notas as $nota => $quantidade) {
            echo "<div class='nota'>";
            echo "<img src='imagens/$nota.png' alt='R$ $nota' class='nota-img'>";
            echo "<p>R$ $nota: $quantidade</p>";
            echo "</div>";
        }
        echo "</div>";
    }
    ?>

    <a href="logout.php" class="logout">Sair</a>
</div>
</body>
</html>
