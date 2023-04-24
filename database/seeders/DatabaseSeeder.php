<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Mail\UserCreated;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
                    "password" => Hash::make("password"),
                    "username" => "achyut",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Labham Ronier",
                    "email" => "labhamrauniyar@gmail.com",
                    "password" => Hash::make("password"),
                    "username" => "labham",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Aditi Tamrakar",
                    "email" => "tamrakaraditi16@gmail.com",
                    "password" => Hash::make("password"),
                    "username" => "aditi",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Pratit Shrestha",
                    "email" => "pratitstha667@gmail.com",
                    "password" => Hash::make("password"),
                    "username" => "pratit",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Utsav Shrestha",
                    "email" => "aavesh1234@gmail.com",
                    "password" => Hash::make("password"),
                    "username" => "utsav",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Aaryan Poudel",
                    "email" => "aaryan.poudel1@gmail.com",
                    "password" => Hash::make("password"),
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
                    "password" => Hash::make("password"),
                    "username" => "dipesh",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Subani Amatya",
                    "email" => "subaniwork00@gmail.com",
                    "password" => Hash::make("password"),
                    "username" => "subani",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Pranish Shakya",
                    "email" => "ppranish1998@gmail.com",
                    "password" => Hash::make("password"),
                    "username" => "pranish",
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            ];

            \App\Models\User::insert($this->users);
        }

        // Mail::to('')
        foreach ($this->users as $key => $name) {
//            Mail::to($this->emails[$key],$name)->send(new UserCreated($name, $this->emails[$key], $this->passwords[$key] ?? 'password'));
            Mail::to($name['email'], $name['name'])->queue(new UserCreated($name['name'], $name['email'], 'password'));
        }
        // dd($users);




    }
}
