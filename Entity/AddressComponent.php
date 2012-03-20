<?php

namespace Google\MapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Google\MapsBundle\Entity\AddressComponent
 *
 * @ORM\Table()
 * @ORM\Entity()
 *
 * Iván Guillén - zeopix@gmail.com
 * Doctrine2 Entity adaption of Google Maps Api address component.
 */
class AddressComponent
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
     * @var string $long_name
     *
     * @ORM\Column(name="long_name", type="string", length=255)
     */
    private $long_name;

    /**
     * @var string $short_name
     *
     * @ORM\Column(name="short_name", type="string", length=255)
     */
    private $short_name;

    /**
     * @var integer $types
     *
     * @ORM\Column(name="types", type="bigint")
     */
    private $types;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="components")
     */
     private $location;
     
     
	function __construct(){
		$this->types=0;
	}
	

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
     * Set long_name
     *
     * @param string $longName
     */
    public function setLongName($longName)
    {
        $this->long_name = $longName;
    }

    /**
     * Get long_name
     *
     * @return string 
     */
    public function getLongName()
    {
        return $this->long_name;
    }

    /**
     * Set short_name
     *
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->short_name = $shortName;
    }

    /**
     * Get short_name
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->short_name;
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
     * @return Array 
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
    

    /**
     * Set location
     *
     * @param Google\MapsBundle\Entity\Location $location
     */
    public function setLocation(\Google\MapsBundle\Entity\Location $location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return Google\MapsBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    public function getNumericTypes(){
    	return $this->types;
    }
}