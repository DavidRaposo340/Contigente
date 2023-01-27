<?php
  session_start();
  include_once $path2root."includes/opendb.php";
  include_once $path2root."database/user_type.php"; 
?>

<nav>
  <div class="nav_backside">
  </div>
  <div class="nav_center">
    <a href="<?php echo $path2root; ?>index.php"> CONTIGENTE</a>
  </div>

  <div class="nav_block">

      <a href="<?php echo $path2root; ?>paginas_form\produto\listar_loja_produtos.php"> Loja</a>
      <a href="<?php echo $path2root; ?>paginas_form\receita\listar_sugestoes_receita.php"> Sugestões</a>    
      
    <div class="nav_right">

    <?php
        
        //Se houver sessao inciada apresenta botao conta, senao apresenta iniciar sessao
        if (!empty($_SESSION['user'])) {
          
          //carrinho so é aprensentado quando há sessao inciada para evitar erros
          echo '<a href="'.$path2root.'paginas_form\cliente\listar_carrinho.php"> Carrinho</a>';

          echo '<div class="dropdown">';
          echo '<a class="dropdown-toggle" href="#">Conta</a>';
          echo '<div class="dropdown-content">';

          echo '<a href="'.$path2root.'paginas_form\cliente\form_editar_conta.php">Dados Pessoais</a>';
          echo '<a href="'.$path2root.'paginas_form\cliente\form_listar_encomendas.php">Encomendas</a>';

          if (getUserTypebyID($_SESSION['user'])=="Técnico" || getUserTypebyID($_SESSION['user'])=="Gestor")
            echo '<a href="'.$path2root.'b_page">Produtos</a>';
          if (getUserTypebyID($_SESSION['user'])=="Gestor")
            echo '<a href="'.$path2root.'b_page">Estatistica</a>';

          echo '<a href="'.$path2root.'acoes\geral\action_logout.php">Logout</a>';


          echo '</div>';
          echo '</div>';

          /* //formato dropdown button
            <div class="dropdown">
              <a class="dropdown-toggle" href="#">Carrinho</a>
              <div class="dropdown-content">
                <a href="<?php echo $path2root; ?>a_page">Dados Pessoais</a>
                <a href="<?php echo $path2root; ?>b_page">Encomendas</a>
              </div>
            </div>
          */
        }
        else {
          echo '<a href="'.$path2root.'paginas_form\geral\form_login.php"> Iniciar sessão</a> ';
        }
      ?>

    </div>
  </div>
</nav>
  