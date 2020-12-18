<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class Filter extends TestCase
{
    /**
     * testFilter.
     *
     * @return void
     */
    public function testFilter()
    {
        $baseUrl = 'http://localhost:8000/';

        $args = 'provider=DataProviderY'; 

        $this->call('GET', $baseUrl . 'api/v1/users?'. $args)->assertStatus(200);
    }
}
