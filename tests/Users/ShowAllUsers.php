<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ShowAllUsers extends TestCase
{
    /**
     * testShow.
     *
     * @return void
     */
    public function testShow()
    {
        $baseUrl = 'http://localhost:8000/';
         
        $this->call('GET', $baseUrl. 'api/v1/users')->assertStatus(200);
    }
}
