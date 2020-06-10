<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>List of items</title>
  </head>
  <body>
  	<div class='container'>
    <h1>List of items</h1>
    <a href='/login/logout'>Logout</a><br/>
		<a href='/home/create' class='btn btn-success'>Add an item</a>
		<table class="table table-striped">
			<tr><td>Name</td><td>Actions</td></tr>
			<?php
			foreach ($data['items'] as $item) {
				echo "<tr><td>$item->name</td><td>
				<a href=' /home/detail/$item->item_id' class='btn btn-primary'>Details</a>
				<a href=' /home/edit/$item->item_id' class='btn btn-secondary'>Edit</a> 
				<a href=' /home/delete/$item->item_id'class='btn btn-danger'>Delete</a> 
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
