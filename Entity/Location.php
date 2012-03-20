<?php

namespace Google\MapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Google\MapsBundle\Entity\Location
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * Iván Guillén - zeopix@gmail.com
 * Doctrine2 Entity adaption of Google Maps Api address component.
 */
class Location
{

	public $type_values = Array(
		2 		=> 'street_address',
		4 		=> 'route',
		8 		=> 'intersection',
		16 		=> 'political',
		32 		=> 'country',
		64 		=> 'administrative_area_level_1',
		128 	=> 'administrative_area_level_2',
		256 	=> 'administrative_area_level_3',
		512 	=> 'colloquial_area',
		1024 	=> 'locality',
		2048 	=> 'sublocality',
		4096 	=> 'neighborhood',
		8192 	=> 'premise',
		16384 	=> 'subpremise',
		32768 	=> 'postal_code',
		65536	=> 'natural_feature',
		131072 	=> 'airport',
		262144 	=> 'park',
		524288 	=> 'point_of_interest',
	);	
	
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bigint $types
     *
     * @ORM\Column(name="types", type="bigint")
     */
    private $types;

    /**
     * @var float $latitude
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float $longitude
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var string $formatted_address
     *
     * @ORM\Column(name="formatted_address", type="string", length=255)
     */
    private $formatted_address;
    
    
    /**
     *
     * @ORM\OneToMany(targetEntity="AddressComponent", mappedBy="location")
     */
    private $components;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set formatted_address
     *
     * @param string $formattedAddress
     */
    public function setFormattedAddress($formattedAddress)
    {
        $this->formatted_address = $formattedAddress;
    }

    /**
     * Get formatted_address
     *
     * @return string 
     */
    public function getFormattedAddress()
    {
        return $this->formatted_address;
    }
    
    

    /**
     * Set types
     *
     * @param integer|string|array $types
     */
    public function setTypes($types)
    {
        	
    	if(is_array($types)){

    		$this->addTypes($types);
    	
    	}else if(is_numeric($types)){
    		
    		$this->types = $types;
    		
    	}else if(is_string($types)){
    	
    		$this->addType($types);
    		
    	}else{
    		
    		$this->types = $types;
    		
    	}
    }
    
   /**
     * Add one type
     *
     * @param string $types
     */    
    public function addType($type){
    	$values = $this->type_values;
		$numeric_type = intval(array_search($type,$values));

		if($numeric_type != null){
			if(!($this->types & $numeric_type)){
				$oldvalue =intval($this->types);
				$this->types = ($oldvalue > 0 )  ? $oldvalue + $numeric_type : $numeric_type;
			}
		}else{
			//TODO: exception	
		}
    }
    
    public function addTypes($types){
    	foreach($types as $type){
    		$this->addType($type);
    	}
    }

    /**
     * Get types
     *
     * @return Array() 
     */
    public function getTypes()
    {
    	$type_values = $this->type_values;
    	$result = Array();
    	foreach($type_values as $key => $type){
    		if($this->types & $key){
    			$result[] = $type;
    		}
    	}

        return $result;
    }
    public function __construct()
    {
        $this->components = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add components
     *
     * @param Google\MapsBundle\Entity\AddressComponent $components
     */
    public function addAddressComponent(\Google\MapsBundle\Entity\AddressComponent $components)
    {
        $this->components[] = $components;
    }

    /**
     * Get components
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComponents()
    {
        return $this->components;
    }
}