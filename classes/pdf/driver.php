<?php

namespace Pdf;

class Pdf_Driver
{
	/**
	* Driver config
	* @var array
	*/
	protected $config = array();

	/**
	 * Driver instance
	 * @var mixed
	 */
	protected $instance = null;

	/**
	* Driver constructor
	*
	* @param array $config driver config
	*/
	public function __construct(array $config = array())
	{
		\Arr::merge($this->config, $config);
	}

	/**
	* Get a driver config setting.
	*
	* @param string $key the config key
	* @return mixed the config setting value
	*/
	public function get_config($key, $default = null)
	{
		return \Arr::get($this->config, $key, $default);
	}

	/**
	* Set a driver config setting.
	*
	* @param string $key the config key
	* @param mixed $value the new config value
	* @return object $this for chaining
	*/
	public function set_config($key, $value)
	{
		\Arr::set($this->config, $key, $value);

		return $this;
	}

	public function init() {}

	public function __call($method, $arguments)
	{
		if (method_exists($this->instance, $method))
		{
				$return = call_user_func_array(array($this->instance, $method), $arguments);
				return ($return) ? $return : $this;
		}
	}

	public function __get($name)
	{
		if (isset($this->{$name}))
		{
			return $this->{$name};
		}
		elseif(isset($this->instance->{$name}))
		{
			return $this->instance->{$name};
		}
		else
		{
			return false;
		}
	}

	public function __set($name, $value)
	{
		if (isset($this->{$name})) {
			$this->{$name} = $values;
		}
		else
		{
			$this->instance->{$name} = $value;
		}
	}
}