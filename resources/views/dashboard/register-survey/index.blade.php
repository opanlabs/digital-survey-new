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
            <form action='{{ route('register-survey.create', ['id' => Auth::user()->id_user]) }}' method="post"  enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Add Register Risk Survey</h2>
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
                                                <span>Costumer Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="customer_name" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Phone Number</span>
                                            </label>
                                            <input type="number" class="form-control form-control-solid" placeholder="" name="phone_number" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Email Address</span>
                                            </label>
                                            <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Vehicle Brands</span>
                                            </label>
                                            <select id="select_id_vehicle" class="form-select form-select-solid" data-control="select2" name="id_vehicle" data-placeholder="Select an option" data-hide-search="true">
                                                <option></option>
                                                @foreach($vehicle as $br)
                                                    <option value="{{$br->id_vehicle}}">{{ $br->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Vehicle Type</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="type" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Year Vehicle</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="year" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Plat No</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="plat_no" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Surveyor Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="surveyor" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                <span>Branch</span>
                                            </label>
                                            <select class="form-select form-select-solid" data-control="select2" name="id_branch" data-placeholder="Select an option" data-hide-search="true">
                                                <option></option>
                                                @foreach($branch as $br)
                                                    <option value="{{$br->id_branch}}">{{ $br->province_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                <span data-bs-dismiss="modal" class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
        <!-- modal schedule -->
        <div class="modal fade" tabindex="-1" id="kt_schedule">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Schedule Risk Survey</h5>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body">
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span>Select date</span>
                                </label>
                                <input class="form-control form-control-solid" placeholder="Pick date" id="kt_datepicker_10"/>
                            </div>
                    </div>
        
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal delete -->
        {{-- <div class="modal fade" id="kt_modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body d-flex justify-content-center">
                        <div>
                            <h2 class="modal-title text-center">Are you sure?</h2>
                            <p class="text-center">
                            Do you really want to delete this data?
                            <br />
                            this process can’t be undone.
                            </p>
                        </div>
                    </div>
        
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="modal fade" id="kt_modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body d-flex justify-content-center">
                            <div>
                                <h2 class="modal-title text-center">Are you sure?</h2>
                                <p class="text-center">
                                Do you really want to delete this data?
                                <br />
                                this process can’t be undone.
                                </p>
                            </div>
                        </div>
            
                        <div class="modal-footer">
                            <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light btn-sm">Cancel</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        var todayDate = new Date().toISOString().slice(0, 10);
        $("#kt_datepicker_10").flatpickr({
            dateFormat: "Y-m-d",
            disable: [
                {
                    from: "0001-01-01",
                    to: todayDate
                },
            ]
        });
    </script>
@endpush