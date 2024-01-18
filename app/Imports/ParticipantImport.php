<?php

namespace App\Imports;

use App\Models\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ParticipantImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Participant::create([
                'name' => $row[0],
                'email' => $row[1],
                'gender' => $row[2],
                'phone' => $row[3],
            ]);
        }
    }
}
