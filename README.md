# PHP Riak Clients Performance Comparison

Performance Comparison Between Some PHP Riak Clients

* [basho client](https://github.com/basho/riak-php-client) - PHP Client with support for HTTP only
* [riak client](https://github.com/php-riak/riak-client) - PHP Client with support for HTTP and Protocol Buffers
* [php riak](https://github.com/php-riak/php_riak) - PHP Extension with support for Protocol Buffers only

**FYI: You have to manually update centraldesktop/protobuf-php to a version >=.7 due to a bug in v.69**

#### Please remember to disable XDebug before running this.

```bash
php -v

PHP 5.6.29 (cli) (built: Dec 10 2016 12:42:43)
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies

./vendor/bin/athletic -p src/RiakClientPerformanceComparison

RiakClientPerformanceComparison\FetchObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    fetchUsingBashoRiakHttp  : [1,000     ] [0.0012319908142] [811.69436]
    fetchUsingRiakClientHttp : [1,000     ] [0.0017128930092] [583.80763]
    fetchUsingPhpRiakProto   : [1,000     ] [0.0004936494827] [2,025.72885]
    fetchUsingBashoRiakProto : [1,000     ] [0.0005921034813] [1,688.89397]
    fetchUsingRiakClientProto: [1,000     ] [0.0007770638466] [1,286.89554]

RiakClientPerformanceComparison\StoreObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    storeUsingBashoRiakHttp  : [1,000     ] [0.0017122998238] [584.00987]
    storeUsingRiakClientHttp : [1,000     ] [0.0021628496647] [462.35299]
    storeUsingPhpRiakProto   : [1,000     ] [0.0009303803444] [1,074.82924]
    storeUsingBashoRiakProto : [1,000     ] [0.0010512371063] [951.26018]
    storeUsingRiakClientProto: [1,000     ] [0.0011875724792] [842.05387]
```

```bash
php -v

PHP 5.5.38 (cli) (built: Jul 21 2016 12:25:20)
Copyright (c) 1997-2015 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2015 Zend Technologies

./vendor/bin/athletic -p src/RiakClientPerformanceComparison

RiakClientPerformanceComparison\FetchObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    fetchUsingBashoRiakHttp  : [1,000     ] [0.0012245488167] [816.62730]
    fetchUsingRiakClientHttp : [1,000     ] [0.0017250297070] [579.70016]
    fetchUsingPhpRiakProto   : [1,000     ] [0.0005029010773] [1,988.46263]
    fetchUsingBashoRiakProto : [1,000     ] [0.0005901517868] [1,694.47932]
    fetchUsingRiakClientProto: [1,000     ] [0.0007686996460] [1,300.89822]

RiakClientPerformanceComparison\StoreObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    storeUsingBashoRiakHttp  : [1,000     ] [0.0017284393311] [578.55661]
    storeUsingRiakClientHttp : [1,000     ] [0.0021833202839] [458.01800]
    storeUsingPhpRiakProto   : [1,000     ] [0.0009761657715] [1,024.41617]
    storeUsingBashoRiakProto : [1,000     ] [0.0011112279892] [899.90534]
    storeUsingRiakClientProto: [1,000     ] [0.0011894767284] [840.70581]
```

```bash
php -v

PHP 5.4.16 (cli) (built: Nov  6 2016 00:29:02)
Copyright (c) 1997-2013 The PHP Group
Zend Engine v2.4.0, Copyright (c) 1998-2013 Zend Technologies

./vendor/bin/athletic -p src/RiakClientPerformanceComparison

RiakClientPerformanceComparison\FetchObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    fetchUsingPhpRiakProto   : [10,000    ] [0.0004839506388] [2,066.32644]
    fetchUsingBashoRiakHttp  : [10,000    ] [0.0077597248554] [128.87055]
    fetchUsingBashoRiakProto : [10,000    ] [0.0005623223305] [1,778.33948]
    fetchUsingRiakClientHttp : [10,000    ] [0.0016223870754] [616.37572]
    fetchUsingRiakClientProto: [10,000    ] [0.0008009066105] [1,248.58502]

RiakClientPerformanceComparison\StoreObjectEvent
    Method Name                 Iterations    Average Time      Ops/second
    -------------------------  ------------  --------------    -------------
    storeUsingPhpRiakProto   : [10,000    ] [0.0009526465893] [1,049.70722]
    storeUsingBashoRiakHttp  : [10,000    ] [0.0081091584921] [123.31736]
    storeUsingBashoRiakProto : [10,000    ] [0.0011179124832] [894.52441]
    storeUsingRiakClientHttp : [10,000    ] [0.0023356080532] [428.15403]
    storeUsingRiakClientProto: [10,000    ] [0.0012381608486] [807.64951]
```
