<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = \App\Options\Role::get();
        foreach($roles as $roleKey => $roleLabel){
            $role = \Spatie\Permission\Models\Role::where('name',$roleKey)->first();
            if(!$role){
                $role = \Spatie\Permission\Models\Role::create(['name' => $roleKey]);
            }
        }
        $requiredModels = 20;
        $currentModelsCount = \App\User::all()->count();
        if($currentModelsCount < $requiredModels){
            $models = factory(\App\User::class,$requiredModels)->create();
        }
        foreach($roles as $roleKey => $role){
            $email = $roleKey.'@'.$roleKey.'.com';
            $existingModel = \App\User::where('email',$email)->first();
            if(!$existingModel){
                $model = factory(\App\User::class)->create([
                    'email' => $email,
                    'password' => \Hash::make($roleKey),
                ]);
                $model->assignRole($roleKey);
            }
        }
    }
}
