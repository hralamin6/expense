<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Description;
use App\Models\Note;
use App\Models\Subject;
use App\Models\Storage;
use App\Models\Source;
use App\Models\Category;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\User::factory()->create([
//            'name'=>'admin',
//            'email'=>'admin@gmail.com',
//            'email_verified_at' => now(),
//            'password'=>Hash::make('000000')
//        ]);
        \App\Models\User::factory(1)->create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'email_verified_at' => now(),
            'password'=>Hash::make('000000')
        ])->each(function ($user){
            Category::factory(10)->create([
                'user_id' => $user->id,
            ]);
            Source::factory(10)->create([
                'user_id' => $user->id,
            ]);
            Storage::factory(10)->create([
                'user_id' => $user->id,
            ]);
            Income::factory(50)->create([
                'user_id' => $user->id,
            ]);
            Expense::factory(100)->create([
                'user_id' => $user->id,
            ]);


            // ])->each(function ($subject){
            //     Chapter::factory(8)->create([
            //         'subject_id' => $subject->id,
            //     ])->each(function ($chapter){
            //         Note::factory(5)->create([
            //             'chapter_id' => $chapter->id,
            //         ]);
            //     });
            // });
        });


//         \App\Models\Subject::factory()->insert([
//             ['name' => 'bangla', 'user_id' => 1],
//             ['name' => 'english', 'user_id' => 1],
//             ['name' => 'math', 'user_id' => 1],
//             ['name' => 'physics', 'user_id' => 1],
//             ['name' => 'chemestry', 'user_id' => 1],
//             ['name' => 'biology', 'user_id' => 1]
//         ]);
    }
}
