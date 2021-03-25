# PHP Domain DNS

:peach:This library can help you resolve the best DNS by specifying a domain name

![GitHub top language](https://img.shields.io/github/languages/top/kayw-geek/domain-dns) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/kayw-geek/domain-dns) ![GitHub](https://img.shields.io/github/license/kayw-geek/domain-dns)
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

## License
MIT
### 
