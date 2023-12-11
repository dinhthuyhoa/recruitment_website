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
                'password' => Hash::make('admin1'),
                'phone' => 'admin',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2001-08-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Administrator
            ],
            [
                'name' => 'Dinh Thuy Hoa',
                'email' => 'dinhthuyhoa@gmail.com',
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
                'name' => 'FPT Corporation',
                'email' => 'fptcorporation@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591661',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Viettel Group',
                'email' => 'viettel@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591662',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'VNG Corporation',
                'email' => 'vng@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591663',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'VNPT Group',
                'email' => 'vnpt@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591664',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Tiki Corporation',
                'email' => 'tiki@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591665',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Vingroup',
                'email' => 'vingroup@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591666',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'CMC Corporation',
                'email' => 'cmc@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591667',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'MobiFone Corporation',
                'email' => 'mobifone@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591668',
                'status' => 'Active',
                'gender' => '',
                'birthday' => '',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Global CyberSoft (GCS)',
                'email' => 'gcs@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591669',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '25/04/2007',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Nashtech',
                'email' => 'nashtech@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591670',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '25/04/2007',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Harvey Nash Vietnam',
                'email' => 'hnv@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591671',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '25/04/2007',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'KMS Technology',
                'email' => 'kms@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591672',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '25/04/2007',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Luxoft Vietnam',
                'email' => 'luxoft@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591673',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '25/04/2007',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'TMA Solutions',
                'email' => 'tma@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591674',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '25/04/2007',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Axon Active Vietnam',
                'email' => 'axon@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591675',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '25/04/2007',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Recruiter
            ],
            [
                'name' => 'Dinh Thuy Hoa B1910225',
                'email' => 'hoab1910225@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591598',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2001-08-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Nguyen Thuy An B1910221',
                'email' => 'anb1910221@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591591',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2001-09-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Thai Nguyen Van Nhi B1910222',
                'email' => 'nhib1910222@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591592',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2001-03-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Thai Nguyen Van Anh B1910223',
                'email' => 'anhb1910223@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591593',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2001-03-16',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Le Anh B1810235',
                'email' => 'anhb1810235@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591594',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-03-11',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Huynh Nhi B1810224',
                'email' => 'nhib1810224@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591595',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-03-22',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Thai Nguyen Van Anh B1810225',
                'email' => 'anhb1810225@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591596',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-03-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false),
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Nguyen Phuong Nhi B1810226',
                'email' => 'nhib1810226@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591597',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-03-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Huynh An B1810227',
                'email' => 'anb1810227@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591590',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-04-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Nguyen Thai Hao B1810228',
                'email' => 'haob1810228@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591599',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-04-25',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Le Van Pho B1810229',
                'email' => 'phob1810229@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591600',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-04-26',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Nguyen Thai Hao B1810230',
                'email' => 'haob1810230@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591601',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-04-27',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Dinh Thi Thuy B1810231',
                'email' => 'thuyb1810231@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591602',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-01-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'To Thai Binh B1810232',
                'email' => 'binhb1810232@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591603',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-06-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Le Khanh Bang B1810233',
                'email' => 'bangb1810233@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591604',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-08-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Nguyen Tran Gia Bao B1810234',
                'email' => 'baob1810234@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591605',
                'status' => 'Active',
                'gender' => 'Male',
                'birthday' => '2000-04-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
            [
                'name' => 'Pham Trong Phuc B1807586',
                'email' => 'phucb1807586@student.ctu.edu.vn',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'phone' => '0839591606',
                'status' => 'Active',
                'gender' => 'Female',
                'birthday' => '2000-04-23',
                'avatar' => 'avatar/' . $faker->image('public/storage/avatar', 400, 300, false), 
                'role' => UserRole::Candidate
            ],
        ]);

        // Post::factory($number_post)->create();

        // Tag::insert([
        //     [
        //         'tag_category' => 'post-recruiment',
        //         'tag_key' => 'php',
        //         'tag_name' => 'PHP'
        //     ],
        //     [
        //         'tag_category' => 'post-recruiment',
        //         'tag_key' => 'frontend-reactjs',
        //         'tag_name' => 'Frontend ReactJs'
        //     ],
        //     [
        //         'tag_category' => 'post-recruiment',
        //         'tag_key' => 'backend-dot-net',
        //         'tag_name' => 'Backend .Net'
        //     ],
        //     [
        //         'tag_category' => 'post-recruiment',
        //         'tag_key' => 'nodejs',
        //         'tag_name' => 'NodeJs'
        //     ],
        //     [
        //         'tag_category' => 'post-recruiment',
        //         'tag_key' => 'tester',
        //         'tag_name' => 'Tester'
        //     ],
        //     [
        //         'tag_category' => 'post-news',
        //         'tag_key' => 'english',
        //         'tag_name' => 'English'
        //     ],
        //     [
        //         'tag_category' => 'post-news',
        //         'tag_key' => 'job-fair',
        //         'tag_name' => 'Job Fair'
        //     ],
        //     [
        //         'tag_category' => 'post-news',
        //         'tag_key' => 'ctu',
        //         'tag_name' => 'CTU'
        //     ],
        //     [
        //         'tag_category' => 'post-news',
        //         'tag_key' => 'bussiness',
        //         'tag_name' => 'Bussiness'
        //     ],
        // ]);

        
        // PostTag::factory($number_post)->create();

        // foreach (Post::all() as $k => $v) {
        //     if ($v->post_type == PostCategory::Recruitment) {
        //         PostMeta::insert([
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'address',
        //                 'value' => VNFaker::city()
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'deadline',
        //                 'value' => $faker->dateTime()
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'vacancy',
        //                 'value' => Arr::random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'salary',
        //                 'value' => '10 000 000'
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'position',
        //                 'value' => Arr::random(['PHP Developer', 'NodeJs', '.NET', 'ReatJs', 'Wordpress'])
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'experience',
        //                 'value' => Arr::random(['0', '1 year', '3 month', '3 year', '2 year'])
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'job-nature',
        //                 'value' => Arr::random(['Part-time', 'Full-time', 'Freelancer'])
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'phone',
        //                 'value' => VNFaker::mobilephone()
        //             ],
        //             [
        //                 'post_id' => $v->id,
        //                 'key' => 'email',
        //                 'value' => VNFaker::email()
        //             ],
        //         ]);
        //     }
        // }
    }
}
