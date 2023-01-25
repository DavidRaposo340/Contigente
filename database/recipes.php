<?PHP

	function getAllReceitas($filtro_rec){ 
        //retorna vetor/lista com: id, nome, difi, tempo e total_price de todas receitas
		//input filtro_rec é o inicio do nome de uma receita. result deve apenas ter receitas com o nome a começar pelo filtro
        //se filtro_rec NULL, retorna todas as receitas
        global $conn;

		if ($filtro_rec != null && $filtro_rec != "") {
			$query = "	SELECT  recipes.id 			As   id, 
								recipes.name 		AS 	 nome,
								recipes.description	As   descr, 
								recipes.method		As   method, 
								recipes.no_person   As   n_doses, 
								recipes.difficulty 	AS 	 difi,
								recipes.total_price	AS 	 total_price,
								recipes.image_name  AS   img_path,
								recipes.type        AS	 type
						FROM recipes
						WHERE recipes.name LIKE 'filtro_rec%' 
						";
			$result = pg_exec($conn, $query);
			return $result;
		}
		else{
			$query = "	SELECT  recipes.id 			As   id, 
								recipes.name 		AS 	 nome,
								recipes.description	As   descr, 
								recipes.method		As   method, 
								recipes.no_person   As   n_doses, 
								recipes.difficulty 	AS 	 difi,
								recipes.total_price	AS 	 total_price,
								recipes.image_name  AS   img_path,
								recipes.type        AS   type
						FROM recipes
			";
			$result = pg_exec($conn, $query);
			return $result;
		}
	}

    function getReceitaByID($id){ //O QUE É O TYPE? NA DB ESTAO DIVIDIDOS: PEQUENA DESCRIÇAO E METODO (COM OS PASSOS). FALTA RETORNAR LIST_PRODUCTS
		//retorna img_path, nome, id, type, difi, tempo, n_doses, total_price, descr e list_prods da receita 
		//ideia das 3 da manha: list_prods é uma lista de ids. que depois tu vais usar tal e qual para adicionar os produtos no carrinh 
        //depois pela funçao getProductByID tiro os nome dos produtos.~

		//funciona na DB
        global $conn;
		$query = "	SELECT  recipes.image_name  AS   img_path
							recipes.id 			As   id, 
							recipes.name 		AS 	 nome,
							recipes.description	As   descr, 
							recipes.method		As   method, 
							recipes.no_person   As   n_doses, 
							recipes.difficulty 	AS 	 difi,
							recipes.total_price	AS 	 total_price,
							recipes.type		AS   type
					FROM recipes
					WHERE recipes.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		return $result;
	}

	function getProductsandQuantityofRecipe($id){ //funciona na DB
		global $conn;
		$query = "	SELECT  list_products.id_product 		As   id_products, 
							list_products.quantity_product	AS   quantity
					FROM list_products
					WHERE list_products.id_recipe='".$id."'
				";
		$result = pg_exec($conn, $query);
		return $result;
	}

	function updateTotalPriceofRecipe($id){ //chamo aqui as funçoes do get price e assim? ou david é que chama e da me todos os parametros? acho que vou ter que chamar
		
	}
?>

