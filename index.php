<?php

// Função para exibir o menu

function exibirMenu() 
{
    echo . PHP_EOL;
    echo "1. Cadastrar Alunos\n";
    echo "2. Atribuir Notas\n";
    echo "3. Exibir Resultados\n";
    echo "4. Editar Resultados\n";
    echo "5. Sair\n";
    echo "Escolha uma opção: ";
}

// Função para cadastrar alunos
function cadastrarAlunos() {
    $alunos = [];
    for ($i = 0; $i < 5; $i++) {
        echo "Informe o nome do aluno " . ($i + 1) . ": ";
        $alunos[$i] = trim(fgets(STDIN));
    }
    return $alunos;
}

// Função para atribuir notas aos alunos
function atribuirNotas($alunos) {
    $notas = [];
    foreach ($alunos as $i => $aluno) {
        echo "Atribuindo notas para " . $aluno . "\n";
        for ($j = 0; $j < 4; $j++) {
            do {
                echo "Nota " . ($j + 1) . " (0 a 10): ";
                $nota = trim(fgets(STDIN));
            } while ($nota < 0 || $nota > 10);
            $notas[$i][$j] = $nota;
        }
    }
    return $notas;
}

// Função para calcular média e status do aluno
function calcularMediaStatus($notas) {
    $resultados = [];
    foreach ($notas as $i => $notaArray) {
        $total = array_sum($notaArray);
        $media = $total / count($notaArray);
        $resultados[$i] = [
            'total' => $total,
            'media' => $media
        ];
    }
    return $resultados;
}

// Função para determinar o status do aluno baseado na média
function determinarStatus($media) {
    if ($media < 4) {
        return 'Reprovado';
    } elseif ($media >= 4 && $media <= 6) {
        return 'Recuperação';
    } else {
        return 'Aprovado';
    }
}

// Função para exibir os resultados dos alunos
function exibirResultados($alunos, $notas) {
    $resultados = calcularMediaStatus($notas);
    foreach ($alunos as $i => $aluno) {
        $media = $resultados[$i]['media'];
        $status = determinarStatus($media);
        echo "Aluno: " . $aluno . "\n";
        echo "Notas: " . implode(", ", $notas[$i]) . "\n";
        echo "Total: " . $resultados[$i]['total'] . "\n";
        echo "Média: " . $media . "\n";
        echo "Status: " . $status . "\n";
        echo "----------------------\n";
    }
}

// Função para editar notas de um aluno
function editarNotas($alunos, $notas) {
    echo "Informe o número do aluno (1 a 5): ";
    $numAluno = trim(fgets(STDIN)) - 1;
    if (isset($alunos[$numAluno])) {
        echo "Editando notas para " . $alunos[$numAluno] . "\n";
        for ($j = 0; $j < 4; $j++) {
            do {
                echo "Nova Nota " . ($j + 1) . " (0 a 10): ";
                $nota = trim(fgets(STDIN));
            } while ($nota < 0 || $nota > 10);
            $notas[$numAluno][$j] = $nota;
        }
    } else {
        echo "Aluno não encontrado!\n";
    }
    return $notas;
}

// Variáveis para armazenar dados dos alunos
$alunos = [];
$notas = [];

// Laço principal do sistema
while (true) {
    exibirMenu();
    $opcao = trim(fgets(STDIN));

    switch ($opcao) {
        case '1':
            $alunos = cadastrarAlunos();
            break;
        
        case '2':
            if (empty($alunos)) {
                echo "Cadastre os alunos primeiro!\n";
            } else {
                $notas = atribuirNotas($alunos);
            }
            break;
        
        case '3':
            if (empty($notas)) {
                echo "Atribua notas aos alunos primeiro!\n";
            } else {
                exibirResultados($alunos, $notas);
            }
            break;
        
        case '4':
            if (empty($notas)) {
                echo "Atribua notas aos alunos primeiro!\n";
            } else {
                $notas = editarNotas($alunos, $notas);
            }
            break;
        
        case '5':
            exit("Saindo...\n");
        
        default:
            echo "Opção inválida! Tente novamente.\n";
    }
}
?>
