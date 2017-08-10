<?php
/**
 * DNSRecordGetterDirectTest - phpUnit Test
 *
 * @author    Brian Tafoya <btafoya@briantafoya.com>
 */

namespace Mika56\SPFCheck;


class DNSRecordGetterDirectTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSPFRecordForDomain()
    {

        $dnsRecordGetter = new DNSRecordGetterDirect();

        $result = $dnsRecordGetter->getSPFRecordForDomain('google.com');
        $this->assertCount(1, $result);
        $this->assertContains('v=spf1 include:_spf.google.com ~all', $result);

        $result = $dnsRecordGetter->getSPFRecordForDomain('doesnotexistgoogle.com');
        $this->assertEmpty($result);
    }

    public function testResolveMx()
    {


        $dnsRecordGetter = new DNSRecordGetterDirect();

        $result = $dnsRecordGetter->resolveMx('google.com');
        $this->assertCount(5, $result);
        $this->assertContains('alt3.aspmx.l.google.com', $result);

        $result = $dnsRecordGetter->resolveMx('example2.com');
        $this->assertCount(0, $result);
    }
}
