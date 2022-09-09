@extends('layout.main')

@section('content')
    <div class="card">
        
        <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">List Type Part</span>
            </h3>
            <div class="card-toolbar">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary">Add Type Part</a>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped gy-7 gs-7']) }}
        </div>

     <!-- begin:modal add type part -->
     <div class='modal fade' id='add_modal' tabindex='-1' aria-hidden='true'>
        <form action='{{ route('typepart.create') }}' method='post'>
            @csrf
            <div class='modal-dialog modal-dialog-centered mw-650px'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h2>Add Type Part</h2>
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
                                            <span>Type Nama</span>
                                        </label>
                                        <input type='text' class='form-control form-control-solid @error('type_nama') is-invalid @enderror' required placeholder='' name='type_nama' />
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button data-bs-dismiss='modal' type='reset' id='kt_modal_new_card_cancel' class='btn btn-light me-3'>Cancel</button>
                        <button type='submit' id='kt_modal_new_card_submit' class='btn btn-primary'>Add Type Part
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
    </div>
    
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush