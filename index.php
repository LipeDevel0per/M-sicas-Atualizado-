<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/SoundLike-Logo.png" type="image/x-icon">
</head>
<body id="body">
    <?php
    require_once "./components/header.php";

    if(isset($_GET['home'])){
        include "./components/home.php";
    }

    if(isset($_GET['listar'])){
        include "./components/listar.php";
    }

    if(isset($_GET['cadastrar'])){
        include "./components/cadastrar.php";
    }

    if(isset($_GET['configuracoes'])){
        include "./components/configuracoes.php";
    }

    if(isset($_GET['acao']) && $_GET['acao'] == 'alterar') {
        require_once(__DIR__ . "/components/alterar.php");
    }

    if(!isset($_GET['home']) && !isset($_GET['listar']) && !isset($_GET['cadastrar']) && !isset($_GET['configuracoes'])){
        include "./components/erro.php";
    }
    ?>
    
</body>
</html>

