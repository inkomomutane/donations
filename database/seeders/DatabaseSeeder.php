<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Campaign;
use App\Models\Cause;
use App\Models\District;
use App\Models\Organization;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\HasMedia;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::updateOrCreate([
            'name' => 'admin'],[
            'name' => 'admin',
            ]
        );

        $superAdmin  = Role::updateOrCreate([
            'name' => 'super-admin'],[
            'name' => 'super-admin',
            ]);

         Role::updateOrCreate([
            'name' => 'normal'],[
            'name' => 'normal',
            ]);



         User::factory(15)->create()->each(fn(User $user) => $user->assignRole($superAdmin));


         $adminUser = User::updateOrCreate([
             'email' => 'itelvino@ndihpezembo.online'
         ],[
             'name' => 'Itelvino Hugo',
             'email' => 'itelvino@ndihpezembo.online',
             'password' => \Hash::make('password'),
             'organization_id' => Organization::updateOrCreate([
                 'name' => 'Conselho Municipal da Beira'
             ])->id
         ]);




         $adminUser->assignRole($superAdmin);



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

         Campaign::factory(150)->create()->each(
             fn(Campaign $campaign) => $campaign->addMediaFromUrl('http://127.0.0.1:8000/img.png')
             ->toMediaCollection('campaigns'));
    }
}
