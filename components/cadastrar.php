<title>SoundLike - Cadastrar</title>

<?php
require_once(__DIR__ . "/funcao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Salvar imagem da música, se enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = 'img/musica-' . preg_replace('/[^a-zA-Z0-9]/', '_', $_POST['nome']) . '.' . $ext;
        move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../' . $nomeImagem);
    }

    // Salvar dados da música
    $dados_musica = [
        ':nome' => $_POST['nome'],
        ':artista' => $_POST['artista'],
        ':ano_lancamento' => $_POST['ano_lancamento'],
        ':album' => $_POST['album'],
        ':genero' => $_POST['genero']
    ];

    cadastrar_musica($dados_musica);

    // Redirecionar após o cadastro
    header("Location: index.php?pagina=listar");
    exit;
}
?>

<link rel="stylesheet" href="/css/style.css">

<div class="container-cadastro">
    <h2 class="titulo-cadastro">Cadastro de Músicas</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="dados-cadastro">
            <input type="text" class="" id="nome" name="nome" placeholder="Nome" required>
            <input type="text" class="" id="artista" name="artista" placeholder="Artista" required>
            <input type="date" class="" id="ano_lancamento" name="ano_lancamento" placeholder="Ano de Lançamento" required>
            <input type="text" class="" id="album" name="album" placeholder="Álbum" required>
            <input type="text" class="" id="genero" name="genero" placeholder="Gênero" required>
            <input type="file" name="imagem" accept="image/*">
            <button type="submit" class="btn-cadastrar">Cadastrar</button>
        </div>
    </form>
</div>