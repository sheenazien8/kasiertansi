<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));
        $faker = Faker\Factory::create();

        foreach ($config as $key => $modules) {
            // dump($key, $modules);
            // Create a new role
            $role = \App\Models\Role::create([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {
                foreach (explode(',', $value) as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Models\Permission::firstOrCreate([
                        'name' => $permissionValue . '-' . $module,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            $this->command->info("Creating '{$key}' user");

            // Create default user for each role
            $user = \App\Models\User::make([
                'email' => $key . '@example.com',
                'password' => bcrypt('12345678'),
            ]);
            $user->unsetEventDispatcher();
            // $key != 'owner' ? new \App\Models\Employee() :
            $userable = new \App\Models\Owner();
            $userable->name = ucwords(str_replace('_', ' ', $key));
            $carbon = Carbon\Carbon::now();
            $userable->join_date = $carbon->format('Y-m-d');
            // if (get_class($userable) == \App\Models\Employee::class) {
            //     $userable->owner()->associate(\App\Models\Owner::first());
            // }
            // $userable->user()->associate($user);
            $userable->save();
            $user->userable()->associate($userable);
            $user->save();
            $user->attachRole($role);
        }

        // Creating user with permissions
        if (!empty($userPermission)) {
            dd($userPermission);
            foreach ($userPermission as $key => $modules) {
                foreach ($modules as $module => $value) {

                    // Create default user for each permission set
                    $user = \App\Models\User::create([
                        'name' => ucwords(str_replace('_', ' ', $key)),
                        'email' => $key.'@example.com',
                        'password' => bcrypt('12345678'),
                        'remember_token' => str_random(10),
                    ]);
                    $permissions = [];

                    foreach (explode(',', $value) as $p => $perm) {
                        $permissionValue = $mapPermission->get($perm);

                        $permissions[] = \App\Models\Permission::firstOrCreate([
                            'name' => $permissionValue . '-' . $module,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ])->id;

                        $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                    }
                }

                // Attach all permissions to the user
                $user->permissions()->sync($permissions);
            }
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\Models\User::truncate();
        \App\Models\Role::truncate();
        \App\Models\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
