<?php

// Função para exibir o menu

function Menu() 
{
    echo . PHP_EOL;
    echo "1. Cadastrar Alunos" . PHP_EOL;
    echo "2. Atribuir Notas". PHP_EOL;
    echo "3. Exibir Resultados" . PHP_EOL;
    echo "4. Editar Resultados" . PHP_EOL;
    echo "5. Sair" . PHP_EOL;
    echo "Escolha uma opção: " . PHP_EOL;
}

// 01) Função para cadastro de alunos

function cadastrodeAlunos() 
{
    $alunos = [];
    
    for ($i = 0; $i < 5; $i++) 
        
    {
        echo "Informe o nome do aluno " . ($i + 1) . ": " . PHP_EOL;
        
        $alunos[$i] = trim(fgets(STDIN));
    }
    
    return $alunos;
}

// 02) Função para atribuir notas aos alunos

function incluirNotas($alunos) 
{
    $notas = [];
    
    foreach ($alunos as $i => $aluno) 
    
    {
        echo "Atribuindo notas para " . $aluno . PHP_EOL;
        for ($j = 0; $j < 4; $j++) 
            
        {
            do {
                echo "Nota " . ($j + 1) . " (0 a 10): " . PHP_EOL;
                $nota = trim(fgets(STDIN));
                } 
                
                while ($nota < 0 || $nota > 10);
                $notas[$i][$j] = $nota;
        }
    }
    
    return $notas;
}

// 03) Função para calcular média e status do aluno

function calcularmediaAritmetica($notas) 
{
    $resultados = [];
    foreach ($notas as $i => $notaArray) 
        
    {
        $total = array_sum($notaArray);
        $media = $total / count($notaArray);
        $resultados[$i] = 
            [
            'total' => $total,
            'media' => $media
            ];
    }
    
    return $resultados;
}

// 04) Função para determinar o status do aluno baseado na média

function determinarStatus($media) 
{
    if ($media < 4) 
    {
        return 'Reprovado';
    } 
    
    elseif ($media >= 4 && $media <= 6) 
    {
        return 'Recuperação';
    } else 
    
    {
        return 'Aprovado';
    }
}

// Função para exibir os resultados dos alunos

function exibirResultados($alunos, $notas) 
{
    $resultados = calcularMediaStatus($notas);
    foreach ($alunos as $i => $aluno) 
    
    {
        $media = $resultados[$i]['media'];
        $status = determinarStatus($media);
        
        echo "Aluno: " . $aluno . PHP_EOL;
        echo "Notas: " . implode(", ", $notas[$i]) . PHP_EOL;
        echo "Total: " . $resultados[$i]['total'] . PHP_EOL;
        echo "Média: " . $media . PHP_EOL;
        echo "Status: " . $status . PHP_EOL;
        echo "----------------------";
    }
}

// Função para editar notas de um aluno

function editarNotas($alunos, $notas) 
{
    echo "Informe o número do aluno (1 a 5): " . PHP_EOL;
    $numAluno = trim(fgets(STDIN)) - 1;
    
    if (isset($alunos[$numAluno])) 
    
    {
        echo "Editando notas para " . $alunos[$numAluno] . PHP_EOL;
        for ($j = 0; $j < 4; $j++) {
            do {
                echo "Nova Nota " . ($j + 1) . " (0 a 10): ". PHP_EOL;
                $nota = trim(fgets(STDIN));
                } 
                
            while ($nota < 0 || $nota > 10);
            $notas[$numAluno][$j] = $nota; }
    } 
        
    else {
        echo "Aluno não encontrado!" . PHP_EOL;
    }
    
    return $notas;
}

// Variáveis para armazenar dados dos alunos

    $alunos = [];
    $notas = [];

// Laço principal do sistema

    while (true) 
    {
        exibirMenu();
        $opcao = trim(fgets(STDIN));
    
        switch ($opcao) 
    {
        case '1':
            $alunos = cadastrarAlunos();
            break;
        
        case '2':
        
            if (empty($alunos)) 
            {
                echo "Cadastre os alunos primeiro!";
            } 
            
            else 
            {
                $notas = atribuirNotas($alunos);
            }
        
            break;
        
        case '3':
        
            if (empty($notas)) 
            {
                echo "Atribua notas aos alunos primeiro!" . PHP_EOL;
            }
                
            else {
                exibirResultados($alunos, $notas);
            }
            break;
        
        case '4':
        
            if (empty($notas)) 
            {
                echo "Atribua notas aos alunos primeiro!\n";
            } 
            
            else {
                $notas = editarNotas($alunos, $notas);
            }
        
            break;
        
        case '5':
            exit("Saindo...");
        
        default:
            echo "Opção inválida! Tente novamente." . PHP_EOL;
    }
}
?>
