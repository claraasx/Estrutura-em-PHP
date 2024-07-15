
<?php

// Função para exibir o menu

function Menu() 
{
    echo PHP_EOL;
    echo "1. Cadastrar Alunos" . PHP_EOL;
    echo "2. Atribuir Notas". PHP_EOL;
    echo "3. Exibir Resultados" . PHP_EOL;
    echo "4. Editar Resultados" . PHP_EOL;
    echo "5. Sair" . PHP_EOL;
    echo PHP_EOL;
    echo "Escolha uma opção: " . PHP_EOL;
    echo PHP_EOL;
}

// Laço principal do sistema

while (true) 
{
    Menu();
    $opcao = trim(fgets(STDIN));

    switch ($opcao) 
    {
        case '1':
        $alunos = cadastro_de_alunos();
        break;
        
        case '2':

            if (empty($alunos)) 
            
            {
                echo "Cadastre os alunos primeiro!" . PHP_EOL;
            } 
            
            else 
            {
                $notas = incluir_notas($alunos);
            }
            break;
        
        case '3':
        
            if (empty($notas)) 
            {
                echo "Atribua notas aos alunos primeiro!" . PHP_EOL;
            }
                
            else {
                exibir_resultados($alunos, $notas);
            }
            break;
        
        case '4':
        
            if (empty($notas)) 
            {
                echo "Atribua notas aos alunos primeiro!\n";
            } 
            
            else {
                $notas = alterar_notas($alunos, $notas);
            }
        
            break;
        
        case '5':
            exit("Saindo...");
        
        default:
            echo "Opção inválida! Tente novamente." . PHP_EOL;
    }
}

// Variáveis para armazenar dados dos alunos

$alunos = [];
$notas = [];

// 01) Cadastro de alunos

    function cadastro_de_alunos() 
    {   echo PHP_EOL;

        $alunos = [];
        
        for ($i = 0; $i < 5; $i++) 
            
        {   echo PHP_EOL;
            echo "Informe o nome do aluno " . ($i + 1) . ": " . PHP_EOL;

            $alunos[$i] = trim(fgets(STDIN));
            echo PHP_EOL;
        }
        
        return $alunos;
        echo PHP_EOL;
    }

// 02) Função para inserir notas aos alunos

    function incluir_notas($alunos) 
    {
        for ($i = 0; $i < 4; $i++) {

        $notas = ("Digite a nota $i do aluno $alunos: ");
        
        while ($notas < 0 || $notas > 10) {
            echo "Nota inválida. Digite uma nota entre 0 e 10.\n";  
            $nota = (float) readline("Digite a nota do aluno $alunos[nome]: ");
    }
        }
        $alunos["notas"][] = $notas;
    
        return $notas;
        echo PHP_EOL;
    }

// 03) Função para calcular média e status do aluno

    function calcular_media_aritmética($notas) 
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

    function determinar_status($media) 
    {
        if ($media < 4) 
        {
            return 'Reprovado';
        } 
        
        elseif ($media >= 4 && $media <= 6) 
        {
            return 'Recuperação';
        }  

        else 
        {
            return 'Aprovado';
        }
    }

// 05) Função para exibir os resultados dos alunos e permitir que o professor altere elas

    function exibir_resultados($alunos, $notas) 
    {
        $resultados = calcular_media_aritmética($notas);
        foreach ($alunos as $i => $alunos) 
        
        {
            $media = $resultados[$i]['media'];
            $status = determinar_status($media);
            
            echo "Aluno: " . $alunos . PHP_EOL;
            echo "Notas: " . implode(", ", $notas[$i]) . PHP_EOL;
            echo "Total: " . $resultados[$i]['total'] . PHP_EOL;
            echo "Média: " . $media . PHP_EOL;
            echo "Status: " . $status . PHP_EOL;
            echo "----------------------";
        }
    }

    function alterar_notas($alunos, $notas) 
    {
        echo "Informe o número do aluno (1 a 5): " . PHP_EOL;
        $numAluno = trim(fgets(STDIN)) - 1;
        
        if (isset($alunos[$numAluno])) 
        
        {
            echo "Editando notas para " . $alunos[$numAluno] . PHP_EOL;
            for ($j = 0; $j < 4; $j++) {
                do {
                    echo "Nova Nota " . ($j + 1) . " (0 a 10): ". PHP_EOL;
                    $notas = trim(fgets(STDIN));
                    } 
                    
                while ($notas < 0 || $notas > 10);
                $notas[$numAluno][$j] = $notas; }
        } 
            
        else {
            echo "Aluno não encontrado!" . PHP_EOL;
        }
        
        return $notas;
    }

    echo PHP_EOL;
?>
