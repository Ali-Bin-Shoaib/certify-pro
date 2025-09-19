<?php

namespace App\Imports;

use App\Models\Participant;
use App\Models\ProgramParticipant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ParticipantsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $programId;
    protected $importedCount = 0;

    public function __construct($id)
    {
        $this->programId = $id;
    }

    public function getImportedCount()
    {
        return $this->importedCount;
    }

    public function model(array $row)
    {
        // Debug: Log the row data
        \Log::info('Processing row: ' . json_encode($row));

        // Skip empty rows
        if (empty($row['name']) || empty($row['email']) || empty($row['phone']) || empty($row['gender'])) {
            \Log::info('Skipping empty row: ' . json_encode($row));
            return null;
        }

        // Validate gender values
        $gender = trim((string)$row['gender']);
        if (!in_array($gender, ['ذكر', 'أنثى', 'انثى'])) {
            \Log::warning('Invalid gender value: ' . $gender . ' in row: ' . json_encode($row));
            return null;
        }

        try {
            // Check if participant already exists
            $participant = Participant::where("email", $row["email"])->first();
            $isNewParticipant = false;

            if (!$participant) {
                // Normalize gender values to match database enum
                $gender = trim((string)$row['gender']);
                if ($gender === 'انثى') {
                    $gender = 'أنثى'; // Convert to proper Arabic with hamza
                }

                // Create new participant
                $participant = new Participant([
                    'name' => trim((string)$row['name']),
                    'gender' => $gender,
                    'email' => trim((string)$row['email']),
                    'phone' => trim((string)$row['phone']),
                    'member_id' => Auth::user()->member->id,
                ]);
                $participant->save();
                $isNewParticipant = true;
                \Log::info('Created new participant: ' . $participant->email);
            }

            // Check if participant is already attached to this program
            $isAlreadyAttached = ProgramParticipant::where('program_id', $this->programId)
                ->where('participant_id', $participant->id)
                ->exists();

            if (!$isAlreadyAttached) {
                // Attach participant to program
                $participant->programs()->attach($this->programId);
                \Log::info('Attached participant ' . $participant->email . ' to program ' . $this->programId);
            }

            // Count as imported if either new participant or newly attached to program
            if ($isNewParticipant || !$isAlreadyAttached) {
                $this->importedCount++;
            }

            return $participant;
        } catch (\Exception $e) {
            \Log::error('Error processing participant row: ' . json_encode($row) . ' - ' . $e->getMessage());
            throw $e;
        }
    }
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required'],
            'gender' => ['required'],
            'phone' => ['required'],
        ];
    }
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
        dd($e);
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
        \Log::error('Participant import failures:', $failures);
        // Don't try to attach participants on failure - let the main logic handle it
    }
}
