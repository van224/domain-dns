<?php
namespace KaywGeek\Dns\Test;

use KaywGeek\Dns\Dns;
use KaywGeek\Dns\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DnsTest extends TestCase
{
    public function testDnsWithInvalidIp()
    {

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid IP address');
        $d = new Dns('chasing.com','312');
        $d->ParsingDomain();
    }
    public function testDnsWithInvalidDomain()
    {

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid Domain');
        $d = new Dns('chasing','114.142.142.22');
        $d->ParsingDomain();
        $this->fail('failed to assert Dns throw exception with invalid argument');

    }
    public function testParsingDomain()
    {
        $d = new Dns('https://www.chasing.com','124.64.165.53');
        $dns = $d->ParsingDomain();
        $this->assertSame('89.208.247.90',$dns);
    }

}