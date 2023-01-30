<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
  <title>Gerir Stock</title>
  <link rel="stylesheet" href="../../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
  <div class="navbar-separation">
  <?php
    $path2root = "../../";
    include("../../includes/navbar.php");
    include_once "../../includes/opendb.php";
    include_once "../../database/products.php";  

    if (empty($_SESSION['user'])) {
      $_SESSION['msgErro'] = "Inicie Sessão na su conta (Técnico) para adicionar stock produtos ";     
      header("Location: ".$path2root."paginas_form/geral/form_login.php");
  }

    $id = $_GET['id'];
    $prod_nome=getNameofProductbyID($id);
    $quantity=getQuantityofProductbyID($id);
  ?>

  </div>

  <div class="container-gerir_stock">
    <div class="form-gerir_stock">
      <h2>Gestão de stock do produto:</h2> <br> <br> <h3><?php echo $prod_nome; ?></h3>
        <h4>Indique a quantidade do produto com id: <?php echo $id; ?> <br> que foi adicionada ao armazém<br>(de acordo com os dados do fornecedor).</h4>
        
        <form method="post" action="<?php echo $path2root; ?>acoes/tecnico/action_gerir_stock.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p><label for="quantity"> Quantidade:</label> <input type="number" name="quantity" value="<?php echo $quantity; ?>" /> </p>

        <p><input name="checkbox_stock_confirmar" type="submit" value="Confirmar" /> </p>
        <input name="checkbox_stock_cancelar" type="submit" value="Cancelar"/> 
  </div>


</body>

</html>