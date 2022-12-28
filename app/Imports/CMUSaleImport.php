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
			//dd($rows);
        foreach ($rows as $row) {
            //$agent = User::where('name', 'LIKE', $row['agent'])->first();
                foreach ($row as $key => $value) {
                    if ($this->getProjectName($key)) {
                        CMUSale::create([
							"sale_date" => date('Y-m-d', strtotime($row['date'])) ?? '',
							"hrms_id" => $row['hrms'],
                            "name" => $row['agent'],
                            "project_code" => $this->getProjectName($key),
                            "count" => $value
                        ]);
                    }
                }
        }
    }
    public function getProjectName($row_name)
    {
        $project_name = '';
        if ($row_name == 'live_conversation_outbound') {
            $project_name = 'PRO0117';
        } elseif ($row_name == 'dealership_discussion') {
            $project_name = 'PRO0118';
        } elseif ($row_name == 'why_calling') {
            $project_name = 'PRO0119';
        } elseif ($row_name == 'department') {
            $project_name = 'PRO0120';
        } elseif ($row_name == 'reason_for_outbound_call') {
            $project_name = 'PRO0121';
        } elseif ($row_name == 'handled_by_voice_recognition') {
            $project_name = 'PRO0122';
        }
        return $project_name;
    }
}
