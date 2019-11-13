<?php
declare(strict_types=1);

use JerryHopper\JamesApiClient\domain;
use JerryHopper\JamesApiClient\user;
use PHPUnit\Framework\TestCase;

final class DomainTest extends TestCase
{
    private $jamesApiUrl="http://docker:8000";
    private $jdomain;
    private $testdomainname="james.maildomaintest";

    public function setUp():void
    {
        $this->jdomain = new domain($this->jamesApiUrl);
        $this->juser  = new user($this->jamesApiUrl);
    }

    public function testCanListDomains():void
    {
        $this->jdomain->list();
        $this->assertTrue(true);
    }

    public function testCanCreateDomain(): void
    {
        $res = $this->jdomain->create($this->testdomainname);
        $this->assertTrue(true);
        /*$this->assertInstanceOf(
            Email::class,
            Email::fromString('user@example.com')
        );*/
    }


    public function testCannotCreateExistingDomain(): void
    {
        $this->expectException(\Exception::class);
        // create the domain
        $res = $this->jdomain->create($this->testdomainname);
        // create it again.
        $res = $this->jdomain->create($this->testdomainname);

    }

    public function testCanListUsers():void
    {
        //print_r($this->juser->list());

        $this->assertTrue(true);
    }
    public function testCanCreateUser(): void
    {
        $res = $this->jdomain->create($this->testdomainname);
        //print_r($res);
        sleep(1);
        $res = $this->juser->create("testuser@".$this->testdomainname,'passwordToBeUsed');
        //print_r($res);
        sleep(1);
        $this->assertEquals(204, $res->code);

    }

    public function testCannotCreateDuplicateUser(): void
    {
        $res = $this->juser->create("testuser@".$this->testdomainname,'passwordToBeUsed');
        $this->assertEquals(409, $res->code);

    }
    public function testCanDeleteUser(): void
    {
        $res = $this->juser->delete("testuser@".$this->testdomainname);
        $this->assertEquals(204, $res->code);

    }
    public function tearDown():void
    {
        // Remove the created application.
        #echo "cleaning up!";
        $res = $this->juser->delete("testuser@".$this->testdomainname);
        //print_r($res);
        $res = $this->jdomain->delete($this->testdomainname);
        #print_r($res);
    }
}