<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Http\Resources\Candidate as ResourcesCandidate;
use App\Http\Resources\CandidateCollection;
use App\Models\Candidate;
use App\Models\Comment;
use App\Models\Skill;
use App\Models\StatusHistory;
use BenSampo\Enum\Rules\Enum;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum as RulesEnum;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Candidate::query();
        if($request->has('status'))
        {
            $query->whereHas('status',function($statusRelationshipQuery) use ($request) {
                $statusRelationshipQuery->where('status',Status::coerce($request->get('status')));
            });
        }

        return new CandidateCollection($query->paginate(4));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCandidateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCandidateRequest $request)
    {
        $candidate = Candidate::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'position' => $request->input('position'),
            'min_salary' => $request->input('min_salary'),
            'max_salary' => $request->input('max_salary'),
            'linkedin_url' => $request->input('linkedin_url'),
        ]);

        if ($request->input('skills')) {
            $this->addSkills($request->input('skills'), $candidate);
        }

        if($request->file('cv'))
        {
            $candidate->addMediaFromRequest('cv')
                    ->toMediaCollection('cv');
        }

        return new ResourcesCandidate($candidate);
    }


    public function changeStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'status' => [new  EnumValue(Status::class)],
            'comment' => 'nullable|string'
        ]);
        $statusHistory = StatusHistory::create([
            'status' => Status::coerce($request->input('status')),
            'candidate_id' => $candidate->id,
        ]);

        if($request->has('comment'))
        {
            $this->addComment($request->get('comment'), $statusHistory);
        }

        return new ResourcesCandidate($candidate);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        return new ResourcesCandidate($candidate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCandidateRequest  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }


    private function addSkills(array $skills, Candidate $candidate)
    {
        $candidate->skills()->saveMany(collect($skills)->map(fn ($skill) => new Skill([
            'title' => $skill
        ])));
    }

    private function addComment(String $com, StatusHistory $statusHistory)
    {
            Comment::create([
                'text' => $com,
                'status_history_id' => $statusHistory->id,
            ]);
    }
}
