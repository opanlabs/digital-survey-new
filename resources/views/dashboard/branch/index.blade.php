@extends('layout.main')

@section('content')

@foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        {{ $error }}<br/>
    </div> 
@endforeach

    <div class="card">
        <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">List Branch</span>
                
            </h3>
            <div class="card-toolbar">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_team_modal" class="btn btn-primary me-3">Add Team Branch</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary">Add Branch</a>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped gy-7 gs-7']) }}
        </div>
    </div>

     <!-- begin:modal add Team -->
     <div class='modal fade' id='add_team_modal' tabindex='-1' aria-hidden='true'>
        <form action='{{ route('team.create') }}' method='post'>
            @csrf
            <div class='modal-dialog modal-dialog-centered mw-650px'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2>Add Team</h2>
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
                                        <label class='d-flex fs-6 fw-bold form-label mb-2'>
                                            <span>Name Team</span>
                                        </label>
                                        <input type='text' class='form-control form-control-solid @error('team_name') is-invalid @enderror' required placeholder='Name Team' name='name_team'/>
                                    </div>
                                </div>
                                <div class='col-md-6 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row'>
                                        <label class='d-flex fs-6 fw-bold form-label mb-2'>
                                            <span>Branch Name</span>
                                        </label>
                                        <select class='form-select form-select-solid @error('id_branch') is-invalid @enderror' required data-control='select2' name='id_branch' data-placeholder='Select an option' data-hide-search='true'>
                                            @foreach ($branch as $branch)
                                                <option></option>
                                                <option value="{{ $branch->id_branch }}">
                                                    {{ $branch->province_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button data-bs-dismiss='modal' type='reset' id='kt_modal_new_card_cancel' class='btn btn-light me-3'>Cancel</button>
                        <button type='submit' id='kt_modal_new_card_submit' class='btn btn-primary'>Add Team
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
    <!-- end:modal add Team -->

    <!-- begin:modal add branch -->
    <div class='modal fade' id='add_modal' tabindex='-1' aria-hidden='true'>
        <form action='{{ route('branch.create') }}' method='post'>
            @csrf
            <div class='modal-dialog modal-dialog-centered mw-650px'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2>Add Branch</h2>
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
                                        <label class='d-flex fs-6 fw-bold form-label mb-2'>
                                            <span>Area</span>
                                        </label>
                                        <input type='text' class='form-control form-control-solid @error('province_name') is-invalid @enderror' required placeholder='Area' name='province_name' />
                                    </div>
                                </div>
                                <div class='col-md-6 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row'>
                                        <label class='d-flex fs-6 fw-bold form-label mb-2'>
                                            <span>Head</span>
                                        </label>
                                        <select class='form-select form-select-solid @error('id_user') is-invalid @enderror' required data-control='select2' name='id_user' data-placeholder='Select an option' data-hide-search='true'>
                                            @foreach ($user_admin as $admin)
                                                <option></option>
                                                <option value="{{ $admin->id_user }}">
                                                    {{ $admin->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row'>
                                        <label class='d-flex fs-6 fw-bold form-label mb-2'>
                                            <span>Address</span>
                                        </label>
                                        <input type='text' class='form-control form-control-solid @error('email') is-invalid @enderror' required placeholder='' name='address' />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button data-bs-dismiss='modal' type='reset' id='kt_modal_new_card_cancel' class='btn btn-light me-3'>Cancel</button>
                        <button type='submit' id='kt_modal_new_card_submit' class='btn btn-primary'>Add Branch
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
    <!-- end:modal add branch -->
    
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush