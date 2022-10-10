<?php

namespace App\Exports;

use App\Models\MwApplicant;
use App\Models\MwApplicantAddress;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;


class UserExport2 implements FromCollection,Responsable,ShouldAutoSize,WithMapping,WithHeadings,WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
//    private $fileName="useExport2.xlsx";

    public function collection()
    {
        return $data= MwApplicant::with('address')->get();
    }

    public function map($user):array{
        return [
            $user->first_name,
            $user->last_name,
            $user->address->division_id
        ];
    }
    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            "Firls_name",
            "last_name",
            "divi",
        ];
    }

    public function registerEvents():array
    {

        return [
            AfterSheet:: class => function(AfterSheet $event){
                $event->sheet->getStyle('A1:B1')->applyFromArray([

                       'font'=>[
                           'bold'=>true,
                       ]

                ]);
            }
        ];
    }
}
