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
        // try {
        if ($row['name'] == null) return;
        if(Participant::where('email', $row['email'])->first() != null) return;
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
        // dd($participant);
        // ProgramParticipant::create([
        //     'participant_id' => $participant->id,
        //     'program_id' => $this->programId,
        // ]);
        // dd($participant);
        // return $participant;

        // } catch (\Throwable $th) {

        //     return back()->with('error', $th->getMessage());
        // }
    }
}
