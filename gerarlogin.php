<?php
function registrarLog($usuario, $pagina) {
    $arquivoLog = 'acessos.log';
    
    // Define o fuso horário (exemplo: São Paulo)
    date_default_timezone_set('America_Sao_Paulo');
    $dataHora = date('Y-m-d H:i:s');

    // Cabeçalho da tabela de log
    $cabecalho = "USUARIO;DATA_HORA;PAGINA_ACESSADA" . PHP_EOL;

    // Se o arquivo ainda não existir, cria o arquivo e grava o cabeçalho primeiro
    if (!file_exists($arquivoLog)) {
        file_put_contents($arquivoLog, $cabecalho, LOCK_EX);
    }

    // Linha de registro formatada
    $linhaLog = "{$usuario};{$dataHora};{$pagina}" . PHP_EOL;

    // Adiciona a nova linha ao final do arquivo (FILE_APPEND)
    file_put_contents($arquivoLog, $linhaLog, FILE_APPEND | LOCK_EX);
}
?>