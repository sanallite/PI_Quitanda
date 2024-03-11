<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitandão Senac</title>
    <link rel="stylesheet" href="estilo.css">
    
    <script>
        function aparecerSumir(escolhido) {
            let formA = document.getElementById(escolhido);
            formA.style.display = "block";

            let formularios = ["atualizacao", "cadastro"];

            formularios.forEach ( formId => {
                if ( formId != escolhido ) {
                    let formC = document.getElementById(formId);
                    formC.style.display = "none";
                }
            }
            );
        }
        // Essa função tem um parâmetro que receberá um valor na hora que a função for chamada, nesse caso o parâmetro "escolhido" receberá uma string com o id do formulário que eu quero fazer aparecer.

        // Depois foi criado um array com o id de todos os formulários na página, e esse array será percorrido pelo loop forEach, que iterará a variável "formId" cada item do array, nesse caso os ids dos formulários, e se o valor desse item for diferente do valor que foi carregado na variável "escolhido" o sistema criará uma variável que pegará no documento o elemento com o id que está carregado na variável "formId" e fará esse elemento desaparecer.

        // Assim cada vez que um formulário for escolhido, através das chamadas da função, ele exibirá o escolhido e ocultará o resto.

        function aparecerMain(escolhido) {
            let main1 = document.getElementById(escolhido);
            main1.style.display = "grid";

            let mainDivs = ["catalogo", "categorias"];

            mainDivs.forEach ( mainId => {
                if ( mainId != escolhido ) {
                    let main2 = document.getElementById(mainId);
                    main2.style.display = "none";
                }
            }
            );
        }
    </script>
</head>
<body>
    <header>
        <a href="index.php"><img src="Layout/logoquitanda-01 1.png" alt="Logotipo Quitandão"></a>
    </header>

    <nav>
        <div class="categoria catalogo">
            <a class="categoria" href="#" onclick="aparecerMain('categorias'), aparecerSumir('cadastroCat')">Categorias</a>
            <a class="catalogo" href="#" onclick="aparecerMain('catalogo'), aparecerSumir('cadastro')">Catálogo</a>
        </div>

        <div class="cadastro">
            <a class="cadastro" href="#cadastro" onclick="aparecerSumir('cadastro')">Cadastro</a>
        </div>
        <!-- Chamando duas funções para fazer certos elementos sairem da tela, para que nesse caso não fique algo como o formulário de edição de um produto durante a exibição das categorias. -->
    </nav>

    <main id="catalogo">
        <?php
            include "conexao.php";

            $frutas = mysqli_query($conexao, "SELECT * FROM frutas");
            $quantBloco = 0;
            $numBloco = 0;

            // Estrutura de repetição que traz todas as frutas cadastradas.
            while ( $fruta = mysqli_fetch_assoc($frutas) ) { 
                $quantBloco++;
                $numBloco++; if ( $quantBloco>9 ) {
                    break;
                }

                if ( $fruta['estado'] == "Ótimo" ) {
                    $estadoF = 1;
                }

                else if ( $fruta['estado'] == "Bom" ) {
                    $estadoF = 2;
                }

                else if ( $fruta['estado'] == "Ruim" ) {
                    $estadoF = 3;
                }
        ?>
            <div class="f<?= $numBloco ?> topo">
                <div class="estado<?= $estadoF ?>"></div>
                <a class="edit" href="index.php?id=<?= $fruta['id'] ?>#atualizacao" onclick="aparecerSumir('atualizacao')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>

                <a class="delete" href="salvar.php?acao=delete&id=<?= $fruta['id']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </a>

                <p class="fruta">
                    <?= $fruta['nome']; ?>
                </p>

                <p class="quant">Quantidade
                    <br><?= $fruta['quantidade']; ?>
                </p>

                <p class="data">Data de aquisição
                    <br><?= $fruta['data']; ?>
                </p>
            </div>
            
        <?php } ?>
    </main>

    <main id="categorias">
        <?php
            $categorias = mysqli_query($conexao, "SELECT * FROM categorias");
            $quantBlocoC = 0;
            $numBlocoC = 0;

            while ($categoria = mysqli_fetch_assoc($categorias)) {
                $quantBlocoC++;
                $numBlocoC++; if ( $quantBlocoC>9 ) {
                    break;
                }
        ?>
        <div class="cat<?= $numBlocoC ?> topo">
            <p class="nome">
                <?= $categoria['nome'] ?>
            </p>
        </div>
        <?php } ?>
    </main>

    <form action="salvar.php" id="cadastro" method="post">
            <h2>Cadastre um produto</h2>

            <p>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome">
            </p>

            <p>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade">
            </p>

            <p>
                <label for="estado">Estado:</label>
                <select name="estado" id="estado">
                    <option value="">Selecione</option>
                    <option value="Ótimo">Ótimo</option>
                    <option value="Bom">Bom</option>
                    <option value="Ruim">Ruim</option>
                </select>
            </p>

            <p>
                <label for="data">Data de aquisição:</label>
                <input type="date" name="data" id="data">
            </p>

            <p>
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria">
                    <option value="">Selecione</option>
                    <?php
                        $categorias = mysqli_query($conexao, "SELECT * FROM categorias");

                        while ($cat = mysqli_fetch_assoc($categorias)) {
                            echo "<option value=" . $cat["id"] . ">" . $cat["nome"] . "</option>";
                        }
                    ?>
                </select>
            </p>

            <p>
                <label for="for">Cor:</label>
                <input type="text" name="cor" id="cor">
            </p>

            <p>
                <label>Preço:</label>
                <input type="number" name="preco" step="0.01">
                <!-- Input number só permite números inteiros, por isso se usa o step, que irá controlar quais números são válidos -->
            </p>

            <p>
                <button type="submit">Salvar</button>
            </p>
        </form>

        <?php
            if ( isset($_GET['id']) ) {
                $id = $_GET['id'];
                $selecionada = mysqli_query($conexao, "SELECT * FROM frutas WHERE id = $id");
                $dadosSelecionados = mysqli_fetch_assoc($selecionada);
            }
        ?>

        <form action="salvar.php?acao=atualizar&id=<?= $dadosSelecionados['id']; ?>" id="atualizacao" method="post">
            <h2>Edite um produto</h2>

            <p>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?= $dadosSelecionados['nome']; ?>">
            </p>

            <p>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" value="<?= $dadosSelecionados['quantidade']; ?>">
            </p>

            <p>
                <label for="estado">Estado:</label>
                <select name="estado" id="estado">
                    <option value="<?= $dadosSelecionados['estado']; ?>">Não alterar</option>
                    <option value="Ótimo">Ótimo</option>
                    <option value="Bom">Bom</option>
                    <option value="Ruim">Ruim</option>
                </select>
            </p>

            <p>
                <label for="data">Data de aquisição:</label>
                <input type="date" name="data" id="data" value="<?= $dadosSelecionados['data']; ?>">
            </p>

            <p>
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria">
                    <option value="<?= $dadosSelecionados['categoria_id']; ?>">Não alterar</option>
                    
                    <?php
                        $categorias = mysqli_query($conexao, "SELECT * FROM categorias");
                        
                        while ($categoria = mysqli_fetch_assoc($categorias)) {
                            echo "<option value=" . $categoria["id"] . ">" . $categoria["nome"] . "</option>";
                        }
                    ?>
                </select>
            </p>

            <p>
                <label for="for">Cor:</label>
                <input type="text" name="cor" id="cor" value="<?= $dadosSelecionados['cor']; ?>">
            </p>

            <p>
                <label>Preço:</label>
                <input type="number" name="preco" step="0.01" value="<?= $dadosSelecionados['preco']; ?>">
                <!-- Input number só permite números inteiros, por isso se usa o step, que irá controlar quais números são válidos -->
            </p>

            <p>
                <button type="submit">Alterar</button>
            </p>
        </form>
</body>
</html>
