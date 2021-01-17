<?php

namespace App\Exports;

use App\Models\Newsletters;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewslettersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Newsletters::where('visible', true)->get(['email']);
    }
}
