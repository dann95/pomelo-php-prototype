<?php


namespace Pomelo\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements \ArrayAccess,
                            ContainerInterface
{

    const SINGLETON_TYPE = 'singletons';
    const BINDING_TYPE = 'bindings';
    const BUILD_TYPE = 'registers';
    
    private $builds = [];
    private $singletons = [];
    private $registers = [];
    private $bindings = [];
    private $alisases = [];

    /**
     * @param string $abstract 
     * @param string|\Closure $concrete 
     * @return $this
     * @throws \Exception
     */
    public function bind($abstract, $concrete)
    {
        if(key_exists($abstract, $this->alisases))
            throw new \Exception("This class is already registered");
        $this->alisases[$abstract] = self::BINDING_TYPE;
        $this->bindings[$abstract] = $concrete;
        return $this;
    }

    /**
     * @param string $class 
     * @param \Closure $process
     * @return $this
     * @throws \Exception
     */
    public function build($class, \Closure $process)
    {
        if(key_exists($class, $this->alisases))
            throw new \Exception("This class is already registered");
        
        $this->alisases[$class] = self::BUILD_TYPE;
        $this->builds[$class] = $process;
        return $this;
    }

    /**
     * @param string $class 
     * @param \Closure $proccess
     * @return $this
     * @throws \Exception
     */
    public function singleton($class, \Closure $proccess)
    {
        if(key_exists($class, $this->alisases))
            throw new \Exception("This class is already registered");

        $this->alisases[$class] = self::SINGLETON_TYPE;
        $this->singletons[$class] = ['instance' => null, 'factory' => $proccess];

        return $this;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->registers[$id];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return key_exists($id, $this->registers);
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function register($key, $value)
    {
        $this->registers[$key] = $value;
        return $this;
    }

    private function makeAliase($class, $args = [])
    {
        switch ($this->alisases[$class]) {
            case self::SINGLETON_TYPE:
                if($this->singletons[$class]['instance'] === null)
                    $this->singletons[$class]['instance'] = $this->singletons[$class]['factory']($this);

                return $this->singletons[$class]['instance'];
                break;
            case self::BINDING_TYPE:
                $return = $this->bindings[$class];
                if($return instanceof \Closure)
                    return $return($this);

                return $this->make($return);
                break;
            case self::BUILD_TYPE:
                return $this->builds[$class]($this);
                break;
        }
    }

    public function make($class, $args = [])
    {
        if(key_exists($class, $this->alisases))
            return $this->makeAliase($class, $args);
    }

    public function execute($callabe, $args = [])
    {
        return call_user_func_array($callabe, $args);
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->register($offset, $value);
    }

    public function offsetUnset($offset)
    {
        unset($this->registers[$offset]);
    }
}