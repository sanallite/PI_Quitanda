<?php
    include "conexao.php";

    // Pegando a ação pela url e o valor que será usado nessa ação, apenas se tiver uma ação definida.
    if ( isset( $_GET['acao'] ) ) {
        $acao = $_GET['acao'];

        if ( $acao == "delete" ) {
            $id = $_GET['id'];
            $deletarProdutos = mysqli_query($conexao, "DELETE FROM produtos WHERE id_produto = $id");
            
            if ( $deletarProdutos ) { echo "<br>A linha foi apagada.";
                header ('location:index.php');
            }
        }

        else if ( $acao == "atualizar" ) {
            $id = $_GET['id'];

            $nomevar = $_POST['edit_nome'];
            $quantidadevar = $_POST['edit_quantidade'];
            $estadovar = $_POST['edit_estado'];
            $categoriavar = $_POST['edit_categoria'];
            $datavar = $_POST['edit_data'];
            $precovar = $_POST['edit_preco'];
            /* $corvar = $_POST['cor']; */
            /* Substituir por foto. */

            $atualizar = mysqli_query($conexao,
            "UPDATE produtos 
            SET nome_produto = '$nomevar', 
            quantidade = '$quantidadevar',
             estado = '$estadovar',
              id_categoria = '$categoriavar',
               data_adicao = '$datavar',
                preco = '$precovar'
                 WHERE id_produto = '$id'");

            if ( $atualizar ) {
                echo "<br>A linha foi alterada.";
                /* header ('location:index.php'); */
            }
        }
    }

    // Vamos receber as informações do formulário por post e criaremos as variáveis para receber a informação.
    else {  
        $nomevar = $_POST['nome'];
        $quantidadevar = $_POST['quantidade'];
        $estadovar = $_POST['estado'];
        $categoriavar = $_POST['categoria'];
        $datavar = $_POST['data'];
        $precovar = $_POST['preco'];
        /* $corvar = $_POST['cor']; */
        /* Substituir por foto. */

        // Query para salvar as informações no banco de dados
        $produtos = mysqli_query($conexao,
            "INSERT INTO produtos (nome_produto, quantidade, estado, id_categoria, data_adicao, preco)
            VALUES ('$nomevar', '$quantidadevar', '$estadovar', '$categoriavar', '$datavar', '$precovar')"
        );
        /* Não se esqueça das aspas por favor... */

        // Se salvar aparecerá uma mensagem
        if ($produtos) {
            echo "<br>A fruta foi salva";
            header ('location:index.php');
        }
    }
?>
