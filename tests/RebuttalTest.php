<?php

use App\Models\Rebuttal;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RebuttalTest extends TestCase
{
    use WithoutMiddleware;

    public function testGetAllRebuttals()
    {
        $response = $this->call('GET', '/rebuttals');
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content);
        $this->assertArrayHasKey('data', $content);
    }

    public function testGetRebuttal()
    {
        $response = $this->call('GET', '/rebuttals/1');
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content);
        $this->assertArrayHasKey('data', $content);
    }

    public function testCreateRebuttal()
    {
        $response = $this->call('POST', '/rebuttals', [
            'name' => 'unit test rebuttal',
            'body' => 'unit test rebuttal',
            'active' => '1',
            'campaign' => '1'
        ]);

        $content = json_decode($response->content(), true);

        $this->assertTrue($content);
    }

    public function testDeleteRebuttal()
    {
        $rebuttals = Rebuttal::where('name', 'unit test rebuttal')
            ->get();

        $rebuttals
            ->map(function($rebuttal) {
                $response = $this->call('DELETE', "/rebuttals/{$rebuttal->id}");
                $content = json_decode($response->content());
                
                $this->assertTrue($content);
            });
    }
}
