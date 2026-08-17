<?php

namespace App\Http\Controllers;

use App\Models\EvaluationCommittee;
use App\Models\ScholarshipProgram;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EvaluationCommitteeController extends Controller
{
    public function index()
    {
        $committees = EvaluationCommittee::with('scholarshipProgram')
            ->latest()
            ->get();

        return view('evaluation_committees.index', compact('committees'));
    }

    public function create()
    {
        $programs = ScholarshipProgram::latest()->get();

        return view('evaluation_committees.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'scholarship_program_id' => [
                'required',
                'exists:scholarship_programs,id',
                Rule::unique('evaluation_committees', 'committee_name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'scholarship_program_id',
                            $request->scholarship_program_id
                        );
                    }),
            ],
            'committee_name' => [
                'required',
                'string',
                'max:255',
            ],
            'chairman' => [
                'required',
                'string',
                'max:255',
            ],
            'decision_date' => [
                'required',
                'date',
            ],
            'status' => [
                'required',
                'in:active,closed',
            ],
        ]);

        EvaluationCommittee::create($data);

        return redirect()
            ->route('evaluation-committees.index')
            ->with('success', 'Thêm hội đồng xét duyệt thành công.');
    }

    public function show(EvaluationCommittee $evaluationCommittee)
    {
        $evaluationCommittee->load('scholarshipProgram');

        return view(
            'evaluation_committees.show',
            compact('evaluationCommittee')
        );
    }

    public function edit(EvaluationCommittee $evaluationCommittee)
    {
        $programs = ScholarshipProgram::latest()->get();

        return view(
            'evaluation_committees.edit',
            compact('evaluationCommittee', 'programs')
        );
    }

    public function update(
        Request $request,
        EvaluationCommittee $evaluationCommittee
    ) {
        $data = $request->validate([
            'scholarship_program_id' => [
                'required',
                'exists:scholarship_programs,id',
                Rule::unique('evaluation_committees', 'committee_name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'scholarship_program_id',
                            $request->scholarship_program_id
                        );
                    })
                    ->ignore($evaluationCommittee->id),
            ],
            'committee_name' => [
                'required',
                'string',
                'max:255',
            ],
            'chairman' => [
                'required',
                'string',
                'max:255',
            ],
            'decision_date' => [
                'required',
                'date',
            ],
            'status' => [
                'required',
                'in:active,closed',
            ],
        ]);

        $evaluationCommittee->update($data);

        return redirect()
            ->route('evaluation-committees.index')
            ->with('success', 'Cập nhật hội đồng xét duyệt thành công.');
    }

    public function destroy(EvaluationCommittee $evaluationCommittee)
    {
        $evaluationCommittee->delete();

        return redirect()
            ->route('evaluation-committees.index')
            ->with('success', 'Xóa hội đồng xét duyệt thành công.');
    }
}