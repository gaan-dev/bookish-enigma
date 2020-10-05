<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>This is horrible.</title>
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<div class="container">
		  <a class="navbar-brand" href="/">The Worlds Worst Website</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
		      </li>
		  </ul>
		  </div>
  		</div>
</nav>
  	<div class="container mt-4">
	  	<form action="/properties" method="POST" enctype="multipart/form-data">
			<input value="<?= $token ?>" name="token" type="hidden">
	  		<div class="row">
	  			<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="county">County</label>
	  					<input type="text" name="county" class="form-control" required>
	  				</div>
	  			</div>
	  			<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="country">Country</label>
		  				<input type="text" name="country" class="form-control" required>
		  			</div>
	  			</div>
	  			<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="town">Town</label>
		  				<input type="text" name="town" class="form-control" required>
		  			</div>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-md-12">
	  				<div class="form-group">
	  					<label for="description">Description</label>
	  					<textarea name="description" cols="30" rows="5" class="form-control" required></textarea>
		  			</div>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-md-6">
	  				<div class="form-group">
	  					<label for="">Displayable Address</label>
	  					<input type="text" name="address" class="form-control" required>
	  				</div>
			  	</div>
		  		<div class="col-md-6">
	  				<div class="form-group">
	  					<label for="">Image</label>
	  					<div class="custom-file">
						  <input type="file" name="image" class="custom-file-input" id="customFile">
						  <label class="custom-file-label" for="customFile">Choose file</label>
						</div>
	  				</div>
			  	</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-md-6">
	  				<div class="form-group">
	  					<label for="num_bedrooms">Bedrooms</label>
	  					<select name="num_bedrooms" class="form-control" required>
	  						<option value="1">1</option>
	  						<option value="2">2</option>
	  						<option value="3">3</option>
	  						<option value="4">4</option>
	  						<option value="5">5</option>
	  					</select>
		  			</div>
		  		</div>
		  		<div class="col-md-6">
	  				<div class="form-group">
	  					<label for="">Bathrooms</label>
	  					<select name="num_bathrooms" class="form-control" required>
	  						<option value="1">1</option>
	  						<option value="2">2</option>
	  						<option value="3">3</option>
	  						<option value="4">4</option>
	  						<option value="5">5</option>
	  					</select>
	  				</div>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="">Price</label>
	  					<input type="text" class="form-control" name="price" required>
	  				</div>
		  		</div>
		  		<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="property_type">Property Type</label>
	  					<select name="property_type_id" class="form-control" required>
	  						<?php foreach($property_types as $prop_type) : ?>
		  						<option value="<?= $prop_type->id ?>"><?= $prop_type->title ?></option>
		  					<?php endforeach ?>
	  					</select>
	  				</div>
		  		</div>
		  		<div class="col-md-4">
		  			<div class="form-group">
		  				<label for="type">Type</label>
		  				<div class="form-check">
						  <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="sale" required>
						  <label class="form-check-label" for="exampleRadios1">
						    For Sale
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="rent" required
						  >
						  <label class="form-check-label" for="exampleRadios2">
						    Rentable
						  </label>
						</div>
		  			</div>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-md-12 d-flex justify-content-end">
		  			<button class="btn btn-primary">Submit</button>
		  		</div>
		  	</div>
	  	</form>
  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
