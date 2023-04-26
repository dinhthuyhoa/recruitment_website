<?php

namespace Database\Seeders;

use App\Enums\PostCategory;
use App\Enums\UserRole;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();
        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'phamle21@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                // password
                'phone' => '0941649826',
                'status' => 'Active',
                'gender' => 'Male',
                'role' => UserRole::Administrator
            ],
            [
                'name' => 'Đinh Thùy Hoa',
                'email' => 'thuyhoa@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123132'),
                // password
                'phone' => '09416498225',
                'status' => 'Active',
                'gender' => 'Female',
                'role' => UserRole::SubAdmin
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                // password
                'phone' => '0941649825',
                'status' => 'Active',
                'gender' => 'Male',
                'role' => UserRole::Candidate
            ]
        ]);

        Post::factory(10)->create();
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

        PostTag::factory(10)->create();

        foreach (Post::all() as $k => $v) {
            if ($v->post_type == PostCategory::Recruitment) {
                PostMeta::insert([
                    [
                        'post_id' => $v->id,
                        'key' => 'address',
                        'value' => ''
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'deadline',
                        'value' => ''
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'vacancy',
                        'value' => ''
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'salary',
                        'value' => ''
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'position',
                        'value' => ''
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'experience',
                        'value' => ''
                    ],
                    [
                        'post_id' => $v->id,
                        'key' => 'job-nature',
                        'value' => ''
                    ],
                ]);
            }
        }
    }
}
