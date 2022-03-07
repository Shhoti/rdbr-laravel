<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Http\Resources\Candidate as ResourcesCandidate;
use App\Http\Resources\CandidateCollection;
use App\Models\Candidate;
use App\Models\Skill;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
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
}
