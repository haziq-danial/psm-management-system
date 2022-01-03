<?php

namespace Database\Seeders;

use App\Classes\Constants\ApprovalStatus;
use App\Models\Proposal;
use App\Models\Supervisor;
use App\Models\Title;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = Title::factory()->count(5)->create();
        $proposals = Proposal::factory()->count(5)->create([
            'status_approval' => ApprovalStatus::PENDING
        ]);
        $supervisors = Supervisor::all();

        foreach ($titles as $title) {
            $title->sv_id = $supervisors->find($title->title_id)->sv_id;
            $title->save();
        }

        foreach ($proposals as $proposal) {
            $proposal->title_id = $titles->find($proposal->proposal_id)->title_id;
            $proposal->save();
        }


    }
}
