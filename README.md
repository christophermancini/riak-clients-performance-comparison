# PHP Riak Clients Performance Comparison

Performance Comparison Between Some PHP Riak Clients

* https://github.com/basho/riak-php-client
* https://github.com/php-riak/riak-client


```bash
./vendor/bin/athletic -p src/RiakClientPerformanceComparison

RiakClientPerformanceComparison\FetchObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    fetchUsingBashoRiakHttp  : [1,000     ] [0.0020127630234] [496.82948]
    fetchUsingRiakClientHttp : [1,000     ] [0.0027981035709] [357.38491]
    fetchUsingRiakClientProto: [1,000     ] [0.0013639006615] [733.19123]


RiakClientPerformanceComparison\StoreObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    storeUsingBashoRiakHttp  : [1,000     ] [0.0031232557297] [320.17871]
    storeUsingRiakClientHttp : [1,000     ] [0.0033677012920] [296.93845]
    storeUsingRiakClientProto: [1,000     ] [0.0018737449646] [533.69056]
```
