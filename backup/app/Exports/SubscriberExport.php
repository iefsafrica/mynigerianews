<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriberExport implements FromCollection, WithHeadings
{
    protected $data;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Write code on Method
     */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Write code on Method
     */
    public function headings(): array
    {
        return [
            'email',
        ];
    }
}
