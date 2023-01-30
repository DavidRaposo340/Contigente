<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/products.php";

print_r($_POST);

if (!empty($_POST['checkbox_cancelar'])) {
    //Se cancelou, redireciona de imediato para a página de entrada
    header("Location: " . $path2root . "paginas_form/tecnico/form_criar_produto.php");
}
if (!empty($_POST['checkbox_confirmar'])) {
    $nome = $_POST['nome'];
    $familia = $_POST['familia'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if (empty($nome) || empty($familia) || empty($price) ||  empty($quantity)) {
        $dadosValidos = false;
        $_SESSION['msgErro'] = "Pelo menos um dos campos em falta!";
    } else {
        $dadosValidos = true;
    }

    if (!$dadosValidos) {
        header("Location: " . $path2root . "paginas_form/tecnico/form_criar_produto.php");
    }
    else {
        if (isset($_POST['gluten']) && $_POST['gluten'] == '1') $no_gluten = 'true';
        else $no_gluten = 'false';

        if (isset($_POST['lactose']) && $_POST['lactose'] == '1') $no_lact = 'true';
        else $no_lact = 'false';

        if (isset($_POST['vegan']) && $_POST['vegan'] == '1') $vegan = 'true';
        else $vegan = 'false';

        $fileName = "";
        if (isset($_FILES["file"]["error"]) && $_FILES["file"]["error"] > 0) {
            echo "Error: " . $_FILES["file"]["error"] . "<br>";
        } else {// definir um prefixo apropriado para identificação
            $fileName = $_FILES["file"]["name"];
            $fileName = str_replace(' ', '', $fileName);
            $fileName = 'produtos/' . $fileName;
            $destino = $path2root .'images/' . $fileName;
            move_uploaded_file($_FILES["file"]["tmp_name"], $destino);
        }
        //Se dados válidos, a query é executada e depois o script é redirecionado para a página de entrada
        createProduct($familia, $quantity, $price, $no_gluten, $no_lact, $vegan, $fileName, $nome);

        header("Location: " . $path2root . "paginas_form/tecnico/form_criar_produto.php");
    }
}
?>