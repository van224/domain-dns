# PHP Domain DNS

:peach:This library can help you resolve the best DNS by specifying a domain name

## Installing

```
$ composer require kayw-geek/domain-dns
```

## Usage

```php
<?php
use KaywGeek\Dns\Dns;

$dns = (new Dns('baidu.com','114.114.114.114'))->ParsingDomain();
```

### 