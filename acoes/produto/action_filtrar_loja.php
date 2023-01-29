<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/products.php";

print_r($_POST);


$familia = $_POST['familia'];
$price_min = $_POST['price-min'];
$price_max = $_POST['price-max'];
    

//são registados em variáveis de sessão os dados introduzidos pelo utilizador no formulário
$_SESSION['familia'] = $familia;
$_SESSION['price_min'] = $price_min;
$_SESSION['price_max'] = $price_max;
$_SESSION['searchbar_filter']=0;


if (isset($_POST['gluten']) && $_POST['gluten'] == '1') {$_SESSION['no_gluten'] = 1; $_SESSION['checked_gluten']=checked;}
else {$_SESSION['no_gluten'] = 0; $gluten_check="";}

if (isset($_POST['lactose']) && $_POST['lactose'] == '1') {$_SESSION['no_lact'] = 1; $_SESSION['checked_lact']=checked;}
else {$_SESSION['no_lact'] = 0; $lact_check="";}

if (isset($_POST['vegan']) && $_POST['vegan'] == '1') {$_SESSION['vegan'] = 1; $_SESSION['checked_vegan']=checked;}
else {$_SESSION['vegan'] = 0; $vegan_check="";}


header("Location: ".$path2root."paginas_form/produto/listar_loja_produtos.php");
    
?>