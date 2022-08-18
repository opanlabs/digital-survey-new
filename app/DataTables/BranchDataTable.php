<?php

namespace App\DataTables;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BranchDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */

    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id_branch');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Branch $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Branch $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('branch-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searchPanes(Branch::make())
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
            Column::make('id_branch'),
            Column::make('provience_name')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Branchs_' . date('YmdHis');
    }
}
