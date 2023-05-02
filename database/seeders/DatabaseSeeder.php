<?php

namespace Database\Seeders;

use App\Enums\PostCategory;
use App\Enums\UserRole;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
use Arr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        /** ========================= SETTING ============================ */
        $number_post = 100;
        /** =============================================================== */

        Storage::makeDirectory('avatar');
        Storage::makeDirectory('post');

        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                // password
                'phone' => '0941649826',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-04-21',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Administrator
            ],
            [
                'name' => 'Đinh Thùy Hoa',
                'email' => 'sub-admin',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                // password
                'phone' => '09416498225',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-04-21',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::SubAdmin
            ],
            [
                'name' => 'Recruiter',
                'email' => 'recruiter@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                // password
                'phone' => '0941649825',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-04-21',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                // password
                'phone' => '0941649823',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-04-21',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ]
        ]);

        Post::factory($number_post)->create();

        Tag::insert([
            [
                'tag_category' => 'post-recruiment',
                'tag_key' => 'php',
                'tag_name' => 'PHP'
            ],
            [
                'tag_category' => 'post-recruiment',
                'tag_key' => 'frontend-reactjs',
                'tag_name' => 'Frontend ReactJs'
            ],
            [
                'tag_category' => 'post-recruiment',
                'tag_key' => 'backend-dot-net',
                'tag_name' => 'Backend .Net'
            ],
            [
                'tag_category' => 'post-recruiment',
                'tag_key' => 'nodejs',
                'tag_name' => 'NodeJs'
            ],
            [
                'tag_category' => 'post-recruiment',
                'tag_key' => 'tester',
                'tag_name' => 'Teser'
            ],
        ]);

        PostTag::factory($number_post)->create();

        foreach (Post::all() as $k => $v) {
            if ($v->post_type == PostCategory::Recruitment) {
                PostMeta::insert([
                    [
                        'post_id' => $v->id,
                        'key' => 'address',
                        'value' => Arr::random(['Can Tho', 'HCM'])
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'deadline',
                        'value' => $faker->dateTime()
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'vacancy',
                        'value' => Arr::random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'salary',
                        'value' => '10 000 000'
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'position',
                        'value' => Arr::random(['PHP Developer', 'NodeJs', '.NET', 'ReatJs', 'Wordpress'])
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'experience',
                        'value' => Arr::random(['0', '1 year', '3 month', '3 year', '2 year'])
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'job-nature',
                        'value' => Arr::random(['Part-time', 'Full-time', 'Freelancer'])
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'phone',
                        'value' => $faker->phoneNumber()
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'email',
                        'value' => $faker->email()
                    ],
                ]);
            }
        }
    }
}
