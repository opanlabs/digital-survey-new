<?php

namespace App\DataTables;

use App\Models\RegisterSurvey;
use App\Models\RegisterClaim;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use App\Models\Vehicle;
use App\Models\Branch;
use Auth;

class RegisterClaimReportDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */

    protected function getActionColumn($data): string
    {   
        $vehicle = Vehicle::all();
        $branch = Branch::all();
        $register_survey = RegisterSurvey::all();

        $editUrl = $data;

        
        
        if ($data->status === 'OPEN') {
            $statusLabel = '<a class="btn btn-outline btn-outline-warning btn-active-light-warning btn-sm">Open</a>';
        } elseif($data->status === 'ACTIVE') {
            $statusLabel = '<a class="btn btn-outline btn-outline-success btn-active-light-success btn-sm">Active</a>';
        } elseif($data->status === 'SCHEDULE') {
            $statusLabel = '<a class="btn btn-outline btn-outline-info btn-active-light-info btn-sm">Schedule</a>';
        }elseif($data->status === 'WAITING-DATA') {
            $statusLabel = '<a class="btn btn-outline btn-outline-primary btn-active-light-primary btn-sm">Waiting Data</a>';
        } elseif($data->status === 'DONE') {
            $statusLabel = '<a class="btn btn-outline btn-outline-dark btn-active-light-dark btn-sm">Done</a>';
        } elseif($data->status === 'ERROR') {
            $statusLabel = '<a class="btn btn-outline btn-outline-danger btn-active-light-danger btn-sm">Error</a>';
        } elseif($data->status === 'APPROVE') {
            $statusLabel = '<a class="btn btn-outline btn-outline-success btn-active-light-success btn-sm">Approve</a>';
        }
        
        $linkZoom = '';

        if ($data->status === 'SCHEDULE') {
            $linkZoom = "
            <td class='text-muted min-w-125px w-200px'>Link Zoom Meeting</td>
            <td class='text-gray-800'>                                
                <div class='input-group mb-5'>
                    <span class='input-group-text' id='basic-addon1'>Link</span>
                    <input type='text' value='".$data->link_zoom."' class='form-control' placeholder='Link Zoom Meeting' aria-label='Link Zoom Meeting' aria-describedby='basic-addon1'/>
                </div>
            </td>
            ";
        }

        //edit modal
        $viewModal_branchSelect = "";
        $viewModal_vehicleSelect = "";
        $viewModal_registerNoSelect = "";
        foreach ($register_survey as $survey) {
            if ($survey->id_register_survey == $data->register_survey->id_register_survey) {
                $survey_isSelected = 'selected="selected"';
            }else{
                $survey_isSelected = '';
            }
            $viewModal_registerNoSelect .= "<option value='". $survey->id_register_survey ."'".$survey_isSelected.">$survey->register_no</option>";
        };
        foreach ($branch as $branch) {
            if ($branch->id_branch == $data->branch->id_branch) {
                $branch_isSelected = 'selected="selected"';
            }else{
                $branch_isSelected = '';
            }
            $viewModal_branchSelect .= "<option value='". $branch->id_branch ."'".$branch_isSelected.">$branch->province_name</option>";
        };
        foreach ($vehicle as $vehicle) {
            if ($vehicle->id_vehicle == $data->vehicle->id_vehicle) {
                $vehicle_isSelected = 'selected="selected"';
            }else{
                $vehicle_isSelected = '';
            }
            $viewModal_vehicleSelect .= "<option value='". $vehicle->id_vehicle ."'". $vehicle_isSelected ."> $vehicle->nama </option>";
        };
        $viewModal = "
        <div class='modal fade' id='view_modal".$data->id_register_claim."' tabindex='-1' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered mw-650px'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2>Data Register Risk Survey</h2>
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
                                    <td class='text-muted min-w-125px w-200px'>No Polis</td>
                                    <td class='text-gray-800'>".$data->no_polis."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>No Register</td>
                                    <td class='text-gray-800'>".$data->register_survey->register_no."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Costumer Name</td>
                                    <td class='text-gray-800'>".$data->customer->customer_name."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Phone Number</td>
                                    <td class='text-gray-800'>".$data->customer->phone_number."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Email</td>
                                    <td class='text-gray-800'>".$data->customer->email."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Vehicle Brand</td>
                                    <td class='text-gray-800'>".$data->vehicle->nama."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Vehicle Type</td>
                                    <td class='text-gray-800'>".$data->vehicle->vehicle_type."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Year</td>
                                    <td class='text-gray-800'>".$data->year."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Plat No</td>
                                    <td class='text-gray-800'>".$data->plat_no."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Surveyor Name</td>
                                    <td class='text-gray-800'>".$data->user->name."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Branch</td>
                                    <td class='text-gray-800'>".$data->branch->province_name."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Register Date</td>
                                    <td class='text-gray-800'>".$data->created_at."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Status</td>
                                    <td class='text-gray-800'>".$statusLabel."</td>
                                </tr>
                                <tr>
                                ".
                                    $linkZoom
                                ."
                            </tr>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='reset' class='btn btn-success me-3' data-bs-toggle='modal' data-bs-target='#edit_modal".$data->id_register_claim."'>Edit</button>
                        <button type='reset' class='btn btn-danger me-3' data-bs-toggle='modal' data-bs-target='#kt_modal_delete'>Delete</button>
                    </div>
                    
                </div>
            </div>
        </div>";
        $editModal = "
        <div class='modal fade' id='edit_modal".$data->id_register_claim."' tabindex='-1' aria-hidden='true'>
            <form action='".route('register-claim.update', ['id' => $data->id_register_claim ]) ."' method='post'>
                <input type='hidden' name='_method' value='put'>
                <input type='hidden' name='_token' value='". csrf_token() ."'>
                <input type='hidden' name='id_customer' value='".$data->customer->id_customer."'>
                <div class='modal-dialog modal-dialog-centered mw-650px'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Edit Register Claim</h2>
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
                                                <span>No Polis</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('no_polis') is-invalid @enderror' required placeholder='' name='no_polis' value='".$data->no_polis."' />
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>No Register</span>
                                            </label>
                                            <select class='form-select form-select-solid @error('id_register_survey') is-invalid @enderror' required data-control='select2' name='id_register_survey' data-placeholder='Select an option' data-hide-search='true'>
                                            ".
                                            $viewModal_registerNoSelect
                                            ."
                                            </select>
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Costumer Name</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('customer_name') is-invalid @enderror' required placeholder='' name='customer_name' value='".$data->customer->customer_name."' />
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Phone Number</span>
                                            </label>
                                            <input type='number' class='form-control form-control-solid @error('phone_number') is-invalid @enderror' required placeholder='' name='phone_number' value='".$data->customer->phone_number."' />
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Email Address</span>
                                            </label>
                                            <input type='email' class='form-control form-control-solid @error('email') is-invalid @enderror' required placeholder='' name='email' value='".$data->customer->email."' />
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Vehicle Brands</span>
                                            </label>
                                            <select class='form-select form-select-solid @error('id_vehicle') is-invalid @enderror' required data-control='select2' name='id_vehicle' data-placeholder='Select an option' data-hide-search='true'>
                                            ".
                                            $viewModal_vehicleSelect
                                            ."
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Vehicle Type</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('type') is-invalid @enderror' required placeholder='' name='type' value='".$data->vehicle->vehicle_type."' />
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Year Vehicle</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('year') is-invalid @enderror' required placeholder='' name='year' value='".$data->year."' />
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Plat No</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('plat_no') is-invalid @enderror' required placeholder='' name='plat_no' value='".$data->plat_no."' />
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Branch</span>
                                            </label>
                                            <select class='form-select form-select-solid @error('id_branch') is-invalid @enderror' required data-control='select2' name='id_branch' data-placeholder='Select an option' data-hide-search='true'>
                                            ".
                                            $viewModal_branchSelect
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

        $schedule = "";
        $surveyReport = "";
        $viewSurvey = "";
        if ($editUrl->status === 'OPEN') {
           $schedule = "<div class='menu-item menu-state-bg px-3'>
                            <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#kt_schedule' id='kt_schedule_mod' data-id='{$editUrl->id_register_claim}'>
                                <span class='menu-icon'><i class='bi bi-calendar2-plus'></i></span>
                                <span class='menu-title'>Schedule</span>
                            </a>
                        </div>";
        }

        if ($editUrl->status === 'SCHEDULE') {
            $surveyReport = "<div class='menu-item menu-state-bg px-3'>
                             <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#kt_report' id='kt_report_mod' data-id='{$editUrl->id_register_claim}'>
                                 <span class='menu-icon'><i class='bi bi-calendar2-plus'></i></span>
                                 <span class='menu-title'>Report Schedule</span>
                             </a>
                         </div>";
         }


            $viewSurvey = "
            <div class='menu-item menu-state-bg px-3'>
            <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#kt_report_view' id='kt_report_view_mod' data-id='{$editUrl->id_register_claim}'>
                <span class='menu-icon'><i class='bi bi-eye'></i></span>
                <span class='menu-title'>View</span>
            </a>
            </div>
        ";


        return "
        <a href='#' class='btn btn-light-primary btn-sm' data-kt-menu-trigger='click' data-kt-menu-placement='bottom-end'><i class='bi bi-three-dots'></i></a>
        <!--begin::Menu-->
        <div class='menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg fw-bold fs-7 w-125px py-4' data-kt-menu='true'>
"
. $viewSurvey;
    }
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
            })
            ->addColumn('status',function ($data){
                if ($data->status === 'OPEN') {
                    return '<a class="btn btn-outline btn-outline-warning btn-active-light-warning btn-sm">Open</a>';
                } elseif($data->status === 'ACTIVE') {
                    return '<a class="btn btn-outline btn-outline-success btn-active-light-success btn-sm">Active</a>';
                } elseif($data->status === 'SCHEDULE') {
                    return '<a class="btn btn-outline btn-outline-info btn-active-light-info btn-sm">Schedule</a>';
                }elseif($data->status === 'WAITING-DATA') {
                    return '<a class="btn btn-outline btn-outline-primary btn-active-light-primary">Waiting Data</a>';
                } elseif($data->status === 'DONE') {
                    return '<a class="btn btn-outline btn-outline-dark btn-active-light-dark btn-sm">Done</a>';
                } elseif($data->status === 'ERROR') {
                    return '<a class="btn btn-outline btn-outline-danger btn-active-light-danger btn-sm">Error</a>';
                } elseif($data->status === 'APPROVE') {
                    return '<a class="btn btn-outline btn-outline-success btn-active-light-success btn-sm">Approve</a>';
                }
                
            })
            ->addColumn('link_zoom',function ($data){
                    return $data->link_zoom ? "<a target='_blank' rel='noopener noreferrer' href='{$data->link_zoom}' class='btn btn-outline btn-outline-dark btn-active-light-dark btn-sm'><i class='bi bi-record-btn fs-4 me-2'></i> Zoom</a>" : "-";
            })
            ->addColumn('created_at',function ($data){
                return $data->created_at->format('Y-m-d d:m');
            })
            ->rawColumns(['status','action','link_zoom','created_at'])
            ->setRowId('id_register_claim');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RegisterSurvey $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RegisterClaim $model): QueryBuilder
    {
        return $model->newQuery()->where([['id_branch', Auth::user()->id_branch],['status', 'DONE']])->with(['vehicle','customer','user','branch','register_survey']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('RegisterClaim-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searchPanes(RegisterClaim::make())
                    ->dom('frtip')
                    ->ajax([
                        'data' => [
                            '_token' => csrf_token()
                        ],
                    ])
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
            Column::make(['title' => 'No',
                'data' => 'id_register_claim',
                'name' => 'id_register_claim',
            ]),
            Column::make(['title' => 'No Polis',
                'data' => 'no_polis',
                'name' => 'no_polis',
            ]),
            Column::make(['title' => 'Register No',
                'data' => 'register_survey.register_no',
                'name' => 'register_survey.register_no',
            ]),
            Column::make(['title' => 'Name',
                'data' => 'customer.customer_name',
                'name' => 'customer.customer_name',
            ]),
            Column::make(['title' => 'Branch',
                'data' => 'branch.province_name',
                'name' => 'branch.province_name',
            ]),
            Column::make(['title' => 'Vehicle Type',
                'data' => 'vehicle.nama',
                'name' => 'vehicle.nama',
            ]),
            Column::make(['title' => 'Register Date',
                'data' => 'created_at',
                'name' => 'created_at',
            ]),
            Column::make(['title' => 'Surveyor Name',
                'data' => 'surveyor',
                'name' => 'surveyor',
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
        return 'RegisterClaims_' . date('YmdHis');
    }
}
