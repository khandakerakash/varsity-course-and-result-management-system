<?php

use App\Course;
use App\Department;
use App\Designation;
use App\Semester;
use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        DB::statement('SET FOREIGN_KEY_CHECKS=0');
//
//        $table = [
//            'users', 'departments', 'semesters', 'courses', 'designations', 'teachers', 'course_assign_teachers',
//        ];
//
//        foreach ($table as $item){
//
//            DB::table($item)->truncate();
//        }
//
//        DB::statement('SET FOREIGN_KEY_CHECKS=1');
//
//        factory(User::class, 2)->create();

//        factory(Department::class, 10)->create();
//
//        for ($i = 1; $i <= 8; $i++) {
//            factory(Semester::class)->create([
//                'title' => sprintf("Semester-%02d", $i),
//            ]);
//        }
//
//        factory(Course::class, 100)->create();
//
//        factory(Designation::class, 5)->create();
//
//        factory(Teacher::class, 10)->create();

    }
}
