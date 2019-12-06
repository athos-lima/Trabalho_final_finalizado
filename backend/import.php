<?php 
ini_set('max_execution_time','-1');
require_once "SimpleXLSX.php";
 
class ImportaPlanilha{
 
	// Atributo recebe a instância da conexão PDO
	private $conexao  = null;
 
     // Atributo recebe uma instância da classe SimpleXLSX
	private $planilha = null;
 
	// Atributo recebe a quantidade de linhas da planilha
	private $linhas   = null;
 
	// Atributo recebe a quantidade de colunas da planilha
	private $colunas  = null;
 
	/*
	 * Método Construtor da classe
	 * @param $path - Caminho e nome da planilha do Excel xlsx
	 * @param $conexao - Instância da conexão PDO
	 */
	public function __construct($path=null, $conexao=null){
 
		if(!empty($path) && file_exists($path)):
			$this->planilha = new SimpleXLSX($path);
			list($this->colunas, $this->linhas) = $this->planilha->dimension();
		else:
			echo 'Arquivo não encontrado!';
			exit();
		endif;
 
		if(!empty($conexao)):
			$this->conexao = $conexao;
		else:
			echo 'Conexão não informada!';
			exit();
		endif;
 
	}
	public function getQtdeLinhas(){
		return $this->linhas;
	}
	public function getQtdeColunas(){
		return $this->colunas;
	}

	public function insertDados(){
 
		try{
			$sql = 'INSERT INTO cadastro_alunos (id, nome, habilidade1, habilidade2, habilidade3, habilidade4, habilidade5)VALUES(?, ?, ?, ?, ?, ?, ?)';
			$stm = $this->conexao->prepare($sql);
			
			$linha = 0;

			foreach($this->planilha->rows() as $chave => $valor):
				if ($chave >= 1 ):		
					$id             = trim($valor[0]);
					$nome           = trim($valor[1]);
					$habilidade1    = trim($valor[2]);
					$habilidade2    = trim($valor[3]);
					$habilidade3    = trim($valor[4]);
					$habilidade4    = trim($valor[5]);
					$habilidade5    = trim($valor[6]);
 
					$stm->bindValue(1, $id);
					$stm->bindValue(2, $nome);
					$stm->bindValue(3, $habilidade1);
					$stm->bindValue(4, $habilidade2);
					$stm->bindValue(5, $habilidade3);
					$stm->bindValue(6, $habilidade4);
					$stm->bindValue(7, $habilidade5);
					
					$retorno = $stm->execute();
					
					if($retorno == true) $linha++;
				 endif;
			endforeach;
 
			return $linha;
		}catch(Exception $erro){
			echo 'Erro: ' . $erro->getMessage();
		}
 
	}
}
?>