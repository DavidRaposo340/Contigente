<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/products.php";

print_r($_POST);

if (!empty($_POST['checkbox_cancelar'])) {
    //Se cancelou, redireciona de imediato para a página de entrada
    header("Location: " . $path2root . "paginas_form/tecnico/listar_produtos.php");
}
if (!empty($_POST['checkbox_confirmar'])) {
    $nome = $_POST['nome'];
    $familia = $_POST['familia'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $familiaid = getFamilyIDbyName($familia);
    $id = $_POST['id'];

    echo $nome ;
    echo $familia;
    echo $price;
    echo $quantity;
    echo $familiaid;
    echo $id;

    if (empty($nome) || empty($familia) || empty($price) ||  empty($quantity)) {
        $dadosValidos = false;
        $_SESSION['msgErro'] = "Pelo menos um dos campos em falta!";
    } else {
        $dadosValidos = true;
    }

    if (!$dadosValidos) {
        header("Location: " . $path2root . "paginas_form/tecnico/form_editar_produto.php?id=".$id."");
    }
    else {
        if (isset($_POST['gluten']) && $_POST['gluten'] == '1') $no_gluten = 'true';
        else $no_gluten = 'false';

        if (isset($_POST['lactose']) && $_POST['lactose'] == '1') $no_lact = 'true';
        else $no_lact = 'false';

        if (isset($_POST['vegan']) && $_POST['vegan'] == '1') $vegan = 'true';
        else $vegan = 'false';

        //Se dados válidos, a query é executada e depois o script é redirecionado para a página de entrada
        editProduct($id, $familiaid, $quantity, $price, $no_gluten, $no_lact, $vegan, $nome);

        $_SESSION['msgAviso'] = "Produto alterado com sucesso!";  
        header("Location: " . $path2root . "paginas_form/tecnico/form_editar_produto.php?id=".$id."");

    }
}
?>