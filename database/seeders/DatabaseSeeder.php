<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Campaign;
use App\Models\Cause;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\HasMedia;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::updateOrCreate([
             'email' => 'test@test.com'
         ],[
             'name' => 'Test User',
             'email' => 'test@test.com',
             'password' => \Hash::make('password')
         ]);

         Province::updateOrCreate([
             'name' => 'Sofala'
         ],[
             'name' => 'Sofala'
         ]);

         $sofala = Province::whereName('Sofala')->first();

         District::updateOrCreate(
             ['name'=>'Beira'],[
             'name' => 'Beira',
             'province_id' => $sofala->id
         ]);
         Cause::updateOrCreate([
             'title' => 'Apoio'
         ],[
             'title' => 'Apoio',
              'description' => 'Apoio'
         ]);

         Campaign::factory(10)->create()->each(
             fn(Campaign $campaign) => $campaign->addMediaFromUrl('https://source.unsplash.com/random')
             ->toMediaCollection('images'));
    }
}
