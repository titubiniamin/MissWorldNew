<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, Responsable
{
//    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
//    private $fileName="newUsers.xlsx";
    private $fileName="fromUserExport.xlsx";
    public function collection()
    {

        return User::all();
    }
}
