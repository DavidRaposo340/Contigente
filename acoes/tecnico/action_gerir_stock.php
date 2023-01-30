<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/products.php";

    print_r($_POST);

if (!empty($_POST['checkbox_stock_cancelar'])) {
    //Se cancelou, redireciona de imediato para a página de entrada
    header("Location: " . $path2root . "paginas_form/tecnico/form_gerir_stock.php");
}
if (!empty($_POST['checkbox_stock_confirmar'])) {

    $id = $_POST ["id"];
    $quantity = $_POST ["quantity"];
    echo $id;
    echo $quantity;

    if (empty($id) || empty($quantity)) {
        $dadosValidos = false;
        $_SESSION['msgErro'] = "Erro ao Introduzir Stock";
    } else {
        $dadosValidos = true;
    }
    if (!$dadosValidos) {
        header("Location: " . $path2root . "paginas_form/tecnico/listar_produtos.php");
    }
    else {
        updateQuantityofProduct($id, $quantity);
        $_SESSION['msgAviso'] = "Foi Adicionado Stock";     

        header("Location: " . $path2root . "paginas_form/tecnico/listar_produtos.php");
    }
}

?>