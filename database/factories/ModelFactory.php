<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Course;
use App\Department;
use App\Designation;
use App\Semester;
use App\Teacher;

$departmentIds = Department::all()->pluck('id')->toArray();
$semesterIds = Semester::all()->pluck('id')->toArray();
$designationIds = Designation::all()->pluck('id')->toArray();

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Department::class, function (Faker\Generator $faker) {
//
    $faker->addProvider(new \Faker\Provider\fr_FR\Address($faker));
    return [
        'code' => $faker->unique()->departmentNumber,
        'name' => $faker->unique()->departmentName,
    ];
});

$factory->define(Semester::class, function (Faker\Generator $faker) {

    static $title;
    return [
        'title' => $title
    ];
});

$factory->define(Course::class, function (Faker\Generator $faker) use($departmentIds,$semesterIds){

    return [
        'code' => $faker->unique()->name,
        'name' => $faker->unique()->name,
        'department_id' => $faker->randomElement($departmentIds),
        'description' =>$faker->text(),
        'semester_id' => $faker->randomElement($semesterIds),
        'credit' => $faker->randomFloat(2, .5,5),

    ];
});

$factory->define(Designation::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence(2)
    ];
});

$factory->define(Teacher::class, function (Faker\Generator $faker) use($designationIds,$departmentIds){

    return [
        'name' => $faker->name,
        'address' =>$faker->address,
        'email' => $faker->unique()->safeEmail,
        'contact_no' =>$faker->phoneNumber,
        'designation_id' => $faker->randomElement($designationIds),
        'department_id' => $faker->randomElement($departmentIds),
        'credit' =>$faker->numberBetween(10,40),

    ];
});

