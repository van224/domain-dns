<?php
namespace KaywGeek\Dns;

/**
 * Class Dns
 * @package KaywGeek\dns
 */
class Dns
{
    public $domain;
    public $ip;

    public function __construct($domain,$ip = '')
    {
        if (!isset($_SERVER["REMOTE_ADDR"]) && $ip === ''){
            throw new \KaywGeek\Dns\Exceptions\InvalidArgumentException('Invalid IP address');
        }
        $ip = empty($ip) ?  $_SERVER["REMOTE_ADDR"] : $ip;
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE)){
            throw new \KaywGeek\Dns\Exceptions\InvalidArgumentException('Invalid IP address');
        }
        $this->IsDomain($domain);
        $this->ip = $ip;
    }

    private function IsDomain($domain)
    {
        $this->domain = str_replace( parse_url( $domain, PHP_URL_SCHEME ) . '://', '', $domain );
        $reg = "/^[\w\-]+(\.[\w\-]+)+([\w\-.,@?^=%&:\/~+#]*[\w\-@?^=%&\/~+#])?$/";
        if (!preg_match($reg,$this->domain)){
            throw new \KaywGeek\Dns\Exceptions\InvalidArgumentException('Invalid Domain');
        }
    }

    /**
     * @description  Resolve the best DNS by specifying the domain name and ip
     * @param $domain
     * @param $ip
     * @return string
     * @throws \Exception
     */

    public function ParsingDomain() : string
    {

        $longUserIp = ip2long($this->ip);
        $closest = null;
        $ip = dns_get_record($this->domain,DNS_A);
        if (empty($ip)){
            throw new \KaywGeek\Dns\Exceptions\InvalidArgumentException('DNS Parse exception');
        }
        if (!is_iterable($ip)){
            return long2ip($closest);
        }
        foreach ($ip as $item){
            $temIp = ip2long($item['ip']);
            if ($closest === null || abs($longUserIp - $closest) > abs($temIp - $longUserIp)) {
                $closest = $temIp;
            }
        }
        return long2ip($closest);
    }
}