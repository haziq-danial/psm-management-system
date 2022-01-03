<?php

namespace Database\Seeders;

use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = User::factory()->count(5)->student()->create();
        $supervisors = User::factory()->count(5)->supervisor()->create();
        $coordinators = User::factory()->count(2)->coordinator()->create();
        $technicians = User::factory()->count(2)->technician()->create();

        foreach ($students as $student) {
            Student::factory()->create([
                'user_id' => $student->user_id,
                'matric_no' => $student->username
            ]);
            $student->assignRole('student');
        }
        foreach ($supervisors as $supervisor) {
            Supervisor::factory()->create([
                'user_id' => $supervisor->user_id,
                'staff_id' => $supervisor->username
            ]);
            $supervisor->assignRole('supervisor');
        }
        foreach ($coordinators as $coordinator) {
            Coordinator::factory()->create([
                'user_id' => $coordinator->user_id,
                'staff_id' => $coordinator->username
            ]);
            $coordinator->assignRole('coordinator');
        }
        foreach ($technicians as $technician) {
            Technician::factory()->create([
                'user_id' => $technician->user_id,
                'staff_id' => $technician->username
            ]);
            $technician->assignRole('technician');
        }

    }
}
