<?php

namespace App\Observers;

use App\Enums\Status;
use App\Models\Candidate;
use App\Models\StatusHistory;

class CandidateObserver
{
 /**
     * Handle the candidate "created" event.
     *
     * @param  \App\Candidate  $candidate
     * @return void
     */
    public function created(Candidate $candidate)
    {
        StatusHistory::create([
            'status' => Status::Initial,
            'candidate_id' => $candidate->id,
        ]);
    }
}
