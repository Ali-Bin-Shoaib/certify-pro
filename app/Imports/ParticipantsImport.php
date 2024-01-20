<?php

namespace App\Imports;

use App\Models\Participant;
use App\Models\ProgramParticipant;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $programId;

    public function __construct($id)
    {
        $this->programId = $id;
    }

    public function model(array $row)
    {
        if ($row['name'] == null) return;
        if(Participant::where('email', $row['email'])->first() != null) return;
        $participant = new Participant([
            'name'     => $row['name'],
            'gender'    => $row['gender'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'member_id' => Auth::user()->member->id,
        ]);

        $participant->save();
        $participant->programs()->attach($this->programId);
    }
}
