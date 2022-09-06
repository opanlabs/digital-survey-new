<table>
    <thead>
    <tr>
        <th><b>No Register</b></th>
        <th><b>Costumer Name</b></th>
        <th><b>Surveyor</b></th>
        <th><b>Survey Date</b></th>
        <th><b>Branch</b></th>
        <th><b>Tanggal Dibuat</b></th>
        <th><b>Vehicle Brand</b></th>
        <th><b>Vehicle Type</b></th>
        <th><b>Year</b></th>
        <th><b>Plat No</b></th>
        <th><b>Status</b></th>
        <th><b>Link Report Zoom</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($query as $key => $data)
        <tr>
            <td>{{ $data->register_survey->register_no }}</td>
            <td>{{ $data->customer->customer_name }}</td>
            <td>{{ $data->surveyor }}</td>
            <td>{{ $data->survey_date }}</td>
            <td>{{ $data->branch->province_name }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->vehicle->nama }}</td>
            <td>{{ $data->vehicle->vehicle_type }}</td>
            <td>{{ $data->year }}</td>
            <td>{{ $data->plat_no }}</td>
            <td>{{ $data->status }}</td>
            <td>{{ $data->link_report_zoom }}</td>
        </tr>
    @endforeach
    </tbody>