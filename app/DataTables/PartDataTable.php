<?php

namespace App\DataTables;

use App\Models\Part;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PartDataTable extends DataTable
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
            ->setRowId('id_part');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Part $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Part $model): QueryBuilder
    {
        return $model->newQuery()->with(['typepart']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('part-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searchPanes(Part::make())
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
            Column::make('part_nama'),
            Column::make(['title' => 'TypePart',
                        'data' => 'typepart.type_nama',
                        'name' => 'typepart.type_nama',
                        ]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Parts_' . date('YmdHis');
    }
}
