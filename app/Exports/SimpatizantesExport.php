<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromArray;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SimpatizantesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('reportes.tablaSimpatizantesExcel', ['data' => $this->data]);
    }
}