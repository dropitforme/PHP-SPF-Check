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

    public function testResolveA()
    {

        $dnsRecordGetter = new DNSRecordGetterDirect();

        $result = $dnsRecordGetter->resolveA('google.com', true);
        $this->assertContains('74.125.196.139', $result);
        $this->assertNotContains('::12', $result);

        /*
         * Google responds with different ip6 data, so really not a good test case.
         *
        $result = $dnsRecordGetter->resolveA('google.com', false);
        $this->assertContains('74.125.196.139', $result);
        $this->assertContains('2607:f8b0:4002:c07::8a', $result);
        */
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
