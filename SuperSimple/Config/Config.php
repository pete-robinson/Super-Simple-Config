<?php
/**
 * config class
 * @package App
 * @author Pete Robinson
 **/
namespace PeteRobinson\SuperSimple\Config;

use Symfony\Component\Yaml\Yaml;

class Config
{
	/**
	 * configuration object
	 * @var array
	 **/
	private $config;

	/**
	 * constructor
	 * @param string $config_file - the YML config file
	 * @return void
	 **/
	public function __construct($config_file)
	{
		// throw error if config not found
		if(!file_exists($config_file)) {
			throw new \Exception('Configuration not found');
		}

		// parse the yml file
		$config = Yaml::parse(file_get_contents($config_file));
		
		// assign to class property
		$this->config = $config;
	}

	/**
	 * get
	 * accepts single key (return array) or . delimited string to find a nested key
	 * @param string $key
	 * @return mixed
	 **/
	public function get($key) {
		// explode string by .
		$arr = explode('.', $key);
		
		// init $path variable to the config array
		$path = $this->config;

		// loop through items, reassiging $path each time to build up the array tree
		foreach($arr as $item) {
			if(array_key_exists($item, $path)) {
				$path = $path[$item];
			} else {
				throw new \Exception('Configuration ' . $key . ' not found');
			}
		}

		// return
		return $path;
	}
}