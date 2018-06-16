<?php 

class Sql extends PDO { // ESTENDE DA CLASSE PDO DO PHP

	private $conn;

	public function SQL(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root","");
	}


	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {

			$statment->bindParam($key, $value);
		}
	}

	private function setParam($statment, $key, $value){

		$this->setParam($key, $value);
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare("$rawQuery");

		$this->setParams($stmt, $params);	
		$stmt->execute();	
		
		return $stmt;

		}

		public function select($rawQuery, $params = array()){

			$stmt = $this->query($rawQuery, $params);


			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

}

 ?>