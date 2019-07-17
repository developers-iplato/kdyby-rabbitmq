<?php

namespace Kdyby\RabbitMq;

use Nette;

class Registry 
{
    /**
	 * @var Nette\DI\Container
	 */
	private $serviceLocator;
    
    /**
     * @var array 
     */
    private $producers;
    
    /**
     * @var array
     */
    private $consumers;
    
    /**
     * @var array
     */
    private $rpcClients;
    
    /**
     * @var array
     */
    private $rpcServers;
    
    public function __construct(
        array $producers,
        array $consumers,
        array $rpcClients,
        array $rpcServers,
        Nette\DI\Container $serviceLocator
    ) {
        $this->producers = $producers;
        $this->consumers = $consumers;
        $this->rpcClients = $rpcClients;
        $this->rpcServers = $rpcServers;
        $this->serviceLocator = $serviceLocator;
    }
    
    /**
     * @param string $name
     * @return Producer
     */
    public function getProducer($name)
    {
        if (!isset($this->producers[$name])) {
            throw new InvalidArgumentException("Unknown producer {$name}");
        }
        
        return $this->serviceLocator->getService($this->producers[$name]);
    }
    
    /**
     * @param string $name
     * @return Consumer
     */
    public function getConsumer($name)
    {
        if (!isset($this->consumers[$name])) {
            throw new InvalidArgumentException("Unknown consumer {$name}");
        }
        
        return $this->serviceLocator->getService($this->consumers[$name]);
    }
    
    /**
     * @param string $name
     * @return RpcClient
     */
    public function getRpcClient($name)
    {
        if (!isset($this->rpcClients[$name])) {
            throw new InvalidArgumentException("Unknown RPC client {$name}");
        }
        
        return $this->serviceLocator->getService($this->rpcClients[$name]);
    }
    
    /**
     * @param string $name
     * @return RpcServer
     */
    public function getRpcServer($name)
    {
        if (!isset($this->rpcServers[$name])) {
            throw new InvalidArgumentException("Unknown RPC server {$name}");
        }
        
        return $this->serviceLocator->getService($this->rpcServers[$name]);
    }
    
}