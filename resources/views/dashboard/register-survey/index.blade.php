@extends('layout.main')

@section('content')
    <div class="card">
        
        <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">List Register Risk Survey</span>
            </h3>
            <div class="card-toolbar">
                <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card" class="btn btn-primary">Add Register Risk Survey</a>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped gy-7 gs-7']) }}
        </div>
        <!-- modal add register risk survey -->
        <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Add New Card</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y">
                        <form id="kt_modal_new_card_form" class="form" action="#">
                            <div class="row">
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>No Register</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="no_register" value="98172" />
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Costumer Name</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="customer_name" value="Max Doe" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Phone Number</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="phone_number" value="087722075872" />
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Email Address</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="email" value="gekikara404@gmail.com" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Vehicle Brands</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="vehicle_brand" value="Toyota" />
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Vehicle Type</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="vehicle_type" value="Class C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Year</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="year" value="2022" />
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Plat No</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="plat_no" value="12321" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Surveyor Name</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="surveyor" value="Agung" />
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span>Branch</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="branch" value="Jawa Barat" />
                                    </div>
                                </div>
                            </div>
                        </form>
						<div class="text-center pt-15">
							<button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>
							<button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
								<span data-bs-dismiss="modal" class="indicator-label">Submit</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush