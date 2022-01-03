<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Title;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function viewAll()
    {
        $title = null;
        $user = Auth::user();
        if ($user->hasRole('coordinator')) {
            $title = Title::with('proposal','student')->get();

        } elseif ($user->hasRole('supervisor')) {
            $title = Title::where('sv_id',$user->supervisor->sv_id)->with('proposal','student')->get();

        } else {
            dd('error');
        }
        $count = 0;
        return view('ManageProposal.view-all', ['titles' => $title, 'count' => $count]);
    }

    public function viewOne()
    {
        $user = Auth::user();
        $student = $user->student;
        $title_model = $student->title;

        if (!is_null($title_model)) {
            $proposal_model = $title_model->proposal;
            return view('ManageProposal.detail',[
                'title' => $title_model->psm_title,
                'proposal' => $proposal_model,
                'proposal_id' => $proposal_model->proposal_id
            ]);
        } else {
            return view('ManageProposal.blank');
        }
    }

    public function detail($proposal_id)
    {
        $proposal = Proposal::with('title')->find($proposal_id);
        $title = $proposal->title->psm_title;
        return view('ManageProposal.detail',[
            'title' => $title,
            'proposal' => $proposal,
            'proposal_id' => $proposal_id
        ]);
    }

    public function edit($proposal_id)
    {
        $proposal = Proposal::with('title')->find($proposal_id);
        $title = $proposal->title;
        return view('ManageProposal.edit', [
            'proposal_id' => $proposal_id,
            'title' => $title,
            'proposal' => $proposal
        ]);
    }

    public function update(Request $request, $proposal_id)
    {
        $proposal = Proposal::with('title')->find($proposal_id);
        $title = $proposal->title;

        $proposal->update($request->except('psm_title'));
        $title->update($request->only('psm_title'));

        return redirect()->route('manage-proposal.detail',$proposal_id);
    }

    public function setApproval(Request $request, $proposal_id)
    {
        $user = Auth::user();
        $proposal = Proposal::with('title')->find($proposal_id);
        $title = $proposal->title;

        if ($user->can('set approval proposal')) {
            $proposal->status_approval = $request->status_approval;
            $proposal->save();
        }

        return redirect()->route('manage-proposal.detail',$proposal_id);
    }

}
