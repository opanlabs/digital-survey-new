<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>{{ config('app.name', 'Jingga Teknologi') }}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

		<!--begin::Custom CSS-->
		<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://use.typekit.net/pkh2tzm.css">
		<!--end::Custom CSS-->
	</head>
	<!--end::Head-->

	
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			
			<!--begin::Page-->
			@auth
			<div class="page d-flex flex-row flex-column-fluid">
				
					@include('components.navbar')
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					@include('components.header')	
			
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="app-container container-fluid">
			@endauth
								<!--begin::Isi Content-->
									@yield('content')
								<!--end::Isi Content-->
			@auth	
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
				
					@include('components.footer')
				</div>
				
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
			@endauth
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->
		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop bg-warning" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		<script>var hostUrl = "";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
		<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('js/widgets.bundle.js') }}"></script>
		<script src="{{ asset('js/custom/widgets.js') }}"></script>
		<script src="{{ asset('js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('js/custom/utilities/modals/upgrade-plan.js') }}"></script>
		<script src="{{ asset('js/custom/utilities/modals/create-app.js') }}"></script>
		<script src="{{ asset('js/custom/utilities/modals/users-search.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
		@stack('scripts')
		<!--end::Page Custom Javascript-->
		<script type="text/javascript">
			$(document).ready(function() {

			

				// show every form error on toaster
				@if ($message = Session::get('message'))
                	toastr.success(@json($message));
        		@endif
				
				/* custom th class on all data table */
				$('.table th').addClass('fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-uppercase');

				/* autocomplete branch */
				$('#branch_AC').select2({
					placeholder: 'Pilih Branch',
					"language": {
						"noResults": function() {
							return "Branch Tidak Ditemukan";
						}
					},
					escapeMarkup: function(markup) {
						return markup;
					},
					ajax: {
						url: '{{ route('branch.autocomplete') }}',
						dataType: 'json',
						delay: 250,
						processResults: function(data) {
							return {
								results: $.map(data, function(branch) {
									return {
										text: branch.province_name,
										id: branch.id_branch
									}
								})
							};
						},
						cache: true
					}
				});
			})
		</script>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>