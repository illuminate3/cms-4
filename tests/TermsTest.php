<?php

use App\Models\Terms;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TermsTest extends TestCase
{
    use WithoutMiddleware;

    public function testGetAllTerms()
    {
        $response = $this->call('GET', '/terms');
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content['data']);
    }

    public function testGetTerms()
    {
        $terms = Terms::take(1)->first();

        $response = $this->call('GET', '/terms/' . $terms->id);
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content['data']);
    }

    public function testCreateTerms()
    {
        $response = $this->call('POST', '/terms', [
            'active' => '1',
            'name' => 'test terms',
            'description' => 'test terms',
            'type' => 'test',
            'pattern' => '1-2-3-4-5'
        ]);

        $content = json_decode($response->content(), true);

        $this->assertTrue($content);
    }

    public function testDeleteTerms()
    {
        $terms = Terms::where('name', 'test terms')
            ->get();

        $terms
            ->map(function($term) {
                $response = $this->call('DELETE', '/terms/' . $term->id);
                $content = json_decode($response->content(), true);

                $this->assertTrue($content);
            });
    }
}
