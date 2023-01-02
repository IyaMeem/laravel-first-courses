<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Review;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'hi@meem.com',
            'password' => bcrypt('Password'),
            'type' => 1,
        ]);

        $series = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'image' => 'https://laravel-courses.com/storage/series/54e8baab-727e-4593-a78a-e0c22c569b61.png'
            ],

            [
                'name' => 'PHP',
                'slug' => 'php',
                'image' => 'https://laravel-courses.com/storage/series/c9cb9b3c-4d8c-4df6-a7b7-54047ce907ad.png'
            ],

            [
                'name' => 'Livewire',
                'slug' => 'livewire',
                'image' => 'https://laravel-courses.com/storage/series/4dfa5245-e2fc-4dfe-88c9-5f001a180da6.png'
            ],

            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
                'image' => 'https://laravel-courses.com/storage/series/7d2e33b5-fcd0-4227-bce6-aa49b976bd7c.png'
            ],

            [
                'name' => 'Alpine.js',
                'slug' => 'alpinejs',
                'image' => 'https://laravel-courses.com/storage/series/fe7d56b4-906c-4970-8c69-25956acb3988.png'
            ],

            [
                'name' => 'Tailwindcss',
                'slug' => 'tailwindcss',
                'image' => 'https://laravel-courses.com/storage/series/e63d6d09-4af0-4a6d-9cee-2daf537afcc8.png'
            ]
        ];
        foreach($series as $item) {
            Series::create([                
                'name' => $item['name'],
                'image' => $item['image'],
                'slug' => $item['slug'],
            ]);
        }

        $topics = ['Eloquent', 'Validation', 'Authentication', 'Refactoring', 'Testing'];
        foreach($topics as $item) {
            $slug = strtolower(str_replace('', '_', $item));
            
            Topic::create([
                'name' => $item,
                'slug' => $slug
            ]);

        }


        $platforms = ['Laracasts', 'Youtube', 'Larajobs', 'Laravel News', 'Laracasts Forum'];
        foreach($platforms as $item) {
            Platform::create([
                'name' => $item,
            ]);

        }

        // create 10 Author
        Author::factory(10)->create();


        // create 50 users
        User::factory(50)->create();

        // create 100 courses
        Course::factory(100)->create();


        $courses = Course::all();
        foreach($courses as $course) {
            //random topics array
            $topics = Topic::all()->random(rand(1, 5))->pluck('id')->toArray();
            $course->topics()->attach($topics);

            $authors = Author::all()->random(rand(1, 3))->pluck('id')->toArray();
            $course->authors()->attach($authors);

            $series = Series::all()->random(rand(1, 4))->pluck('id')->toArray();
            $course->series()->attach($series);


            // $course->topics()->attach(Topic::all()->random(rand(1, 5)));

            // $loop = rand(1, 5);
            // for($i = 0; $i < $loop; $i++){
            //     $random_topic_id = Topic::all()->random()->id;
            //     if($course->topics->contains(random_topic_id)){
            //         $course->topics()->attach(random_topic_id);
            //     }
            // }

        }

        // create 100 Review
        Review::factory(100)->create();

    }
}
