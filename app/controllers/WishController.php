<?php
/*
/**
	@accessFilter:{AdminFilter}
*/

	class WishController extends Controller{

		public function index(){

			$items = $this->model('Wish')->get();
			$this->view('wish/index',['items'=>$items]);

		}

		public function create(){

			if(isset($_POST['action'])){
				$newItem = $this->model('Wish');
				$newItem->name = $_POST['name'];
				$newItem->description = $_POST['description'];
				$newItem->price = $_POST['price'];
				$newItem->create();
				//var_dump($newItem);
				header('location:/wish/index');
			}else{
				$this->view('wish/create');
			}
		}

		public function addPicture($product_id){
			if(isset($_FILES['newPicture'])&& $_FILES['newPicture']['error'] == UPLOAD_ERR_OK){
				$info = getimagesize($_FILES['newPicture']['tmp_name']);
				$allowedTypes = [IMAGETYPE_JPEG=>'.jpg',IMAGETYPE_PNG=>'.png',IMAGETYPE_GIF=>'.gif'];//accept jpeg,png,gif

				if(info === false){
					//no go
					$this->view('wish/addPicture', ['error'=>'Bad file format']);
				}else if(!array_key_exists($info[2], $allowedTypes)){
					//no go
					$this->view('wish/addPicture', ['error'=>'Wrong file type']);
				}else{
					//save the picture in the image folder
					$path = getcwd().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
					$filename = uniqid().$allowedTypes[$info[2]];
					move_uploaded_file($_FILES['newPicture']['tmp_name'], $path.$filename);

					$newPicture=$this->model('Picture');
					$newPicture->product_id = $product_id;
					$newPicture->filename = $filename;
					$newPicture->description = $_POST['description'];
					$newPicture->create();
					//var_dump($_POST);
					header('location:/wish/index');
				}
			}else{
				$this->view('wish/addPicture');
			}
		}
	

		public function deletePicture($picture_id){
			$thePicture = $this->model('Picture')->find($picture_id);
			unlink(getcwd().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$thePicture->filename);
			$thePicture->delete();

			header('location:/wish/index');
		}

		public function detail($wish_id){

			$theProduct = $this->model('Wish')->find($wish_id);
			$thePictures = $this->model('Picture')->getForProduct($wish_id);
			$theProduct->pictures = $thePictures;
			$this->view('wish/detail', $theProduct);
		}

		public function edit($wish_id){

			$theProduct = $this->model('Wish')->find($wish_id);

			if(isset($_POST['action'])){
				$theProduct->name = $_POST['name'];
				$theProduct->description = $_POST['description'];
				$theProduct->price = $_POST['price'];
				$theProduct->update();
				header('location:/wish/index');
			}else{
				$this->view('wish/edit', $theProduct);
			}
		}

		public function delete($wish_id){

			$theProduct = $this->model('Wish')->find($wish_id);

			if(isset($_POST['action'])){
				$theProduct->delete(); //deletion should not happen when there are sales recorded
				header('location:/product/index');
			}else{
				$this->view('product/delete', $theProduct);
			}
		}

		public function addToCart($wish_id){
			//cart user - product
			//make sure cart for user
			$cart = $this->model('Order')->findUserCart($_SESSION['user_id']);
			if($cart == null){
				//make cart
				$cart = $this->model('Order'); 
				$cart_user_id = $_SESSION['user_id'];
				$cart_status  = 'cart';
				$cart->order_id = $cart->create();
			}

			$newItem = $this->model('Order_detail');
			$newItem->order_id = $cart->order_id;
			$newItem->wish_id = $wish_id;
			$newItem->price = $this->model('Wish')->find($wish_id)->price;
			$newItem->qty = 1; //to work on if time
			$newItem->create();
			header('location:/product/index/');
		}

		public function findUserCart($user_id){
		$SQL = 'SELECT * FROM `Order` WHERE user_id = :user_id && status = :status';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id, 'status'=>'cart']);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Wish');
		return $stmt->fetch();
	}

/*
	public function addComment(){

			if(isset($_POST['action'])){
				$newComment = $this->model('Comment');
				$newComment->wish_id = $wish_id;
				$newComment->comment = $_POST['comment'];
				$newComment->create();
				header('location:/product/index');
			}else{
				$this->view('product/addComment');
			}
		}
*/

		

	}	

?>