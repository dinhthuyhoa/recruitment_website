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
use Buihuycuong\Vnfaker\VNFaker;

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
        $number_post = 50;
        /** =============================================================== */

        // Storage::makeDirectory('avatar');
        // Storage::makeDirectory('post');
        // Storage::makeDirectory('apply_attachment');
        // Storage::makeDirectory('ckeditor-media');

        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'phone' => 'admin',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2001-08-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Administrator
            ],
            [
                'name' => 'Đinh Thùy Hoa',
                'email' => 'dinhthuyhoa61@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => 'sub-admin',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2001-08-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::SubAdmin
            ],
            [
                'name' => VNFaker::company(),
                'email' => 'recruiter@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0965070061',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '1988-04-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => VNFaker::company(),
                'email' => 'recruiter123@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0909999999',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '1997-12-11',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => VNFaker::company(),
                'email' => 'recruiter456@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0909999998',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '1999-10-12',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Nguyen Van A',
                'email' => 'a@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0965070062',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2001-08-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Nguyen Thi C',
                'email' => 'c@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0965070063',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2001-08-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Nguyen Thi D',
                'email' => 'd@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0965070064',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2002-10-02',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
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
                'tag_name' => 'Tester'
            ],
            [
                'tag_category' => 'post-news',
                'tag_key' => 'english',
                'tag_name' => 'English'
            ],
            [
                'tag_category' => 'post-news',
                'tag_key' => 'job-fair',
                'tag_name' => 'Job Fair'
            ],
            [
                'tag_category' => 'post-news',
                'tag_key' => 'ctu',
                'tag_name' => 'CTU'
            ],
            [
                'tag_category' => 'post-news',
                'tag_key' => 'bussiness',
                'tag_name' => 'Bussiness'
            ],
        ]);

        PostTag::factory($number_post)->create();

        foreach (Post::all() as $k => $v) {
            if ($v->post_type == PostCategory::Recruitment) {
                PostMeta::insert([
                    [
                        'post_id' => $v->id,
                        'key' => 'address',
                        'value' => VNFaker::city()
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
                        'value' => VNFaker::mobilephone()
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'email',
                        'value' => VNFaker::email()
                    ],
                ]);
            }
        }
    }
}
