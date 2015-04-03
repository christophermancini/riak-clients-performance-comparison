# PHP Riak Clients Performance Comparison

Performance Comparison Between Some PHP Riak Clients

* [basho client](https://github.com/basho/riak-php-client) - PHP Client with support for HTTP only
* [riak client](https://github.com/php-riak/riak-client) - PHP Client with support for HTTP and Protocol Buffers
* [php riak](https://github.com/php-riak/php_riak) - PHP Extension with support for Protocol Buffers only

```bash

php -v

PHP 5.5.22 (cli) (built: Mar 10 2015 14:17:46)
Copyright (c) 1997-2015 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2015 Zend Technologies


./vendor/bin/athletic -p src/RiakClientPerformanceComparison

RiakClientPerformanceComparison\FetchObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    fetchUsingPhpRiakProto   : [1,000     ] [0.0005543117523] [1,804.03897]
    fetchUsingRiakClientProto: [1,000     ] [0.0007790112495] [1,283.67851]
    fetchUsingBashoRiakHttp  : [1,000     ] [0.0017048845291] [586.54999]
    fetchUsingRiakClientHttp : [1,000     ] [0.0019021074772] [525.73265]


RiakClientPerformanceComparison\StoreObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    fetchUsingPhpRiakProto   : [1,000     ] [0.0010141553879] [986.04219]
    storeUsingRiakClientProto: [1,000     ] [0.0013224580288] [756.16767]
    storeUsingBashoRiakHttp  : [1,000     ] [0.0025912058353] [385.92071]
    storeUsingRiakClientHttp : [1,000     ] [0.0027356014252] [365.55033]

```
