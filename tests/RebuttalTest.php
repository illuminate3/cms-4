<?php

use App\Models\Rebuttal;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RebuttalTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Test to get all rebuttals
     *
     * @return void
     */
    public function testGetAllRebuttals()
    {
        $response = $this->call('GET', '/rebuttals/all');

        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content);
        $this->assertArrayHasKey('data', $content);
    }

    /**
     * Test to get a specific rebuttal
     *
     * @return void
     */
    public function testGetRebuttal()
    {
        $response = $this->call('GET', '/rebuttals/1');

        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content);
        $this->assertArrayHasKey('data', $content);
    }

    /**
     * Test to create a new rebuttal
     *
     * @return void
     */
    public function testCreateRebuttal()
    {
        $response = $this->call('POST', '/rebuttals/create', [
            'name' => 'unit test rebuttal',
            'body' => 'unit test rebuttal',
            'active' => '1',
            'campaign' => '1'
        ]);

        $content = json_decode($response->content(), true);

        $this->assertTrue($content);
    }

    /**
     * Test deleting a rebuttal
     *
     * @return void
     */
    public function testDeleteRebuttal()
    {
        $rebuttals = Rebuttal::where('name', 'unit test rebuttal')
            ->get();

        collect($rebuttals)
            ->map(function($rebuttal) {
                $response = $this->call('DELETE', "/rebuttals/{$rebuttal->id}");
                $content = json_decode($response->content());
                $this->assertTrue($content);
            });
    }
}
