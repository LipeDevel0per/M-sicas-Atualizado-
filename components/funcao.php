<?php
    define('DB_HOST',     '192.168.0.106'); 
    define('DB_USER',     'root');      
    define('DB_PASS',     'root');        
    define('DB_NAME',     'musicas');       
    define('DB_CHARSET',  'utf8mb4');  

function conectar(): PDO {
    $pdo = new PDO(
          "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
          DB_USER,  
          DB_PASS
        );
    return $pdo;
}
function alerta($tipo, $titulo, $mensagem): void {
    $titulo_alert = "<i class='bi bi-check-circle'></i> {$titulo}";
    $class = 'alert alert-success';
    if ($tipo != 'ok') {
        $titulo_alert = "<i class='bi bi-exclamation-triangle'></i> {$titulo}";
        $class = 'alert alert-danger';        
    }
    echo "
        <div class='{$class} alert-dismissible fade show' role='alert'>
            <strong>{$titulo_alert}</strong>
            {$mensagem}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    ";
}


function cadastrar_musica($dados): void {
    $cx = conectar();
    $sql = "INSERT INTO musica (nome, artista, ano_lancamento, album, genero) 
                VALUES (:nome, :artista, :ano_lancamento, :album, :genero)";
        
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute($dados);
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Cadastrado com sucesso')</script>";
        }
        else {
            echo "<script>alert('Música não cadastrada')</script>";
        }
    }
    catch(PDOException $e) {
        echo "<script>alert('Música não cadastrada')</script>";
    }
}

function alterar_musica($dados): bool {
    $cx = conectar();
    $sql = "UPDATE musica SET nome = :nome, artista = :artista, ano_lancamento = :ano_lancamento, album = :album, genero = :genero WHERE id = :id";
    
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute($dados);
        if ($stmt->rowCount() > 0) {
            alerta('ok', 'Cadastro alterado com sucesso!', 'Musica alterada com sucesso.');
            return true;
        }
        else {
            alerta('erro', 'Erro ao alterar!', 'Não foi possível alterar a musica.');
            return false;
        }
    }
    catch(PDOException $e) {
        alerta('erro', 'Erro ao alterar!', $e->getMessage());
        return false;
    }
}

function lista_musica($search=""): array {
    $cx = conectar();
    $sql = "SELECT * FROM musica WHERE musica.nome LIKE :search OR musica.artista LIKE :search OR musica.album LIKE :search";
    $search = "%{$search}%";   
    $stmt = $cx->prepare($sql);
    $stmt->execute([":search" => $search]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function lista_musica_id($id): array {
    $cx = conectar();
    $sql = "SELECT * FROM musica WHERE id = :id";
    $stmt = $cx->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function delete_musica($id): void {
    $cx = conectar();
    $sql = "DELETE FROM musica WHERE id = :id";
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute([":id" => $id]);
        if ($stmt->rowCount() > 0) {
            alerta('ok', 'Cadastro excluído com sucesso!', 'Musica excluída com sucesso.');
        }
        else {
            alerta('erro', 'Erro ao excluir!', 'Não foi possível excluir a musica.');
        }
    }
    catch(PDOException $e) {
        alerta('erro', 'Erro ao excluir!', $e->getMessage());
    }
}