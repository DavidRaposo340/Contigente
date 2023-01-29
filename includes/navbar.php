<script src="https://kit.fontawesome.com/9b0808819b.js" crossorigin="anonymous"></script>
<?php
  session_start();
  include_once $path2root."includes/opendb.php";
  include_once $path2root."database/user_type.php"; 
  include_once $path2root."database/users.php"; 
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
          $user_logged=getNamebyUserID($_SESSION['user']);
          
          //carrinho so é aprensentado quando há sessao inciada para evitar erros
          echo '<a href="'.$path2root.'paginas_form\cliente\listar_carrinho.php"> <i class="fa-solid fa-cart-shopping"></i></a>';

          echo '<div class="dropdown">';
          echo '<a class="dropdown-toggle" href="#"> Conta - '.$user_logged.'</a>';
          echo '<div class="dropdown-content">';

          echo '<a href="'.$path2root.'paginas_form\cliente\form_editar_conta.php">  <i class="fa-solid fa-user"></i> Dados Pessoais</a>';        

          if (getUserTypebyID($_SESSION['user'])=="Cliente")
            echo '<a href="'.$path2root.'paginas_form\cliente\listar_encomendas.php"> <i class="fa-solid fa-truck-fast"></i> Encomendas</a>';
          
          if (getUserTypebyID($_SESSION['user'])=="Técnico" || getUserTypebyID($_SESSION['user'])=="Gestor"){
            echo '<a href="'.$path2root.'paginas_form\tecnico\listar_encomendas_tecnico.php"> <i class="fa-solid fa-truck-fast"></i> Encomendas</a>';
            echo '<a href="'.$path2root.'paginas_form\tecnico\listar_produtos.php"> <i class="fa-brands fa-product-hunt"></i> Produtos</a>';
          }

          if (getUserTypebyID($_SESSION['user'])=="Gestor")
            echo '<a href="'.$path2root.'paginas_form\admin\listar_estatisticas.php"> <i class="fa-solid fa-chart-column"></i> Estatísticas </a>';


          echo '<a href="'.$path2root.'acoes\geral\action_logout.php"> <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>';


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
  