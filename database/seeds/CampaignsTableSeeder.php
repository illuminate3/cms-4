<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Campaign::class, 5)->create()->each(function($campaign) {
            for ($i = 0; $i < 10; $i++) {
                $campaign->rebuttals()->save(factory(App\Models\Rebuttal::class)->make());
                $campaign->rebuttals()->save(factory(App\Models\Promo::class)->make());
            }
        });
    }
}
