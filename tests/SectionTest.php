<?php

use App\Models\Section;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SectionTest extends TestCase
{
    use WithoutMiddleware;

    public function testGetSections()
    {
        $response = $this->call('GET', '/sections');
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content['data']);
    }

    public function testGetSection()
    {
        $section = Section::take(1)->first();

        $response = $this->call('GET', '/sections/' . $section->id);
        $content = json_decode($response->content(), true);

        $this->assertNotEmpty($content['data']);
    }

    public function testCreateSection()
    {
        $response = $this->call('POST', '/sections', [
            'name' => 'test section',
            'description' => 'test section',
            'content' => 'test section'
        ]);

        $content = json_decode($response->content(), true);

        $this->assertTrue($content);
    }

    public function testDeleteSection()
    {
        $sections = Section::where('name', 'test section')->get();

        $sections
            ->map(function($section) {
                $response = $this->call('DELETE', '/sections/' . $section->id);
                $content = json_decode($response->content(), true);

                $this->assertTrue($content);
            });
    }
}
