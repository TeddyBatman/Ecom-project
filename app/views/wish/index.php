<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Wish List</title>
  </head>
  <body>
  	<div class='container'>
      <h1>Bookshelf</h1>
    <h2>Wish List</h2>
      <div><a href='/login/logout'class='btn btn-dark'>Logout</a><br/></div><br/>
      <div><a href=' /product/index' class='btn btn-info'>Back to Book List</a>
    <a href='/wish/create' class='btn btn-success'>Add to Wish List</a><br/></div>
		<table class="table table-striped">
			<tr><th>Name</th><th>Price</th><th>Actions</th></tr>
			<?php
			foreach ($data['items'] as $item) {
				echo "<tr><td>$item->name</td><td>$item->price</td><td>
				<a href=' /wish/detail/$item->wish_id' class='btn btn-primary'>Details</a>
				<a href=' /wish/edit/$item->wish_id' class='btn btn-secondary'>Edit</a> 
				<a href=' /wish/delete/$item->wish_id'class='btn btn-danger'>Delete</a> 
        <a href=' /wish/addCart/$item->wish_id'class='btn btn-info'> Add to cart</a>
				</td></tr>";
			}
			?>
		</table>

	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
