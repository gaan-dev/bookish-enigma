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
				<ul class="navbar-nav">
					<a href="/properties/create" class="btn btn-primary">Create</a>
				</ul>
			</div>
		</div>
	</nav>
  	<div class="container mt-4">
  		<form method="GET" action="/">
  			<div class="row">
  				<div class="col-md-12">
  					<h5>Filters</h5>
  				</div>
  			</div>
	  		<div class="row">
	  			<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="name">Name</label>
	  					<input type="text" class="form-control" name="name">
	  				</div>
	  			</div>
	  			<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="bedrooms">Bedrooms</label>
	  					<select class="form-control" name="bedrooms">
	  						<option default></option>
	  						<option value="1">1</option>
	  						<option value="2">2</option>
	  						<option value="3">3</option>
	  						<option value="4">4</option>
	  						<option value="5">5</option>
	  						<option value="6">6</option>
	  					</select>
	  				</div>
	  			</div>
	  			<div class="col-md-4">
	  				<div class="form-group">
	  					<label for="name">Price</label>
	  					<input type="text" class="form-control" name="price">
	  				</div>
	  			</div>
	  		</div>
	  		<div class="row">
	  			<div class="col-md-5">
	  				<div class="form-group">
	  					<label for="name">Property Type</label>
	  					<select class="form-control" name="property_type">
	  						<option default></option>
	  						<?php foreach($property_types as $type) : ?>
	  							<option value="<?= $type->id ?>"><?= $type->title ?></option>
	  						<?php endforeach ?>
	  					</select>
	  				</div>
	  			</div>
	  			<div class="col-md-5">
	  				<div class="form-group">
		  				<label for="type">Type</label>
		  				<div class="form-check">
						  <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="sale">
						  <label class="form-check-label" for="exampleRadios1">
						    For Sale
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="rent"
						  >
						  <label class="form-check-label" for="exampleRadios2">
						    Rentable
						  </label>
						</div>
		  			</div>
	  			</div>
	  			<div class="col-md-2 d-flex justify-content-end align-items-center">
	  				<button class="btn btn-primary">Filter</button>
	  			</div>
	  		</div>
		</form>
  		<div class="row">
  			<div class="col-md-12 mx-auto">
  				<table class="table table-striped">
  					<tbody>
						<?php foreach($properties as $key=>$property){ ?>
							<tr>
								<td>
									<img src="<?= htmlspecialchars($property->image_thumbnail) ?>" class="card-img-top" alt="...">
								</td>
								<td>
									<div>
										<?= htmlspecialchars($property->address) ?> <?= htmlspecialchars($property->property_type->title) ?>
									</div>
									<div><?= htmlspecialchars($property->price) ?> rubles</div>
									<div><?= htmlspecialchars($property->num_bedrooms) ?> bedrooms</div>
									<div><?= htmlspecialchars($property->num_bathrooms) ?> bathrooms</div>
								</td>
								<td></td>
								<td>
									<a href="/properties/<?= htmlspecialchars($property->id) ?>">Show</a>
								</td>
								<td>
									<form action="/properties/<?= htmlspecialchars($property->id) ?>/delete" method="POST">
										<input value="<?= $token ?>" name="token" type="hidden">
										<button>Del</button>
									</form>
								</td>
							</tr>
						<?php }?>
  					</tbody>
  				</table>
	  		</div>
  		</div>
  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
