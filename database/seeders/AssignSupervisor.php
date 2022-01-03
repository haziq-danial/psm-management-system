<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class AssignSupervisor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $student->sv_id = Supervisor::find($student->std_id)->sv_id;
            $student->save();
        }
    }
}
