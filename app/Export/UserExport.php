<?php

namespace App\Export;

use App\Models\SaleDss;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromCollection, WithCustomCsvSettings, WithHeadings , ShouldAutoSize
{
    protected $start='';
    protected $end='';
    public function __construct($a=null,$b=null)
    {
        $this->start = $a;
        $this->end = $b;
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    public function headings(): array
    {
        return ["FirstName"
        , "LastName"
        , "Phone"
        , "State"
        , "City"
        , "Address"
        , "Area"
        , "From which vendor do yo usually buy or supplies from?"
        , "what was the reason for you to purchase your supplies from other supplies?"
        , "Promocode"
        , "Comments"
        , "CustomerName"
        , "created_at"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if( $this->start &&  $this->end){
            return SaleDss::select("FirstName"
        , "LastName"
        , "Phone"
        , "State"
        , "City"
        , "Address"
        , "Area"
        , "question_1"
        , "question_2"
        , "Promocode"
        , "Comments"
        , "CustomerName"
        , "created_at")
        ->WhereDate('created_at','>=',$this->start)
        ->WhereDate('created_at','<=',$this->end)
        ->get();
        }
        return SaleDss::select("FirstName"
        , "LastName"
        , "Phone"
        , "State"
        , "City"
        , "Address"
        , "Area"
        , "question_1"
        , "question_2"
        , "Promocode"
        , "Comments"
        , "CustomerName"
        , "created_at")->get();
    }
}
