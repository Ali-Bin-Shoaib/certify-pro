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
        // dd($row);
        $participant = new Participant([
            'name'     => $row['name'],
            'gender'    => $row['gender'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'member_id' => Auth::user()->member->id,
            // 'program_id'=> $this->programId,
        ]);
        // Participant::create([
        //     'name'     => $row['name'],
        //     'gender'    => $row['gender'],
        //     'email' => $row['email'],
        //     'phone' => $row['phone'],
        //     'member_id' => Auth::user()->member->id,
        //     // 'program_id'=> $this->programId,
        // ]);
        $participant->save();
        $participant->programs()->attach($this->programId);
        // ProgramParticipant::create([
        //     'participant_id' => $participant->id,
        //     'program_id' => $this->programId,
        // ]);
        // dd($participant);


    }
}
