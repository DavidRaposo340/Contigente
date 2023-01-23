<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/users.php";

print_r($_POST);

//if (!empty($_POST['Criar Conta'])) {
    //Se comfirmou, recupera os valores introduzidos pelo utilizador no formulário e passados pelo link

    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_pass = $_POST['conf_pass'];
    

    //Validação dos dados
    //Assume-se que todos os campos são obrigatórios (a query insert apenas é executada se todos os campos  preenchidos)
    if (empty($nome) || empty($idade) || empty($email) ||  empty($password)||  empty($conf_pass)){
        $dadosValidos = false;
        }
    else if ( $password != $conf_pass){
        $dadosValidos = false;
        }
    else if ( /*VERIFCAR SE JA EXISTE EMAIL*/ 0){
        $dadosValidos = false;
        }              
    else {
        $dadosValidos = true;
    }
    		//********* 2. Executar a query e redirecionar para a página de apresentação

		if (!$dadosValidos){
			//Se dados não válidos, é gerada e guardada uma mensagem de erro em variável de sessão
			$_SESSION['msgErro'] = "Erro no formulário (pelo menos um dos campos em falta)<p>";

			//Também são registados em variáveis de sessão os dados introduzidos pelo utilizador no formulário
			$_SESSION['nome'] = $nome;
			$_SESSION['idade'] = $idade;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			$_SESSION['conf_pass'] = $conf_pass;

			//Depois de criadas as variáveis de sessão, o script é redirecionado para o formulário que irá apresentar os dados que o utilizador tinha introduzido anteriormente
			//header("Location: ".$path2root."paginas_form/geral/form_criar_conta.php");
        }
		else {
            if ($_POST['gluten'] == '1') $no_gluten = true; 
            else $no_gluten = false;

            if ($_POST['lactose'] == '1') $no_lact = true;
            else $no_lact = false;
            
            if ($_POST['vegan'] == '1') $vegan = true;
            else $vegan = false;
            

            //Se dados válidos, a query é executada e depois o script é redirecionado para a página de entrada
            //$result = createConta($nome, $idade, $email, $password, $conf_pass, $no_gluten, $no_lact, $vegan);

			//header("Location: ".$path2root."index.php");
		}
	//}


?>