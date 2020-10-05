<?php

use App\Models\Property;
use App\Models\PropertyType;

$router->get('/', function(){
	$filters = collect($_GET)->only(['name', 'bedrooms', 'price', 'property_type', 'type'])->toArray();
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$limit = isset($_GET['limit']) ? $_GET['limit'] : 15;
	$prev = '?page=' . ($page - 1);
	$next = '?page=' . ($page + 1);

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
	$properties = $query->limit($limit + 1)->offset(($page - 1) * $limit)->get();

	$has_prev = ($page - 1) > 0;
	$has_next = count($properties) > $limit;

	if($has_next){
		$properties = $properties->slice(0, -1);
	}

	$property_types = PropertyType::all();
	$token = $_SESSION['token'];
	require __DIR__.'/../views/index.php';
});

$router->get('/properties/create', function(){
	$property_types = PropertyType::all();
	$token = $_SESSION['token'];
	require __DIR__.'/../views/create.php';
});

$router->get('/properties/(\d+)', function($propertyId) {
	$property = Property::with('property_type')->find($propertyId);
	$property_types = PropertyType::all();
	$token = $_SESSION['token'];
	require __DIR__.'/../views/show.php';
});

$router->post('/properties', function(){
	if(!verifyCsrf()){
		echo 'failed csrf';
	}
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

	$property = Property::create($payload);

	$property->update(sanitize($payload));
	return redirect("/properties/{$property->id}");
});

$router->post('/properties/(\d+)', function($propertyId) {
	if(!verifyCsrf()){
		echo 'failed csrf';
	}

	$property = Property::find($propertyId);

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
});

$router->post('/properties/(\d+)/delete', function($propertyId){
	if(!verifyCsrf()){
		echo 'failed csrf';
	}
	Property::find($propertyId)->delete();
	return header("Location: /");
});
