<?php


class Request
{
    protected static $__this = null;

    protected $request;

    public function __construct()
    {
        $this->request = $_REQUEST;
    }
    
    public static function __callStatic($name, $arguments)
    {
        if (!self::$__this) self::$__this = new Request();

        if (!method_exists(self::$__this, $name)) throw new \Exception('Undefined method: ' . $name);
        
        return call_user_func_array(array(self::$__this, $name), $arguments);
    }

    protected function get($property = null)
    {
        return ( !$property || !isset($this->request[$property]) ) ? null : $this->request[$property];
    }

}