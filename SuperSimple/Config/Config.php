<?php
/**
 * config class
 * @package App
 * @author Pete Robinson
 **/
namespace App;

use Symfony\Component\Yaml\Yaml;

final class Config
{
	/**
	 * configuration object
	 * @var array
	 **/
	private $config;

	/**
	 * constructor
	 * @return void
	 **/
	public function __construct()
	{
		// load the config file
		$config_file = __DIR__ . '/config.yml';

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