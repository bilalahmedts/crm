<?php

namespace App\Imports;

use App\Models\CMUSale;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CMUSaleImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $agent = User::where('name', 'LIKE', $row['agent'])->first();
            if ($agent) {
                foreach ($row as $key => $value) {
                    if ($this->getProjectName($key)) {
                        CMUSale::create([
                            "hrms_id" => @$agent->HRMSID,
                            "project_code" => $this->getProjectName($key),
                            "count" => $value,
                        ]);
                    }
                }
            }
        }
    }
    public function getProjectName($row_name)
    {
        $project_name = '';
        if ($row_name == 'live_conversation_outbound') {
            $project_name = 'P1';
        } elseif ($row_name == 'dealership_discussion') {
            $project_name = 'P2';
        } elseif ($row_name == 'why_calling') {
            $project_name = 'P3';
        } elseif ($row_name == 'department') {
            $project_name = 'P4';
        } elseif ($row_name == 'reason_for_outbound_call') {
            $project_name = 'P5';
        } elseif ($row_name == 'handled_by_voice_recognition') {
            $project_name = 'P6';
        }
        return $project_name;
    }
}
