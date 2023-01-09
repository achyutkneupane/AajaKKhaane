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
            \App\Models\Restaurant::insert([[
                    'name' => 'Cottage',
                    'phone' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => 'Wawa',
                    'phone' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => 'Kalinchowk',
                    'phone' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => 'Naan',
                    'phone' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => 'Burger Club',
                    'phone' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => 'Syanko',
                    'phone' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);

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
                    "password" => Hash::make("Ghost0vperditi0n"),
                    "username" => "achyut",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Labham Ronier",
                    "email" => "labhamrauniyar@gmail.com",
                    "password" => Hash::make("Labham@123"),
                    "username" => "labham",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Aditi Tamrakar",
                    "email" => "tamrakaraditi16@gmail.com",
                    "password" => Hash::make("Aditi@123"),
                    "username" => "aditi",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Pratit Shrestha",
                    "email" => "pratitstha667@gmail.com",
                    "password" => Hash::make("Pratit@123"),
                    "username" => "pratit",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Utsav Shrestha",
                    "email" => "aavesh1234@gmail.com",
                    "password" => Hash::make("Utsav@123"),
                    "username" => "utsav",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Aaryan Poudel",
                    "email" => "aaryan.poudel1@gmail.com",
                    "password" => Hash::make("Aaryan@123"),
                    "username" => "aaryan",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Anushka Shrestha",
                    "email" => "shresthaanushka105@gmail.com",
                    "password" => Hash::make("Anushka@123"),
                    "username" => "anushka",
                    "status" => false,
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "name" => "Riyaz KC",
                    "email" => "riyazkc98@gmail.com",
                    "password" => Hash::make("Riyaz@123"),
                    "username" => "riyaz",
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            ];

            \App\Models\User::insert($this->users);


            $this->passwords = ['You know','Labham@123', 'Aditi@123', 'Pratit@123', 'Utsav@123', 'Aaryan@123', 'Anushka@123', 'Riyaz@123'];
            $this->emails = ['achyutkneupane@gmail.com','labhamrauniyar@gmail.com','tamrakaraditi16@gmail.com','pratitstha667@gmail.com','aavesh1234@gmail.com','aaryan.poudel1@gmail.com','shresthaanushka105@gmail.com','riyazkc98@gmail.com'];
            $this->names = ['Achyut Neupane','Labham Ronier','Aditi Tamrakar','Pratit Shrestha','Utsav Shrestha','Aaryan Poudel','Anushka Shrestha','Riyaz KC'];
        }

        // Mail::to('')
        foreach ($this->names as $key => $name) {
            Mail::to($this->emails[$key],$name)->send(new UserCreated($name, $this->emails[$key], $this->passwords[$key] ?? 'password'));
        }
        // dd($users);
        



    }
}
