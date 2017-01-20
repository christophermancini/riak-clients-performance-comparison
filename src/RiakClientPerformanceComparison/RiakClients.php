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
     * @var \Basho\Riak
     */
    protected $bashoRiakHttp;

    /**
     * @var \Basho\Riak
     */
    protected $bashoRiakProto;

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
     * @return \Basho\Riak
     */
    public function getBashoRiakHttp()
    {
        if ($this->bashoRiakHttp == null) {
            $this->bashoRiakHttp = $this->createBashoRiak();
        }

        return $this->bashoRiakHttp;
    }

    /**
     * @return \Basho\Riak
     */
    public function getBashoRiakProto()
    {
        if ($this->bashoRiakProto == null) {
            $this->bashoRiakProto = $this->createBashoRiak(true);
        }

        return $this->bashoRiakProto;
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
        return $this->getEnv('RIAK_PROTO_URI', 'proto://riak-test:8087');
    }

    /**
     * @return string
     */
    public function getHttpUri()
    {
        return $this->getEnv('RIAK_HTTP_URI', 'http://riak-test:8098');
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
     * @return \Basho\Riak
     */
    public function createBashoRiak($pb = false)
    {
        $uri = $pb ? $this->getProtoUri() : $this->getHttpUri();
        $host = parse_url($uri, PHP_URL_HOST);
        $port = parse_url($uri, PHP_URL_PORT);

        $node = (new \Basho\Riak\Node\Builder)
            ->atHost($host)
            ->onPort($port)
            ->build();

        return new \Basho\Riak([$node], [], $pb ? new \Basho\Riak\Api\Pb() : null);
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
