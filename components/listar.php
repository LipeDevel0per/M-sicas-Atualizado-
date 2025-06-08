<title>SoundLike - Listar</title>
<?php    
    require_once(__DIR__ . "/funcao.php");

    // Verifica se a ação é excluir
    if (isset($_GET["acao"]) && $_GET["acao"] == "excluir") {
        $id = $_GET["id"];
        delete_musica($id);
    }

    // Verifica se um dados da pessoa foi enviado via POST para consultar
    $search = isset($_POST["nome"]) ? $_POST["nome"] : '';
    $lista_musica = lista_musica($search);   
?>

<h4 class="h4-listar">Músicas Cadastradas</h4>

<form method="POST" class="form-listar">
    <div class="input-group">
        <div class="div-input">
            <input type="text" name="nome" class="form-control" placeholder="Filtrar por nome" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
            <img src="https://images.vexels.com/media/users/3/143356/isolated/preview/64e14fe0195557e3f18ea3becba3169b-lupa-de-pesquisa.png" alt="" class="lupa-pesquisa">
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Filtrar</button>
    </div>
</form>

<div class="container-listar">
    <table class="tabela-listar">
        <thead class="table-dark">
            <tr class="container-titulos">
                <th class="titulos-listar">Imagem</th>
                <th class="titulos-listar">Nome</th>
                <th class="titulos-listar">Artista</th>
                <th class="titulos-listar">Ano Lançamento</th>
                <th class="titulos-listar">Album</th>
                <th class="titulos-listar">Genero</th>
                <th class="titulos-listar">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($lista_musica) {
                    foreach($lista_musica as $musica) {
                        $id = $musica["id"];
                        $nome  = $musica["nome"]; 
                        $artista  = $musica["artista"]; 
                        $ano_lancamento  = $musica["ano_lancamento"]; 
                        $album  = $musica["album"]; 
                        $genero  = $musica["genero"]; 

                        // Caminho da imagem
                        $nomeImagem = 'img/musica-' . preg_replace('/[^a-zA-Z0-9]/', '_', $nome) . '.jpg';
                        $caminhoImagem = file_exists(__DIR__ . '/../' . $nomeImagem) ? "/$nomeImagem" : "https://via.placeholder.com/80x80?text=Sem+Imagem";

                        echo "
                        <tr>
                            <td class='dados-listar'><img src='{$caminhoImagem}' alt='Imagem' width='80' height='80'></td>
                            <td class='dados-listar'>{$nome}</td>
                            <td class='dados-listar'>{$artista}</td>
                            <td class='dados-listar'>{$ano_lancamento}</td>
                            <td class='dados-listar'>{$album}</td>
                            <td class='dados-listar'>{$genero}</td>
                            <td>
                                <a class='btn-alterar' title='Alterar' href='?listar&acao=alterar&id={$id}'>
                                    <img src='https://cdn-icons-png.flaticon.com/512/700/700291.png' alt=''>
                                </a>
                                <button class='btn-excluir' title='Excluir' onclick='delete_musica({$id})'>
                                    <img src='https://cdn-icons-png.flaticon.com/512/4812/4812459.png' alt=''>
                                </button>
                            </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "
                        <tr>
                            <td colspan='7' class='text-center'>Nenhum registro encontrado</td>
                        </tr>
                    ";
                }
            ?>                
        </tbody>
    </table>
</div>

<script>
    const delete_musica = (id) => {
        if (confirm("Deseja realmente excluir?")) {
            window.location.href = "?listar&acao=excluir&id=" + id;
        }
    }
</script>