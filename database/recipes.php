<?PHP

	function getAllReceitas($filtro_rec){
        //retorna vetor/lista com: id, nome, difi, tempo e total_price de todas receitas
		//input filtro_rec é o inicio do nome de uma receita. result deve apenas ter receitas com o nome a começar pelo filtro
        //se filtro_rec NULL, retorna todas as receitas
        global $conn;
        echo $filtro_rec;
		$result = "ola";
		return $result;
	}

    function getReceitaByID($id){
		//retorna img_path, nome, id, type, difi, tempo, n_doses, total_price, descr e list_prods da receita 
		//ideia das 3 da manha: list_prods é uma lista de ids. que depois tu vais usar tal e qual para adicionar os produtos no carrinh 
        //depois pela funçao getProductByID tiro os nome dos produtos.
		
        global $conn;

		$result = "ola";
		return $result;
	}
?>

