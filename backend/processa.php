<?php

	include_once("conexao1.php");
	
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);
	
	if(!empty($_FILES['arquivo']['tmp_name'])){
		$arquivo = new DomDocument();
		$arquivo-> load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);
		
		$linhas = $arquivo->getElementsByTagName("Row");
		//var_dump($linhas);
		
		$primeira_linha = true;
		
		foreach($linhas as $linha){
			if($primeira_linha == false){
				$id = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
				echo "ID: $id <br>";

				$RA = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
				echo "RA: $RA <br>";

				$nome = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
				echo "Nome: $nome <br>";
				
				$curso = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
				echo "Curso: $curso <br>";
				
				$habilidade1 = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
				echo "Habilidade1: $habilidade1 <br>";
				
				$habilidade2 = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
				echo "Habilidade2: $habilidade2 <br>";
				
				$habilidade3 = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
				echo "Habilidade3: $habilidade3 <br>";
				
				$habilidade4 = $linha->getElementsByTagName("Data")->item(7)->nodeValue;
				echo "Habilidade4: $habilidade4 <br>";
				
				$habilidade5 = $linha->getElementsByTagName("Data")->item(8)->nodeValue;
				echo "Habilidade5: $habilidade5 <br>";
				
				echo "<hr>";
				
				//Inserir o usuário no BD
				$result_usuario = "INSERT INTO alunos (id, RA, nome, curso, habilidade1, habilidade2, habilidade3, habilidade4, habilidade5) VALUES ('$id', '$RA', '$nome', '$curso', '$habilidade1', '$habilidade2', '$habilidade3', '$habilidade4', '$habilidade5')";
				$resultado_usuario = mysqli_query($conn, $result_usuario);
			}
			$primeira_linha = false;
		}
	}
?>