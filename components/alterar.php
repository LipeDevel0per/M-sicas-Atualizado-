<?php 
require_once(__DIR__ . "/funcao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados da música
    $dados_musica = [
        ':id' => $_POST['id'],
        ':nome' => $_POST['nome'],
        ':artista' => $_POST['artista'],
        ':ano_lancamento' => $_POST['ano_lancamento'],
        ':album' => $_POST['album'],
        ':genero' => $_POST['genero']
    ];

    // Se tiver nova imagem, sobrescreve
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = 'img/musica-' . preg_replace('/[^a-zA-Z0-9]/', '_', $_POST['nome']) . '.' . $ext;
        move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../' . $nomeImagem);
    }

    if (alterar_musica($dados_musica)) {
        header("Location: /?listar");
        exit;
    }       
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    header("Location: /?listar");
    exit;
}
$musica = lista_musica_id($id);
if (!$musica) {
    header("Location: /?listar");
    exit;
}

// Caminho da imagem atual
$imagemAtual = 'img/musica-' . preg_replace('/[^a-zA-Z0-9]/', '_', $musica['nome']) . '.jpg';
$caminhoImagem = file_exists(__DIR__ . '/../' . $imagemAtual) ? "/$imagemAtual" : "https://via.placeholder.com/100x100?text=Sem+Imagem";
?>

<h2 class="h4-alterar">Alterar Músicas</h2>
<main class="main-alterar">
    <form method="post" class="container-alterar" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $musica['id']; ?>">

        <div class="col-md-4">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $musica['nome']; ?>">
        </div>

        <div class="col-md-4">
            <label for="artista" class="form-label">Artista</label>
            <input type="text" class="form-control" id="artista" name="artista" value="<?php echo $musica['artista']; ?>">
        </div>

        <div class="col-md-4">
            <label for="ano_lancamento" class="form-label">Ano de Lançamento</label>
            <input type="date" class="form-control" id="ano_lancamento" name="ano_lancamento" value="<?php echo $musica['ano_lancamento']; ?>">
        </div>

        <div class="col-md-4">
            <label for="album" class="form-label">Álbum</label>
            <input type="text" class="form-control" id="album" name="album" value="<?php echo $musica['album']; ?>">
        </div>

        <div class="col-md-4">
            <label for="genero" class="form-label">Gênero</label>
            <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $musica['genero']; ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Imagem Atual:</label><br>
            <img src="<?php echo $caminhoImagem; ?>" alt="Imagem atual" width="100" height="100"><br><br>

            <label for="imagem" class="form-label">Alterar Imagem</label>
            <input type="file" name="imagem" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Alterar</button>
    </form>
</main>

<style>
.h4-alterar {
    text-align: center;
    color: white;
}
.main-alterar {
    display: flex;
    justify-content: center;
    align-items: center;
}
.container-alterar {
    color: white;
    background: #2b2b2b;
    border: none;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 15px black;
    margin: 5px 0;
    text-align: center;
}
input[type="date"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
    filter: invert(0);
}
.container-alterar button {
    background: black;
    color: white;
    border: none;
    border-radius: 50rem;
    padding: 15px;
    box-shadow: 0 0 7px black;
    margin-top: 20px;
    width: 100%;
    transition: .4s;
}
input {
    background: gray;
    border: solid 2px gray;
    border-radius: 50rem;
    width: 100%;
}
</style>