Install
--
Documentation in progress, just a normal symfony2 bundle installation ;)

Using
--
Use it anywhere, returns results as doctrine manipulable entities.
/*
<?php
namespace Acme\DemoBundle\Controller;

use Google\MapsBundle\Geo\Coding;

class DefaultController{

	public function demoAction(){
	
		$query = new Coding('Barcelona');
		
		$results = $query->getResults(); //ready to persist to your $em!
		
		return new Response(json_encode($results);
	}
}
*/

Todo
--
* Google Maps abstraction layer
* GMapsApi Service 
* GMapsApi twig helper
* GMapsApi street2latlng widget
Widget con capacidad de indicar una localización, mostrara una serie de sugerencias obtenidas con la api (AJAX?), y permitira seleccionar (radio) la más indicada. 

Resources
--
* https://developers.google.com/maps/documentation/geocoding/?hl=es

* Places? https://developers.google.com/maps/documentation/places/?hl=es


Warning
--
This bundle is in ealry stage of development.