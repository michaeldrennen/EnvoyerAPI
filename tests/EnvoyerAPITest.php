<?php
namespace MichaelDrennen\EnvoyerAPI\Tests;

use MichaelDrennen\EnvoyerAPI\Envoyer;
use PHPUnit\Framework\TestCase;


class EnvoyerAPITest extends TestCase {


    protected $envoyer;
    protected $projectId;

    protected function setUp(): void
    {
        $this->envoyer = new Envoyer(getenv('API_KEY'));
        $this->projectId = getenv('PROJECT_ID');
    }


    /**
     * @test
     */
    public function projectsShouldReturnProjects() {
        $projects = $this->envoyer->projects();
        $this->assertIsArray($projects);
    }


    /**
     * @test
     */
    public function environmentsShouldReturnEnvironment() {
        //$environment = $this->envoyer->environment($this->projectId);
        //$this->assertIsArray($environment);
    }


    /**
     * @test
     */
    public function heartbeatsShouldReturnHeartbeats(){
        $heartbeats = $this->envoyer->heartbeats($this->projectId);
        print_r($heartbeats);
    }





}