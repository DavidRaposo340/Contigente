<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/products.php";

print_r($_POST);  

$_SESSION['familia'] = "todas";
$_SESSION['price_min'] = 0;
$_SESSION['price_max'] = 50;
$_SESSION['no_gluten'] = 0;
$_SESSION['no_lact'] = 0;
$_SESSION['vegan'] = 0;

$_SESSION['searchbar_filter']=$_POST['search'];
header("Location: ".$path2root."paginas_form/produto/listar_loja_produtos.php");
    
?>