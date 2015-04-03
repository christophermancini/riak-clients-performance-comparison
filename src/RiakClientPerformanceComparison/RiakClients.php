<?php

namespace RiakClientPerformanceComparison;

/**
 * @author Fabio B. Silva <fabio.bat.silva@gmail.com>
 */
class RiakClients
{
    /**
     * @var \Riak\Client\RiakClient
     */
    protected $riakClientProto;

    /**
     * @var \Riak\Client\RiakClient
     */
    protected $riakClientHttp;

    /**
     * @var \Riak\Connection
     */
    protected $phpRiak;

    /**
     * @var \Basho\Riak\Riak
     */
    protected $bashoRiak;

    /**
     * @return \Riak\Client\RiakClient
     */
    public function getRiakClientProto()
    {
        if ($this->riakClientProto == null) {
            $this->riakClientProto = $this->createRiakClientProto();
        }

        return $this->riakClientProto;
    }

    /**
     * @return \Riak\Client\RiakClient
     */
    public function getRiakClientHttp()
    {
        if ($this->riakClientHttp == null) {
            $this->riakClientHttp = $this->createRiakClientHttp();
        }

        return $this->riakClientHttp;
    }

    /**
     * @return \Riak\Connection
     */
    public function getPhpRiak()
    {
        if ($this->phpRiak == null) {
            $this->phpRiak = $this->createPhpRiak();
        }

        return $this->phpRiak;
    }

    /**
     * @return \Basho\Riak\Riak
     */
    public function getBashoRiak()
    {
        if ($this->bashoRiak == null) {
            $this->bashoRiak = $this->createBashoRiak();
        }

        return $this->bashoRiak;
    }

    /**
     * @param mixed $name
     * @param mixed $default
     *
     * @return string
     */
    public function getEnv($name, $default)
    {
        return getenv($name) ?: $default;
    }

    /**
     * @return string
     */
    public function getProtoUri()
    {
        return $this->getEnv('RIAK_PROTO_URI', 'proto://127.0.0.1:8087');
    }

    /**
     * @return string
     */
    public function getHttpUri()
    {
        return $this->getEnv('RIAK_HTTP_URI', 'http://127.0.0.1:8098');
    }

    /**
     * @return \Riak\Client\RiakClient
     */
    public function createRiakClientProto()
    {
        return $this->createRiakClient($this->getProtoUri());
    }

    /**
     * @return \Riak\Client\RiakClient
     */
    public function createRiakClientHttp()
    {
        return $this->createRiakClient($this->getHttpUri());
    }

    /**
     * @param string $nodeUri
     *
     * @return \Riak\Client\RiakClient
     */
    public function createRiakClient($nodeUri)
    {
        $builder  = new \Riak\Client\RiakClientBuilder();
        $client   = $builder
            ->withNodeUri($nodeUri)
            ->build();

        return $client;
    }

    /**
     * @return \Basho\Riak\Riak
     */
    public function createBashoRiak()
    {
        $uri  = $this->getHttpUri();
        $host = parse_url($uri, PHP_URL_HOST);
        $port = parse_url($uri, PHP_URL_PORT);

        return new \Basho\Riak\Riak($host, $port);
    }

    /**
     * @return \Riak\Connection
     */
    public function createPhpRiak()
    {
        $uri  = $this->getProtoUri();
        $host = parse_url($uri, PHP_URL_HOST);
        $port = parse_url($uri, PHP_URL_PORT);

        return new \Riak\Connection($host, $port);
    }
}
