<?php

$router->get('/', function(){
	$filters = collect($_GET)->only(['name', 'bedrooms', 'price', 'property_type', 'type'])->toArray();
	$query = \App\Models\Property::with('property_type');
	foreach($filters as $field=>$item){
		if(!$item){
			continue;
		}
		switch($field){
			case 'name':
				$query->where('address', $item);
				break;
			case 'bedrooms':
				$query->where('num_bedrooms', $item);
				break;
			case 'property_type':
				$query->where('property_type_id', $item);
				break;
			default:
				$query->where($field, $item);
				break;
		}
	}
	$properties = $query->limit(100)->get();
	$property_types = \App\Models\PropertyType::all();
	$token = $_SESSION['token'];
	require __DIR__.'/../views/index.php';
});

$router->get('/properties/create', function(){
	$property_types = \App\Models\PropertyType::all();
	$token = $_SESSION['token'];
	require __DIR__.'/../views/create.php';
});

$router->get('/properties/(\d+)', function($propertyId) {
	$property = \App\Models\Property::with('property_type')->find($propertyId);
	$property_types = \App\Models\PropertyType::all();
	$token = $_SESSION['token'];
	require __DIR__.'/../views/show.php';
});

$router->post('/properties', function(){
	if(verifyCsrf()){
		$path = null;
		if($_FILES['image']['size']){
			$path = storeFile($_FILES['image']);
		}else{
			die('Whoops we forgot a file upload!');
		}

		$payload = array_merge(collect($_POST)->only([
			'county', 'country', 'town','description','address',
			'num_bedrooms','num_bathrooms','price','property_type_id',
			'type'
		])->toArray(), ['image_full' => $path, 'image_thumbnail' => $path]);

		$property = \App\Models\Property::create($payload);

		$property->update(sanitize($payload));
		return redirect("/properties/{$property->id}");
	}
});

$router->post('/properties/(\d+)', function($propertyId) {
	if(verifyCsrf()){
		$property = \App\Models\Property::find($propertyId);

		$path = $property->image_full;
		if($_FILES['image']['size']){
			$path = storeFile($_FILES['image']);
		}

		$payload = array_merge(collect($_POST)->only([
			'county', 'country', 'town','description','address',
			'num_bedrooms','num_bathrooms','price','property_type_id',
			'type'
		])->toArray(), ['image_full' => $path, 'image_thumbnail' => $path]);

		$property->update(sanitize($payload));
		return redirect("/properties/{$property->id}");
	}else{
		echo "failed csrf";
	}
});

$router->post('/properties/(\d+)/delete', function($propertyId){
	if(verifyCsrf()){
		\App\Models\Property::find($propertyId)->delete();
		return header("Location: /");
	}else{
		echo "failed csrf";
	}
});
