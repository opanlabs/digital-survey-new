<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Roles;
use App\Models\Team;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;

class TeamDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */

    protected function getActionColumn($data): string
    {   
        $roles = Roles::all();
        $team = Team::all();

        //delete modal
        $deleteModal = "
        <div class='modal fade deleteSurvey' id='delete_modal".$data->id_user."' tabindex='-1' role='dialog' aria-labelledby='exampleModalSizeLg' aria-hidden='true'>
            <form action='". route('users.delete',['id' => $data->id_user]) ."' method='post' id='form-update' enctype='multipart/form-data'>
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

        //reset modal
        $resetModal = "
        <div class='modal fade' id='reset_modal".$data->id_user."' tabindex='-1' aria-hidden='true'>
            <form action='".route('users.reset', ['id' => $data->id_user ]) ."' method='post'>
                <input type='hidden' name='_method' value='put'>
                <input type='hidden' name='_token' value='". csrf_token() ."'>
                <div class='modal-dialog modal-dialog-centered mw-650px'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Reset Password</h2>
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
                                    <div class='col-md-12 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Name</span>
                                            </label>
                                            <input type='text' class='text-muted form-control form-control-solid @error('customer_name') is-invalid @enderror' required placeholder='' name='name' value='".$data->name."' disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row' style='position: relative'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Password</span>
                                            </label>
                                            <input type='password' name='new-password' class='form-control form-control-solid password' placeholder='New Password' value='' required>
                                            
                                            <div class='fv-plugins-message-container invalid-feedback'></div>
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row' style='position: relative'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Confirm Password</span>
                                            </label>
                                            <input type='password' name='new-password_confirmation' class='form-control form-control-solid password_confirm' placeholder='Confirm New Password' value='' required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <button data-bs-dismiss='modal' type='reset' id='kt_modal_new_card_cancel' class='btn btn-light me-3'>Cancel</button>
                            <button type='submit' id='kt_modal_new_card_submit' class='btn btn-primary'>Reset Password
                            </button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
        ";

        //edit modal
        $editModal_roleSelect = "";
        foreach ($roles as $roles) {
            if ($roles->id_role == $data->roles->id_role) {
                $role_isSelected = 'selected="selected"';
            }else{
                $role_isSelected = '';
            }
            $editModal_roleSelect .= "<option value='". $roles->id_role ."'".$role_isSelected.">$roles->role</option>";
        };
        
        $editModal_teamSelect = "";
            foreach ($team as $teams) {
                if ($data->id_team) {
                    if ($teams->id_team == $data->team->id_team) {
                        $team_isSelected = 'selected="selected"';
                    }else{
                        $team_isSelected = '';
                    }
                    $editModal_teamSelect .= "<option value='". $teams->id_team ."'". $team_isSelected .">". $teams->name_team ."</option>";
                } else {
                    $editModal_teamSelect .= "
                    <option></option>
                    <option value='". $teams->id_team ."'>". $teams->name_team ."</option>
                    ";
                }
            };
        
        $editModal = "
        <div class='modal fade' id='edit_modal".$data->id_user."' tabindex='-1' aria-hidden='true'>
            <form action='".route('users.update', ['id' => $data->id_user ]) ."' method='post'>
                <input type='hidden' name='_method' value='put'>
                <input type='hidden' name='_token' value='". csrf_token() ."'>
                <div class='modal-dialog modal-dialog-centered mw-650px'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Edit User</h2>
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
                                                <span>Name</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('customer_name') is-invalid @enderror' required placeholder='Name' name='name' value='".$data->name."' />
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Position</span>
                                            </label>
                                            <select class='form-select form-select-solid @error('id_role') is-invalid @enderror' required data-control='select2' name='id_role' data-placeholder='Select an option' data-hide-search='true'>
                                           ".
                                            $editModal_roleSelect
                                           ."
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Id User</span>
                                            </label>
                                            <input type='email' class='form-control form-control-solid @error('id_user') is-invalid @enderror' required placeholder='email' name='email' value='".$data->id_user."' disabled read-only/>
                                        </div>
                                    </div>
                                    <div class='col-md-6 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Phone Number</span>
                                            </label>
                                            <input type='text' class='form-control form-control-solid @error('phone_number') is-invalid @enderror' required placeholder='' name='phone_number' value='".$data->phone_number."' />
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                <div class='col-md-12 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row'>
                                        <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                            <span>Team</span>
                                        </label>
                                        <select class='form-select form-select-solid @error('id_team') is-invalid @enderror' required data-control='select2' name='id_team' data-placeholder='Select an option' data-hide-search='true'>
                                            ".
                                            $editModal_teamSelect
                                            ."
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div class='row'>
                                    <div class='col-md-12 fv-row'>
                                        <div class='d-flex flex-column mb-7 fv-row'>
                                            <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                                <span>Email Address</span>
                                            </label>
                                            <input type='email' class='form-control form-control-solid @error('email') is-invalid @enderror' required placeholder='' name='email' value='".$data->email."' required/>
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
        <div class='modal fade' id='view_modal".$data->id_user."' tabindex='-1' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered mw-650px'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2>Data User</h2>
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
                                    <td class='text-muted min-w-125px w-200px'>Name</td>
                                    <td class='text-gray-800'>".$data->name."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Position</td>
                                    <td class='text-gray-800'>".$data->roles->role."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>ID</td>
                                    <td class='text-gray-800'>".$data->id_user."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Phone Number</td>
                                    <td class='text-gray-800'>".$data->phone_number."</td>
                                </tr>
                                <tr>
                                    <td class='text-muted min-w-125px w-200px'>Email</td>
                                    <td class='text-gray-800'>".$data->email."</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='reset' class='btn btn-success me-3' data-bs-toggle='modal' data-bs-target='#edit_modal".$data->id_user."'>Edit</button>
                        <button type='reset' class='btn btn-danger me-3' data-bs-toggle='modal' data-bs-target='#delete_modal".$data->id_user."'>Delete</button>
                    </div>
                    
                </div>
            </div>
        </div>";

        return "
        <a href='#' class='btn btn-light-primary btn-sm' data-kt-menu-trigger='click' data-kt-menu-placement='bottom-end'><i class='bi bi-three-dots'></i></a>
        <!--begin::Menu-->
        <div class='menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg fw-bold fs-7 w-175px py-4' data-kt-menu='true'>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#view_modal".$data->id_user."'>
                    <span class='menu-icon'><i class='bi bi-eye'></i></span>
                    <span class='menu-title'>View</span>
                </a>
            </div>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#edit_modal".$data->id_user."'>
                    <span class='menu-icon'><i class='bi bi-pencil-square'></i></span>
                    <span class='menu-title'>Edit</span>
                </a>
            </div>
            <div class='menu-item menu-state-bg px-3'>
                <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#reset_modal".$data->id_user."'>
                    <span class='menu-icon'><i class='bi bi-shield-lock'></i></span>
                    <span class='menu-title'>Reset Password</span>
                </a>
            </div>
            <div class='menu-item menu-state-bg px-3'>
                    <a href='#' class='menu-link px-3' data-bs-toggle='modal' data-bs-target='#delete_modal".$data->id_user."'>
                    <span class='menu-icon'><i class='bi bi-trash'></i></span>
                    <span class='menu-title'>Delete</span>
                </a>
            </div>
        </div>
        <!--end::Menu-->
        " . $editModal . $resetModal . $deleteModal . $viewModal;
    }
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
                })
            ->editColumn('team.name_team', function($data) {
                return is_null($data->id_team) ? 'Belum Masuk Team' : $data->team->name_team;
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        if (Auth::user()->roles->role == 'Super Admin') {
            return $model->newQuery()
                     ->with(['branch','roles','team'])
                     ->where('approved', '=', 1);
        } else {
            return $model->newQuery()
            ->with(['branch','roles','team'])
            ->where('approved', '=', 1)
            ->where('id_branch', '=', Auth::user()->id_branch);
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('team-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make(['title' => 'No',
                           'data' => 'DT_RowIndex',
                           'name' => 'DT_RowIndex',
                           'orderable' => 'false',
                           'searchable' => 'false',
                        ]),
            Column::make(['title' => 'Team',
                           'data' => 'team.name_team',
                           'name' => 'team.name_team',
                        ]),
            Column::make(['title' => 'Position',
                           'data' => 'roles.role',
                           'name' => 'roles.role',
                        ]),            
            Column::make(['title' => 'ID',
                            'data' => 'id_user',
                            'name' => 'id_user',
                         ]),            
            Column::make('phone_number'),
            Column::make('email'),
           
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
        return 'Users_' . date('YmdHis');
    }
}
