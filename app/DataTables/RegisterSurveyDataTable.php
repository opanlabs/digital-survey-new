<?php

namespace App\DataTables;

use App\Models\RegisterSurvey;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RegisterSurveyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */

    protected function getActionColumn($data): string
    {   
        $editUrl = $data;
        return "
        <a href='#' class='btn btn-light-primary btn-sm' data-kt-menu-trigger='click' data-kt-menu-placement='bottom-end'><i class='bi bi-three-dots'></i></a>
        <!--begin::Menu-->
        <div class='menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg fw-bold fs-7 w-125px py-4' data-kt-menu='true'>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3'>
                    <span class='menu-icon'><i class='bi bi-eye'></i></span>
                    <span class='menu-title'>View</span>
                </a>
            </div>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3'>
                    <span class='menu-icon'><i class='bi bi-pencil-square'></i></span>
                    <span class='menu-title'>Edit</span>
                </a>
            </div>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3 text-danger'>
                    <span class='menu-icon'><i class='bi bi-trash'></i></span>
                    <span class='menu-title'>Delete</span>
                </a>
            </div>
        </div>
        <!--end::Menu-->
        ";
    }
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
                })
            ->setRowId('id_register_survey');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RegisterSurvey $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RegisterSurvey $model): QueryBuilder
    {
        return $model->newQuery()->with(['vehicle','customer','user']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('RegisterSurvey-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searchPanes(RegisterSurvey::make())
                    ->dom('frtip')
                    ->parameters([
                        'drawCallback' => 'function() { KTMenu.createInstances(); }',
                        ['extends' => 'pdf', 'className' => 'hidden']
                        ]);
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id_register_survey'),
            Column::make('register_no'),
            Column::make(['title' => 'Name',
                'data' => 'customer.customer_name',
                'name' => 'customer.customer_name',
            ]),
            Column::make(['title' => 'Vehicle Type',
                'data' => 'vehicle.nama',
                'name' => 'vehicle.nama',
            ]),
            Column::make('register_date'),
            Column::make('id_user'),
            Column::make(['title' => 'Surveyor Name',
                'data' => 'user.name',
                'name' => 'user.name',
            ]),
            Column::make('survey_date'),
            Column::make('link_zoom'),
            Column::make('status'),
            Column::make('action')
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'RegisterSurveys_' . date('YmdHis');
    }
}
