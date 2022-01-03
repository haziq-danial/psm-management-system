<?php

namespace App\Http\Controllers;

use App\Classes\Constants\ApprovalStatus;
use App\Models\Proposal;
use App\Models\Student;
use App\Models\Title;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageTitleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $titles = Title::with(['supervisor','supervisor_detail'])->get();
        $count = 0;

        return view('ManageTitle.index', ['titles' => $titles, 'count' => $count]);
    }

    // supervisor
    public function myTitles()
    {
        $sv_id = Auth::user()->supervisor->sv_id;

        $titles = Title::where('sv_id', $sv_id)->get();
        $count = 0;

        return view('ManageTitle.myTitle',['titles' => $titles, 'count' => $count]);
    }

    public function edit($title_id)
    {
        $title = Title::where('title_id',$title_id)->first();
        return view('ManageTitle.edit',[
            'title' => $title
        ]);
    }

    public function update(Request $request, $title_id)
    {
        $title = Title::find($title_id);
        $title->psm_title = $request->psm_title;

        $title->save();

        return redirect()->route('manage-title.my-titles');
    }


    public function add(Request $request)
    {
        $title = new Title;

        $title->std_id = 0;
        $title->sv_id = Auth::user()->supervisor->sv_id;
        $title->psm_title = $request->psm_title;

        $title->save();
        $proposal = Proposal::factory()->create([
            'title_id' => $title->title_id,
            'status_approval' => ApprovalStatus::PENDING
        ]);

        return redirect()->route('manage-title.my-titles');
    }

    public function delete($title_id)
    {
        Title::find($title_id)->proposal->delete();
        Title::destroy($title_id);
        return redirect()->route('manage-title.my-titles');
    }

    public function book()
    {
        $model = Student::where('std_id', Auth::id())->with('title')->first();
        $book_status = !is_null($model->title);
        $titles = Title::where('sv_id',$model->sv_id)->with(['supervisor','supervisor_detail'])->get();
        $count = 0;

        return view('ManageTitle.book', ['titles' => $titles, 'count' => $count, 'book_status' => $book_status]);
    }

    public function bookTitle($title_id)
    {
        $title_model = Title::find($title_id)->with('student')->first();

        $title_model->std_id = Auth::id();

        $title_model->save();
        return redirect()->route('manage-title.view-book');
    }

    public function removeBook($proposal_id)
    {
        $proposal_model = Proposal::with('title')->find($proposal_id);
        $title_model = $proposal_model->title;

        $proposal_model->objective = 'none';
        $proposal_model->scope_of_project = 'none';
        $proposal_model->problem_background = 'none';
        $proposal_model->techniques = 'none';
        $proposal_model->status_approval = ApprovalStatus::PENDING;
        $title_model->std_id = 0;

        $proposal_model->save();
        $title_model->save();

        return redirect()->route('manage-title.view-book');
    }
}
