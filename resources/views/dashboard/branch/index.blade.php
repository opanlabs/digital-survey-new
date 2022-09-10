@extends('layout.main')

@section('content')
    <div class="card">
        
        <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">List Branch</span>
                
            </h3>
            <div class="card-toolbar">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary">Add Branch</a>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped gy-7 gs-7']) }}
        </div>
    </div>

    <!-- begin:modal add branch -->
    <div class='modal fade' id='add_modal' tabindex='-1' aria-hidden='true'>
        <form action='' method='post'>
            @csrf
            <div class='modal-dialog modal-dialog-centered mw-650px'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2>Add User</h2>
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
                                        <input type='text' class='form-control form-control-solid @error('customer_name') is-invalid @enderror' required placeholder='' name='name' />
                                    </div>
                                </div>
                                
                            </div>
                            <div class='row'>
                                <div class='col-md-6 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row'>
                                        <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                            <span>Position</span>
                                        </label>
                                        <select class='form-select form-select-solid @error('id_role') is-invalid @enderror' required data-control='select2' name='id_role' data-placeholder='Select an option' data-hide-search='true'>
                                            @foreach ($roles as $role)
                                                <option></option>
                                                <option value="{{ $role->id_role }}">
                                                    {{ $role->role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-6 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row'>
                                        <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                            <span>Phone Number</span>
                                        </label>
                                        <input type='text' class='form-control form-control-solid @error('phone_number') is-invalid @enderror' required placeholder='' name='phone_number' />
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row'>
                                        <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                            <span>Email Address</span>
                                        </label>
                                        <input type='email' class='form-control form-control-solid @error('email') is-invalid @enderror' required placeholder='' name='email' />
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-6 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row' style="position: relative">
                                        <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                            <span>Password</span>
                                        </label>
                                        <input id="password_new" type="password" name="new-password" class="form-control form-control-solid password" placeholder="New Password" value="" required>
                                        <i class="bi bi-eye-slash me-3 mt-12 fs-3 togglePassword" style="position: absolute; right: 0;cursor: pointer;"></i>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class='col-md-6 fv-row'>
                                    <div class='d-flex flex-column mb-7 fv-row' style="position: relative">
                                        <label class='d-flex align-items-center fs-6 fw-bold form-label mb-2'>
                                            <span>Confirm Password</span>
                                        </label>
                                        <input id="password_new_confirm" type="password" name="new-password_confirmation" class="form-control form-control-solid password_confirm" placeholder="Confirm New Password" value="" required>
                                        <i class="bi bi-eye-slash me-3 mt-12 fs-3 togglePassword_confirm" style="position: absolute; right: 0;cursor: pointer;"></i>
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            @error('new-password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button data-bs-dismiss='modal' type='reset' id='kt_modal_new_card_cancel' class='btn btn-light me-3'>Cancel</button>
                        <button type='submit' id='kt_modal_new_card_submit' class='btn btn-primary'>Add User
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