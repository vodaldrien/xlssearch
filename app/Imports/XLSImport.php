<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class XLSImport implements ToCollection
{
    public Collection $rows;

    public function collection(Collection $collection)
    {
        $this->rows = $collection;
    }
}
