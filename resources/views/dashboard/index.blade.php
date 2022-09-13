@extends('layout.main')

@section('content')
<!--begin::Row-->
<div class="row gy-5 g-xl-8">
    <!--begin::Col-->
    <div class="col-xl-6 ">
        <!--begin::Card-->										
        <div class="card mb-2 " style="height:225px">
            <!--begin::Card body-->
            <div class="card-body card-p-chart">
               
                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between ">
                        <!--begin::Labels-->
                        <div class="d-flex flex-column justify-content-between">
                             <!--begin::Heading-->
                             <div class="fs-4 fw-bold text-gray-400 mb-7 ">All Register</div>
                            <div class="fs-3 fw-bolder">{{ $registerSurvey->count() }} User</div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Labels-->
                        <!--begin::Chart-->
                        <div class="d-flex flex-center w-75 chart" style="min-width: 250px;">
                            <div class="w-100" style="max-width:305px">
                                {!! $RegisterChart->container() !!}
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <div class="text-muted fs-7 fw-bold">Register</div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6 ">
        <!--begin::Card-->										
        <div class="card mb-2 " style="height:225px">
            <!--begin::Card body-->
            <div class="card-body card-p-chart">
               
                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between ">
                        <!--begin::Labels-->
                        <div class="d-flex flex-column justify-content-between">
                             <!--begin::Heading-->
                             <div class="fs-4 fw-bold text-gray-400 mb-7 ">All {{ Auth::user()->branch->province_name }} Policies</div>
                            <div class="fs-3 fw-bolder">{{ $total_polis_perbranch }} Policies</div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Labels-->
                        <!--begin::Chart-->
                        <div class="d-flex flex-center w-75" style="min-width: 250px;">
                            <div class="w-100" style="max-width:305px">
                                {!! $PolishChart->container() !!}
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <div class="text-muted fs-7 fw-bold">Policies</div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Col-->
     <!--begin::Col-->
     <div class="col-xl-6 ">
        <!--begin::Card-->										
        <div class="card mb-2 " style="height:225px">
            <!--begin::Card body-->
            <div class="card-body card-p-chart">
               
                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between ">
                        <!--begin::Labels-->
                        <div class="d-flex flex-column justify-content-between">
                             <!--begin::Heading-->
                             <div class="fs-4 fw-bold text-gray-400 mb-7 ">All Register Risk</div>
                            <div class="fs-3 fw-bolder">{{ $registerSurvey->count() }} Risk</div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Labels-->
                        <!--begin::Chart-->
                        <div class="d-flex flex-center w-75" style="min-width: 250px;">
                            <div class="w-100" style="max-width:305px">
                                {!! $RiskChart->container() !!}
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <div class="text-muted fs-7 fw-bold">Risk</div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6 ">
        <!--begin::Card-->										
        <div class="card mb-2 " style="height:225px">
            <!--begin::Card body-->
            <div class="card-body card-p-chart">
               
                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between ">
                        <!--begin::Labels-->
                        <div class="d-flex flex-column justify-content-between">
                             <!--begin::Heading-->
                             <div class="fs-4 fw-bold text-gray-400 mb-7 ">All Claim</div>
                            <div class="fs-3 fw-bolder">{{ $total_register_claim_perbranch }} Claim</div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Labels-->
                        <!--begin::Chart-->
                        <div class="d-flex flex-center w-75" style="min-width: 250px;">
                            <div class="w-100" style="max-width:305px">
                                {!! $ClaimChart->container() !!}
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <div class="text-muted fs-7 fw-bold">Claim</div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

<div class="row pt-8">
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">List Register Claim</span>
            </h3>
        </div> --}}
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped gy-7 gs-7']) }}
        </div>
    </div>
</div>

<div class="row pt-8">
    <div class="col-12">
        <!--begin::Calendar Widget 1-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Kalender Survey</span>
                <span class="text-muted mt-1 fw-bold fs-7">Lihat Jadwal Survey Digital</span>
            </h3>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Calendar-->
            <div id="survey_calender"></div>
            <!--end::Calendar-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Calendar Widget 1-->
    </div>
</div>

<!-- modal delete -->
<div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
    <form action='{{ route('register-claim.create', ['id' => Auth::user()->id_user]) }}' method="post"  enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Add Register Claim</h2>
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
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>No Polis</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid @error('no_polis') is-invalid @enderror" required placeholder="" name="no_polis" value="" />
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Register Number</span>
                                    </label>
                                    <select class="form-select form-select-solid @error('id_register_survey') is-invalid @enderror" required data-control="select2" name="id_register_survey" data-placeholder="Select an option" data-hide-search="true">
                                        <option></option>
                                        @foreach($registerSurvey as $br)
                                            <option value="{{$br->id_register_survey}}">{{ $br->register_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Costumer Name</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid @error('customer_name') is-invalid @enderror" required placeholder="" name="customer_name" value="" />
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Phone Number</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid @error('phone_number') is-invalid @enderror" required placeholder="" name="phone_number" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Email Address</span>
                                    </label>
                                    <input type="email" class="form-control form-control-solid @error('email') is-invalid @enderror" required placeholder="" name="email" value="" />
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Vehicle Brands</span>
                                    </label>
                                    <select class="form-select form-select-solid @error('id_vehicle') is-invalid @enderror" required data-control="select2" name="id_vehicle" data-placeholder="Select an option" data-hide-search="true">
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
                                    <input type="text" class="form-control form-control-solid @error('type') is-invalid @enderror" required placeholder="" name="type" value="" />
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Year Vehicle</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid @error('year') is-invalid @enderror" required placeholder="" name="year" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Plat No</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid @error('plat_no') is-invalid @enderror" required placeholder="" name="plat_no" value="" />
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span>Branch</span>
                                    </label>
                                    <select class="form-select form-select-solid @error('id_branch') is-invalid @enderror" required data-control="select2" name="id_branch" data-placeholder="Select an option" data-hide-search="true">
                                        <option></option>
                                        @foreach($branch as $br)
                                            <option value="{{$br->id_branch}}">{{ $br->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">Submit
                    </button>
                </div>
                
            </div>
        </div>
    </form>
</div>
<!-- modal schedule -->
<div class="modal fade editSchedule" tabindex="-1" id="kt_schedule">
    <form action='{{ route('register-claim.schedule') }}' method="post" id="form-update" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Schedule Register Claim</h5>
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
                            <input class="form-control form-control-solid @error('survey_date') is-invalid @enderror" required name="survey_date" placeholder="Pick date" id="kt_datepicker_10"/>
                            @error('survey_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
    
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- modal delete -->
<div class="modal fade deleteSurvey" id="kt_modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <form action='{{ route('register-claim.deleteClaim') }}' method="post" id="form-update" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="flex-column">
                            <div class="modal-header border-0 text-center mt-5 justify-content-center">
                                <i class="bi bi-x-circle fs-5x text-danger"></i>
                            </div>						
                            <h4 class="modal-title w-100 text-center">Are you sure?</h4>
                        </div>
                        <div class="modal-body text-center">
                            <p>Do you really want to delete these records?<br> This process cannot be undone.</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light btn-sm">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
<!-- modal schedule report -->
<div class="modal fade reportSurvey" id="kt_report" tabindex="-1" aria-hidden="true">
    <form action='{{ route('register-claim.report')}}' method="post"  enctype="multipart/form-data">
        @csrf
        @method('post')
        <input type="hidden" name="id">
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Realtime Claim report</h2>
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
                        <div class="card pt-4 mb-xl-9">
                            <div id="kt_customer_view_payment_method" class="card-body pt-0">
                                <div class="d-flex flex-wrap py-2">
                                    <div class="flex-equal me-5">
                                        <table class="table table-flush fw-bold gy-2">
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">No Polis</td>
                                                <td class="text-gray-800" id="no_polis"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">No Register</td>
                                                <td class="text-gray-800" id="no_register"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Costumer name</td>
                                                <td class="text-gray-800" id="customer_name"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Vehicle Brand</td>
                                                <td class="text-gray-800" id="vehicle_brand_report"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Vehicle Type</td>
                                                <td class="text-gray-800" id="vehicle_type_report"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Year</td>
                                                <td class="text-gray-800" id="year_reporting_survey"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Plat No</td>
                                                <td class="text-gray-800" id="plat_no"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="flex-equal">
                                        <table class="table table-flush fw-bold gy-2">
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Surveyor</td>
                                                <td class="text-gray-800" id="surveyor"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Survey Date</td>
                                                <td class="text-gray-800" id="survey_date"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Location</td>
                                                <td class="text-gray-800" id="location"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Register Date</td>
                                                <td class="text-gray-800" id="register_date">08/10/2022</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="separator separator-dashed mt-5 mb-10"></div>
                                <!-- list vehicle -->
                                @foreach ($part as $key => $item )
                                    <div class="py-0" data-kt-customer-payment-method="row">
                                        <div class="py-3 d-flex flex-stack flex-wrap">
                                            <div class="d-flex align-items-center collapsible rotate" data-bs-toggle="collapse" href="#kt_customer_view_payment_method_{{ $key }}" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_{{ $key }}">
                                                <div class="me-3 rotate-90">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <img class="me-10" />
                                                <div class="me-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="text-gray-800 fw-bolder">{{ $item->type_nama }}</div>
                                                    </div>
                                                    <div class="text-muted">Harap Isi </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="kt_customer_view_payment_method_{{ $key }}" class="collapse {{ $key === 0 ? 'show' : '' }} fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method">
                                            <div class="d-flex flex-wrap py-5">
                                                <div class="d-flex flex-wrap py-5">
                                                    <!-- content -->
                                                    <div class="table-responsive">
                                                        <table class="table gs-7 gy-7 gx-7">
                                                         <thead>
                                                          <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                                           <th>No</th>
                                                           <th>Part</th>
                                                           <th>Non Standard</th>
                                                           <th>Description</th>
                                                           <th>Action</th>
                                                          </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($item->children as $keychild => $sub)
                                                            <tr>
                                                                <td>{{ $sub->id_part }}</td>
                                                                <td>{{ $sub->part_nama }}</td>
                                                                <td>
                                                                    <input type="checkbox" value="true" name="isStandard[{{$sub->id_part}}][value]" />
                                                                    <input type="hidden" value="{{ $sub->id_part }}" name="isStandard[{{$sub->id_part}}][id_part]" />
                                                                </td>
                                                                <td>
                                                                    <input type="text" value="{{ $sub->description }}" name="description[{{$sub->id_part}}][value]" />
                                                                    <input type="hidden" value="{{ $sub->id_part }}" name="description[{{$sub->id_part}}][id_part]" />
                                                                </td>
                                                                <td>
                                                                    <input class="photo" type="file" name="photo[{{$sub->id_part}}][value]" accept=".jpg, .jpeg">
                                                                    <input type="hidden" value="{{ $sub->id_part }}" name="photo[{{$sub->id_part}}][id_part]" />
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                         </tbody>
                                                        </table>
                                                       </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                @endforeach
                                <div class="separator separator-dashed"></div>

                                <!-- end list vehicle -->

                                <div class="flex-equal mt-10">
                                    <table class="table table-flush fw-bold gy-1">
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Upload Video Report</td>
                                            <td class="text-gray-800">
                                                <input type="file" name="videoUpload" accept=".mp4, .mkv , .mov , .avi" required>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">Save
                    </button>
                </div>
                
            </div>
        </div>
    </form>
</div>
<!-- modal schedule report view -->
<div class="modal fade reportSurveyView" id="kt_report_view" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Realtime claim report</h2>
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
                        <div class="card pt-4 mb-xl-9">
                            <div id="kt_customer_view_payment_method" class="card-body pt-0">
                                <div class="d-flex flex-wrap py-2">
                                    <div class="flex-equal me-5 table-responsive-lg" style="min-width: 290px;">
                                        <table class="table table-flush fw-bold gy-2">
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">No Polis</td>
                                                <td class="text-gray-800" id="no_polis_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">No Register</td>
                                                <td class="text-gray-800" id="no_register_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Costumer name</td>
                                                <td class="text-gray-800" id="customer_name_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Vehicle Brand</td>
                                                <td class="text-gray-800" id="vehicle_brand_report_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Vehicle Type</td>
                                                <td class="text-gray-800" id="vehicle_type_report_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Year</td>
                                                <td class="text-gray-800" id="year_reporting_survey_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Plat No</td>
                                                <td class="text-gray-800" id="plat_no_view"></td>
                                            </tr>
                                        </table>
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon1">Link</span>
                                            <input type="text" id="link_report_schedule_view" class="form-control" placeholder="Link Report Video" aria-label="Link Report Video" aria-describedby="basic-addon1"/>
                                        </div>
                                    </div>
                                    <div class="flex-equal">
                                        <table class="table table-flush fw-bold gy-2">
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Surveyor</td>
                                                <td class="text-gray-800" id="surveyor_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Survey Date</td>
                                                <td class="text-gray-800" id="survey_date_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Location</td>
                                                <td class="text-gray-800" id="location_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Register Date</td>
                                                <td class="text-gray-800" id="register_date_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted min-w-125px w-125px">Status</td>
                                                <td class="text-gray-800" id="status_view"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="separator separator-dashed mt-5 mb-10"></div>
                                <!-- list vehicle -->
                                @foreach ($part as $key => $item )
                                    <div class="py-0" data-kt-customer-payment-method="row">
                                        <div class="py-3 d-flex flex-stack flex-wrap">
                                            <div class="d-flex align-items-center collapsible rotate" data-bs-toggle="collapse" href="#kt_customer_view_payment_method_{{ $key }}" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_{{ $key }}">
                                                <div class="me-3 rotate-90">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <img class="me-10" />
                                                <div class="me-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="text-gray-800 fw-bolder">{{ $item->type_nama }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="kt_customer_view_payment_method_{{ $key }}" class="collapse {{ $key === 0 ? 'show' : '' }} fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method">
                                            <div class="d-flex flex-wrap py-5">
                                                <div class="d-flex flex-wrap py-5">
                                                    <!-- content -->
                                                    <div class="table-responsive">
                                                        <table class="table gs-7 gy-7 gx-7">
                                                         <thead>
                                                          <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                                           <th>No</th>
                                                           <th>Part</th>
                                                           <th>Non Standard</th>
                                                           <th>Description</th>
                                                           <th>Action</th>
                                                          </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($item->children as $key => $sub)
                                                            <tr>
                                                                <td>{{ $sub->id_part }}</td>
                                                                <td>{{ $sub->part_nama }}</td>
                                                                <td>
                                                                    <input type="checkbox" disabled id="checkbox_view_{{$sub->id_part}}" value="true"  />
                                                                </td>
                                                                <td>
                                                                    <span id="description_view_{{$sub->id_part}}"></span>
                                                                </td>
                                                                <td>
                                                                    <div class="image-input image-input-outline me-6" data-kt-image-input="true">
                                                                    <div id="photo_view_{{$sub->id_part}}" class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('/media/png/avatar-default.png') }})"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                         </tbody>
                                                        </table>
                                                       </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                @endforeach
                                <div class="separator separator-dashed"></div>

                                <!-- end list vehicle -->
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Cancel</button>
                </div>
                
            </div>
        </div>
</div>  



<script src="{{ $RegisterChart->cdn() }}"></script>
<script src="{{ $PolishChart->cdn() }}"></script>
<script src="{{ $ClaimChart->cdn() }}"></script>
<script src="{{ $RiskChart->cdn() }}"></script>

{{ $RegisterChart->script() }}
{{ $PolishChart->script() }}
{{ $ClaimChart->script() }}
{{ $RiskChart->script() }}


@push('scripts')
{{ $dataTable->scripts() }}
<script>
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const element = document.getElementById("survey_calender");

    var todayDate = moment().startOf("day");
    var YM = todayDate.format("YYYY-MM");
    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
    var TODAY = todayDate.format("YYYY-MM-DD");
    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

    var calendarEl = document.getElementById("survey_calender");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },

        height: 800,
        contentHeight: 780,
        aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

        nowIndicator: true,
        now: TODAY + "T09:25:00", // just for demo

        views: {
            dayGridMonth: { buttonText: "month" },
            timeGridWeek: { buttonText: "week" },
            timeGridDay: { buttonText: "day" }
        },

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        navLinks: true,
        events: '{{ route('meetSchedule.json') }}'
    });

    calendar.render();

    const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);

    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }

    function formatDate(date) {
    return [
        date.getFullYear(),
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
    ].join('-');
    }

    $("#kt_datepicker_10").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        disable: [
            {
                from: "0001-01-01",
                to: formatDate(yesterday)
            },
        ]
    });
    $(document).on('click','#kt_schedule_mod', function(){
        var id = $(this).data('id');
        $('.editSchedule').find('input[name="id"]').val(id);
    });

    $(document).on('click','#kt_delete_mod', function(){
        var id = $(this).data('id');
        $('.deleteSurvey').find('input[name="id"]').val(id);
    });

    $(document).on('click','#kt_report_mod', function(){
        var id = $(this).data('id');
        $('.reportSurvey').find('input[name="id"]').val(id);
        $.post('<?= route("register-claim.details") ?>',{"id":id , "_token":"{{ csrf_token() }}"}, function(data){
                    //  console.log(data.details.register_no);
                    $('#no_polis').html(data.details.no_polis);
                    $('#no_register').html(data.details.register_survey.register_no);
                    $('#customer_name').html(data.details.customer.customer_name);
                    $('#surveyor').html(data.details.surveyor);
                    $('#survey_date').html(data.details.survey_date);
                    $('#location').html(data.details.branch.province_name);
                    $('#register_date').html(data.details.created_at);
                    $('#vehicle_brand_report').html(data.details.vehicle.nama);
                    $('#vehicle_type_report').html(data.details.type);
                    $('#year_reporting_survey').html(data.details.year);
                    $('#plat_no').html(data.details.plat_no);

        },'json');
    });

    $(document).on('click','#kt_report_view_mod', function(){
            var id = $(this).data('id');
            $('.reportSurveyView').find('input[name="id"]').val(id);
            $.post('<?= route("register-claim.details") ?>',{"id":id , "_token":"{{ csrf_token() }}"}, function(data){
                let objDesc = JSON.parse(data.details.descriptionVehicle);
                var resultDesc = Object.keys(objDesc).map((key) => objDesc[key]);

                for (let index = 0; index < resultDesc.length; index++) {
                    const element = resultDesc[index];
                    $(`#description_view_${element.id_part}`).html(element.value);
                }

                let objCheckbox = JSON.parse(data.details.isStandardVehicle);
                var resultCheckbox = Object.keys(objCheckbox).map((key) => objCheckbox[key]);

                for (let index1 = 0; index1 < resultCheckbox.length; index1++) {
                    const element = resultCheckbox[index1];
                    if (element.value === 'true') {
                        $(`#checkbox_view_${element.id_part}`).prop('checked', true);   
                    }
                }
                
                let objPhoto = JSON.parse(data.details.photoVehicle);
                // var resultPhoto = Object.keys(photoVehicle).map((key) => photoVehicle[key]);

                for (let index2 = 0; index2 < objPhoto.length; index2++) {
                    const element = objPhoto[index2];
                    $(`#photo_view_${element.id_part}`).css("background-image", `url(${element.url ? element.url : '/media/png/avatar-default.png'})`);
                }

                var stats = '';
                if (data.details.status === 'OPEN') {
                    stats = '<a class="btn btn-outline btn-outline-warning btn-active-light-warning btn-sm">Open</a>';
                } else if(data.details.status === 'SCHEDULE') {
                    stats = '<a class="btn btn-outline btn-outline-warning btn-active-light-warning btn-sm">Open</a>';
                } else if(data.details.status === 'DONE') {
                    stats = '<a class="btn btn-outline btn-outline-dark btn-active-light-dark btn-sm">Done</a>';
                }
                
                var url = `${data.details.link_report_zoom}`
                $('#no_polis_view').html(data.details.no_polis);
                $('#no_register_view').html(data.details.register_survey.register_no);
                $('#customer_name_view').html(data.details.customer.customer_name);
                $('#surveyor_view').html(data.details.surveyor);
                $('#survey_date_view').html(data.details.survey_date);
                $('#location_view').html(data.details.branch.province_name);
                $('#register_date_view').html(data.details.created_at);
                $('#vehicle_brand_report_view').html(data.details.vehicle.nama);
                $('#vehicle_type_report_view').html(data.details.type);
                $('#year_reporting_survey_view').html(data.details.year);
                $('#plat_no_view').html(data.details.plat_no);
                $('#status_view').html(stats);
                $('#link_report_schedule_view').val(url);

            },'json');
        });
</script>
@endpush
@endsection
