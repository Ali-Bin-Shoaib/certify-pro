<?php

namespace App\Imports;

use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ParticipantsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

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
        // if ($row['name'] == null) return;
        // if (Participant::where('email', $row['email'])->first() != null) return;
        $participant = new Participant([
            'name'     => $row['name'],
            'gender'    => $row['gender'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'member_id' => Auth::user()->member->id,
        ]);
        $participant->save();
        $participant->programs()->attach($this->programId);
        return $participant;
    }
    public function rules(): array
    {
        return [
            'email' => [Rule::unique('participants', 'email'), 'required', 'string', 'email'],
            'name' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'phone' => ['required'],

            // // Above is alias for as it always validates in batches
            // '*.1' => Rule::in(['patrick@maatwebsite.nl']),

            // Can also use callback validation rules
            // '0' => function ($attribute, $value, $onFailure) {
            //     if ($value !== 'Patrick Brouwers') {
            //         $onFailure('Name is not Patrick Brouwers');
            //     }
            // }
        ];
    }
    // public function onError(\Throwable $e)
    // {
    //     // Handle the exception how you'd like.
    //     return back()->with('errors', $e->getMessage());
    // }

    // public function onFailure(Failure ...$failures)
    // {
    //     // Handle the failures how you'd like.
    //     // dd($failures);
    //     return back()->with('error', $failures);
    // }
}
