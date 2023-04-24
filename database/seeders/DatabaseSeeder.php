<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public $users, $passwords, $names, $emails;

    public function run()
    {
        if (app()->environment('local')) {
            $this->users = \App\Models\User::factory(10)->create();
            $this->names = $this->users->pluck('name')->toArray();
            $this->emails = $this->users->pluck('email')->toArray();
            \App\Models\Restaurant::factory(10)->create();
            // dd($this->names, $this->emails);
        }

        if (app()->environment('production')) {
            // Cottage, Wawa, Kalinchowk, Naan, Burger Club, Syanko
//            \App\Models\Restaurant::insert([[
//                    'name' => 'Cottage',
//                    'phone' => '',
//                    'created_at' => now(),
//                    'updated_at' => now()
//                ], [
//                    'name' => 'Wawa',
//                    'phone' => '',
//                    'created_at' => now(),
//                    'updated_at' => now()
//                ], [
//                    'name' => 'Kalinchowk',
//                    'phone' => '',
//                    'created_at' => now(),
//                    'updated_at' => now()
//                ], [
//                    'name' => 'Naan',
//                    'phone' => '',
//                    'created_at' => now(),
//                    'updated_at' => now()
//                ], [
//                    'name' => 'Burger Club',
//                    'phone' => '',
//                    'created_at' => now(),
//                    'updated_at' => now()
//                ], [
//                    'name' => 'Syanko',
//                    'phone' => '',
//                    'created_at' => now(),
//                    'updated_at' => now()
//                ]
//            ]);

            /**
             * Labham Ronier : labhamrauniyar@gmail.com : labham : Labham@123
             * Aditi Tamrakar : tamrakaraditi16@gmail.com : aditi : Aditi@123
             * Pratit Shrestha : pratitstha667@gmail.com : pratit : Pratit@123
             * Utsav Shrestha : aavesh1234@gmail.com : utsav : Utsav@123
             * Aaryan Poudel : aaryan.poudel1@gmail.com : aaryan : Aaryan@123
             * Anushka Shrestha : shresthaanushka105@gmail.com : anushka : Anushka@123
             * Riyaz KC : riyazkc98@gmail.com : riyaz : Riyaz@123
             */
            $this->users = [
                [
                    "name" => "Achyut Neupane",
                    "email" => "achyutkneupane@gmail.com",
                    "username" => "achyut",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Labham Ronier",
                    "email" => "labhamrauniyar@gmail.com",
                    "username" => "labham",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Aditi Tamrakar",
                    "email" => "tamrakaraditi16@gmail.com",
                    "username" => "aditi"
                ],
                [
                    "name" => "Pratit Shrestha",
                    "email" => "pratitstha667@gmail.com",
                    "username" => "pratit",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Utsav Shrestha",
                    "email" => "aavesh1234@gmail.com",
                    "username" => "utsav",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Aaryan Poudel",
                    "email" => "aaryan.poudel1@gmail.com",
                    "username" => "aaryan",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
//                [
//                    "name" => "Anushka Shrestha",
//                    "email" => "shresthaanushka105@gmail.com",
//                    "password" => Hash::make("password"),
//                    "username" => "anushka",
//                    "status" => false,
//                    "created_at" => now(),
//                    "updated_at" => now()
//                ],
//                [
//                    "name" => "Riyaz KC",
//                    "email" => "riyazkc98@gmail.com",
//                    "password" => Hash::make("password"),
//                    "username" => "riyaz",
//                    "created_at" => now(),
//                    "updated_at" => now()
//                ],
                [
                    "name" => "Dipesh Khanal",
                    "email" => "dipeshkhanal79@gmail.com",
                    "username" => "dipesh",
                ],
                [
                    "name" => "Subani Amatya",
                    "email" => "subaniwork00@gmail.com",
                    "username" => "subani",
                ],
                [
                    "name" => "Pranish Shakya",
                    "email" => "ppranish1998@gmail.com",
                    "username" => "pranish",
                ],
                [
                    "name" => "Geeta Ojha",
                    "email" => "grisaojha21@gmail.com",
                    "username" => "geeta"
                ],
                [
                    "name" => "Madhavi Neupane",
                    "email" => "neupanem206@gmail.com",
                    "username" => "madhavi",
                ],
                [
                    "name" => "Roshan Shrestha",
                    "email" => "hello@theroshan.com",
                    "username" => "roshan",
                ],
                [
                    "name" => "Tshitiz Rajkarnikar",
                    "email" => "tshitiz@25hours.live",
                    "username" => "tshitiz",
                ]
            ];
        }

        // Mail::to('')
        foreach ($this->users as $key => $item) {
            $item['password'] = Hash::make('password');
            User::firstOrCreate($item);
//            Mail::to($this->emails[$key],$name)->send(new UserCreated($name, $this->emails[$key], $this->passwords[$key] ?? 'password'));
            Mail::to($item['email'], $item['name'])->queue(new UserCreated($item['name'], $item['email'], 'password'));
        }
        // dd($users);

//        add admin role
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        User::where('username', 'achyut')->first()->assignRole('admin');
        User::where('username', 'aaryan')->first()->assignRole('admin');
    }
}
