<?php

namespace App\DataTables;

use App\Models\Part;
use App\Models\TypePart;
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
    protected function getActionColumn($data): string
    {  

        $typepart = TypePart::all();

        //delete modal
        $deleteModal = "
        <div class='modal fade deleteSurvey' id='delete_modal".$data->id_part."' tabindex='-1' role='dialog' aria-labelledby='exampleModalSizeLg' aria-hidden='true'>
            <form action='". route('part.delete',['id' => $data->id_part]) ."' method='post' id='form-update' enctype='multipart/form-data'>
                <input type='hidden' name='_token' value='". csrf_token() ."'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='flex-column'>
                                    <div class='modal-header border-0 text-center mt-5 justify-content-center'>
                                        <i class='bi bi-x-circle fs-5x text-danger'></i>
                                    </div>						
                                    <h4 class='modal-title w-100 text-center'>Are you sure?</h4>
                                </div>
                                <div class='modal-body text-center'>
                                    <p>Do you really want to delete these records?<br> This process cannot be undone.</p>
                                </div>
                                <div class='modal-footer justify-content-center'>
                                    <button data-bs-dismiss='modal' type='reset' id='kt_modal_new_card_cancel' class='btn btn-light btn-sm'>Cancel</button>
                                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        ";

        //edit modal
        $editModal_partSelect = "";
        foreach ($typepart as $parts) {
            if ($parts->id_typepart == $data->typepart->id_typepart) {
                $part_isSelected = 'selected="selected"';
            }else{
                $part_isSelected = '';
            }
            $editModal_partSelect .= "<option value='". $parts->id_typepart ."'".$part_isSelected.">$parts->type_nama</option>";
        };
        $editModal = "
        <div class='modal fade' id='edit_modal".$data->id_part."' tabindex='-1' aria-hidden='true'>
            <form action='".route('part.update', ['id' => $data->id_part ]) ."' method='post'>
                <input type='hidden' name='_method' value='put'>
                <input type='hidden' name='_token' value='". csrf_token() ."'>
                <div class='modal-dialog modal-dialog-centered mw-650px'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Edit Part</h2>
                            <div class='btn btn-sm btn-icon btn-active-color-primary' data-bs-dismiss='modal'>
                                <span class='svg-icon svg-icon-1'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                        <rect opacity='0.5' x='6' y='17.3137' width='16' height='2' rx='1' transform='rotate(-45 6 17.3137)' fill='currentColor' />
                                        <rect x='7.41422' y='6' width='16' height='2' rx='1' transform='rotate(45 7.41422 6)' fill='currentColor' />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class='modal-body scroll-y'>
                            <form id='kt_modal_new_card_form' class='form' action='#'>
                                <div class='row'>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Part Nama</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('part_nama') is-invalid @enderror' required placeholder='' name='part_nama' value='".$data->part_nama."' />
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Type Part</span>
                                            </label>
                                            <select class='form-select form-select-solid @error('id_typepart') is-invalid @enderror' required data-control='select2' name='id_typepart' data-placeholder='Select an option' data-hide-search='true'>
                                           ".
                                            $editModal_partSelect
                                           ."
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <button data-bs-dismiss='modal' type='reset' id='kt_modal_new_card_cancel' class='btn btn-light me-3'>Cancel</button>
                            <button type='submit' id='kt_modal_new_card_submit' class='btn btn-primary'>Update
                            </button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
        ";

        $viewModal = "
        <div class='modal fade' id='view_modal".$data->id_part."' tabindex='-1' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered mw-650px'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2>Data Part</h2>
                        <div class='btn btn-sm btn-icon btn-active-color-primary' data-bs-dismiss='modal'>
                            <span class='svg-icon svg-icon-1'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <rect opacity='0.5' x='6' y='17.3137' width='16' height='2' rx='1' transform='rotate(-45 6 17.3137)' fill='currentColor' />
                                    <rect x='7.41422' y='6' width='16' height='2' rx='1' transform='rotate(45 7.41422 6)' fill='currentColor' />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class='modal-body scroll-y'>
                    <div class='d-flex flex-wrap py-2'>
                        <div class='flex-equal me-5'>
                            <table class='table table-flush fw-bold gy-2'>
                                <tr>
                                    <td class='py-2 text-muted min-w-125px w-200px'>Part Nama</td>
                                    <td class='py-2 text-gray-800'>".$data->part_nama."</td>
                                </tr>
                                <tr>
                                    <td class='py-2 text-muted min-w-125px w-200px'>Type Part</td>
                                    <td class='py-2 text-gray-800'>".$data->typepart->type_nama."</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='reset' class='btn btn-success me-3' data-bs-toggle='modal' data-bs-target='#edit_modal".$data->id_part."'>Edit</button>
                        <button type='reset' class='btn btn-danger me-3' data-bs-toggle='modal' data-bs-target='#delete_modal".$data->id_part."'>Delete</button>
                    </div>
                    
                </div>
            </div>
        </div>";

        return "
        <a href='#' class='btn btn-light-primary btn-sm' data-kt-menu-trigger='click' data-kt-menu-placement='bottom-end'><i class='bi bi-three-dots'></i></a>
        <!--begin::Menu-->
        <div class='menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg fw-bold fs-7 w-175px py-4' data-kt-menu='true'>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#view_modal".$data->id_part."'>
                    <span class='menu-icon'><i class='bi bi-eye'></i></span>
                    <span class='menu-title'>View</span>
                </a>
            </div>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#edit_modal".$data->id_part."'>
                    <span class='menu-icon'><i class='bi bi-pencil-square'></i></span>
                    <span class='menu-title'>Edit</span>
                </a>
            </div>
            <div class='menu-item menu-state-bg px-3'>
                    <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#delete_modal".$data->id_part."'>
                    <span class='menu-icon'><i class='bi bi-trash'></i></span>
                    <span class='menu-title'>Delete</span>
                </a>
            </div>
        </div>
        <!--end::Menu-->
        " . $editModal  . $deleteModal . $viewModal;
    }

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */

    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action',function ($data){
            return $this->getActionColumn($data);
            })
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
                        ['extends' => 'pdf', 'className' => 'hidden'],
                        'scrollX' => true
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
        return 'Parts_' . date('YmdHis');
    }
}
