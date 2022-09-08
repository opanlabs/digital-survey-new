<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class RegisterSurveyExport implements FromView,ShouldAutoSize
{

    use Exportable;

    private $query  = [];

    public function __construct($query){
        $this->query = $query;
    }

    public function view(): View
    {
        return view('exports.survey_export_sheet.blade', [
            'query' => $this->query,
        ]);
    }
}