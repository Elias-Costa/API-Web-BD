<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

if(isset($_GET['path'])){
    $path = explode("/", $_GET['path']);

    if(isset($path[0]))
        $base = $path[0];
    else
        echo "Caminho não encontrado";

    if(isset($path[1]))
        $add = $path[1];
    else
        $add = '';
}
else
    echo "Acesse o caminho 'usuarios', exemplo: .../API-Elias/usuarios";

$method = $_SERVER['REQUEST_METHOD'];

require_once 'db.class.php';

if(isset($base) && $base == 'usuarios'){
    if($method == "GET"){
        $db = Database::conectar();

        $query = $db->query("SELECT * FROM usuarios");
        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
        
        if($resultados)
            echo json_encode($resultados);
        else
            echo "Não há usuários cadastrados no banco de dados!";
    }
}

if(isset($add) && $add == 'adicionar'){
    if($method === 'POST'){
        $dados = json_decode(file_get_contents('php://input'), true);
        
        if(isset($dados['cpf']) && isset($dados['nome']) && isset($dados['data_nascimento'])){
            $cpf = $dados['cpf'];
            $nome = $dados['nome'];
            $data_nascimento = $dados['data_nascimento'];

            $db = Database::conectar();

            $addUsuarioStmt = $db->prepare('INSERT INTO usuarios(cpf, nome, data_nascimento) VALUES (:cpf, :nome, :data_nascimento)');
            $addUsuarioStmt->bindParam(':cpf', $cpf);
            $addUsuarioStmt->bindParam(':nome', $nome);
            $addUsuarioStmt->bindParam(':data_nascimento', $data_nascimento);
            
            try{
                $addUsuarioStmt->execute();
                echo "SUCESSO: Usuário inserido com sucesso!";
            }catch(PDOException $e){
                echo "ERRO: Não foi possível inserir no banco de dados. " . $e->getMessage();
            }

        }else
            echo "ERRO: Preencha todos os dados.";
    }
}

?>