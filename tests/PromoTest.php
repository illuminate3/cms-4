<?php

use App\Models\Promo;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PromoTest extends TestCase
{
    use WithoutMiddleware;

    public function testGetAllPromos()
    {
        $response = $this->call('GET', '/promos');
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content['data']);
    }

    public function testCreatePromo()
    {
        $response = $this->call('POST', '/promos', [
            'campaign' => '1',
            'active' => '1',
            'name' => 'test promo',
            'body' => 'test promo'
        ]);

        $content = json_decode($response->content(), true);

        $this->assertTrue($content);
    }

    public function testGetPromo()
    {
        $promo = Promo::take(1)->first();

        $response = $this->call('GET', '/promos/' . $promo->id);
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content['data']);
    }

    public function testDeletePromo()
    {
        $promos = Promo::where('name', 'test promo')
            ->get();

        $promos
            ->map(function($promo) {
                $response = $this->call('DELETE', '/promos/' . $promo->id);
                $content = json_decode($response->content(), true);
                
                $this->assertTrue($content);
            });
    }
}
