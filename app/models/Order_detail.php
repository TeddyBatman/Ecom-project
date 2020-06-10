<?php
class Order_detail extends Model{
	var $order_id;
	var $product_id;
	var $qty;
	var $price;

	public function getForOrder($order_id){
		$SQL = 'SELECT Order_detail.order_detail_id, Product.*, filename FROM Order_detail JOIN Product On Order_detail.product_id = Product.product_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Order_detail');
		return $stmt->fetchAll();
	}

	public function create(){
		$SQL = 'INSERT INTO Order_detail (order_id,product_id,qty,price) Value(:order_id,:product_id,:qty,:price)';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['order_id'=>$this->order_id,'product_id'=>$this->product_id,'qty'=>$this->qty,'price'=>$this->price]);
		return $stmt->rowCount();
	}

/*
	public function find($Order_detail_id){
		$SQL = 'SELECT * FROM Order_detail WHERE Order_detail_id = :Order_detail_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['Order_detail_id'=>$Order_detail_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Order_detail');
		return $stmt->fetch();
	}*/

	public function update(){
		$SQL = 'UPDATE Order_detail SET qty = :qty, price = :price WHERE order_detail_id = :order_detail_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['qty'=>$this->qty,'price'=>$this->price,'order_detail_id'=>$this->order_detail_id]);
		return $stmt->rowCount();
	}

	public function delete(){
		$SQL = 'DELETE FROM Order_detail WHERE order_detail_id = :order_detail_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['order_detail_id'=>$this->order_detail_id]);
		return $stmt->rowCount();
	}
}


	
?>