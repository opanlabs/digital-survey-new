@extends('layout.main')
@section('content')
    <div class="card">
        
        <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">List Report Register Risk Survey</span>
            </h3>
        </div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped gy-7 gs-7']) }}
        </div>
        <!-- modal schedule report view -->
        <div class="modal fade reportSurveyView" id="kt_report_view" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-1000px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Realtime Survey Report</h2>
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
                                                        <td class="text-muted min-w-125px w-125px">No Register</td>
                                                        <td class="text-gray-800" id="no_register_view"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Costumer name</td>
                                                        <td class="text-gray-800" id="customer_name_view"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Manufaktur</td>
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
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Register Date</td>
                                                        <td class="text-gray-800" id="register_date_view"></td>
                                                    </tr>
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
                                                        <td class="text-muted min-w-125px w-125px">Status</td>
                                                        <td class="text-gray-800" id="status_view"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Link Report Excel</td>
                                                        <td class="text-gray-800" id="link_report_schedule_excel_view"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="flex-equal">
                                                <table class="table table-flush fw-bold gy-2">
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Colour</td>
                                                        <td class="text-gray-800" id="colour_view"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Transmission</td>
                                                        <td class="text-gray-800" id="transmission_view"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Link Report PDF</td>
                                                        <td class="text-gray-800" id="link_report_schedule_pdf_view"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Link Report Video</td>
                                                        <td class="text-gray-800" id="link_report_schedule_view"></td>
                                                    </tr>
                                                    <div>
                                                        <p class="text-muted min-w-125px w-125px">Screenshot :</p>
                                                        <img id="link_bukti_meeting_view" src="{{ asset('/media/png/loading.gif') }}" height="250" width="250">
                                                    </div>
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
                                                                            <div id="photo_view_{{$sub->id_part}}" class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('/media/png/no-image-pdf.png') }})"></div>
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
    </div>
    
@endsection

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
    {{$dataTable->scripts()}}
    <script>
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);

        $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         });


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
            $.post('<?= route("register-survey.details") ?>',{id:id}, function(data){
                        //  console.log(data.details.register_no);
                        $('#no_register').html(data.details.register_no);
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
            $.post('<?= route("register-survey.details") ?>',{id:id}, function(data){
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
                    $(`#photo_view_${element.id_part}`).css("background-image", `url(${element.url ? element.url : '/media/png/no-image-pdf.png'})`);
                }

                var stats = '';
                if (data.details.status === 'OPEN') {
                    stats = '<a class="btn btn-outline btn-outline-warning btn-active-light-warning btn-sm">Open</a>';
                } else if(data.details.status === 'SCHEDULE') {
                    stats = '<a class="btn btn-outline btn-outline-warning btn-active-light-warning btn-sm">Open</a>';
                } else if(data.details.status === 'DONE') {
                    stats = '<a class="btn btn-outline btn-outline-dark btn-active-light-dark btn-sm">Done</a>';
                }

                var APP_URL = {!! json_encode(url('/')) !!}

                var link_report_schedule_view = `<a href="${data.details.link_report_zoom}" target="_blank" class="btn btn-outline btn-outline-dark btn-active-light-dark btn-sm">Download Video</a>`;
                var link_report_schedule_excel_view = `<a href="${APP_URL}/dashboard/register-survey/export_excel/${data.details.id_register_survey}" target="_blank" class="btn btn-outline btn-outline-dark btn-active-light-dark btn-sm">Download Excel</a>`;
                var link_report_schedule_pdf_view = `<a href="${APP_URL}/dashboard/register-survey/export_pdf/${data.details.id_register_survey}" target="_blank" class="btn btn-outline btn-outline-dark btn-active-light-dark btn-sm">Download PDF</a>`;
                
                var url = `${data.details.link_report_zoom}`
                $('#no_register_view').html(data.details.register_no);
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
                $('#link_report_schedule_view').html(link_report_schedule_view);
                $('#link_report_schedule_excel_view').html(link_report_schedule_excel_view);
                $('#link_report_schedule_pdf_view').html(link_report_schedule_pdf_view);
                $('#colour_view').html(data.details.colour);
                $('#transmission_view').html(data.details.transmission.transmission_name);
                if(data.details.link_bukti_meeting){
                    $('#link_bukti_meeting_view').attr("src",data.details.link_bukti_meeting);
                }else{
                    $('#link_bukti_meeting_view').attr("src", `${APP_URL}/media/png/no-image.png`);
                }

            },'json');
        });
    </script>
@endpush