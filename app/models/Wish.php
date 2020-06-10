<?php
class Wish extends Model{
	var $name;
	var $description;
	var $price;

	public function get(){
		$SQL = 'SELECT * FROM Wish';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Wish');
		return $stmt->fetchAll();
	}

	public function create(){
		$SQL = 'INSERT INTO Wish (name,description,price) Value(:name,:description,:price)';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['name'=>$this->name,'description'=>$this->description,'price'=>$this->price]);
		return $stmt->rowCount();
	}

	public function find($wish_id){
		$SQL = 'SELECT * FROM Wish WHERE wish_id = :wish_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['wish_id'=>$wish_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Wish');
		return $stmt->fetch();
	}

	public function update(){
		$SQL = 'UPDATE Wish SET name = :name,description = :description, price = :price WHERE wish_id = :wish_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['name'=>$this->name,'description'=>$this->description,'price'=>$this->price,'wish_id'=>$this->wish_id]);
		return $stmt->rowCount();
	}

	public function delete(){
		$SQL = 'DELETE FROM Wish WHERE wish_id = :wish_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['wish_id'=>$this->wish_id]);
		return $stmt->rowCount();
	}
}


	
?>