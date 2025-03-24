<?php
function realizar_saque($valor_saque) {
    $notas_disponiveis = [100, 50, 20, 10, 5, 2];

    $notas = [];
    $valor_restante = $valor_saque;

    foreach ($notas_disponiveis as $nota) {
        $quantidade_notas = floor($valor_restante / $nota);

        if ($quantidade_notas > 0) {
            $notas[$nota] = $quantidade_notas;
            $valor_restante -= $quantidade_notas * $nota;
        }
    }

    if ($valor_restante > 0) {
        return ['sucesso' => false, 'erro' => 'Não é possível emitir o valor exato com as notas disponíveis.'];
    }

    return ['sucesso' => true, 'notas' => $notas];
}
?>