<table>
    <thead>
    <tr>
        <th style="text-align: center;vertical-align: middle;"><b>No Polis</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>No Register</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Costumer Name</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Surveyor</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Survey Date</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Branch</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Tanggal Dibuat</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Manufaktur</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Colour</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Transmission</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Vehicle Type</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Year</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Plat No</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Status</b></th>
        <th style="text-align: center;vertical-align: middle;"><b>Link Report Zoom</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($query as $key => $data)
        <tr>
            <td style="text-align: left;">{{ $data->no_polis }}</td>
            <td style="text-align: left;">{{ $data->register_number }}</td>
            <td>{{ $data->customer->customer_name }}</td>
            <td>{{ $data->surveyor }}</td>
            <td>{{ $data->survey_date }}</td>
            <td>{{ $data->branch->province_name }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->vehicle->nama }}</td>
            <td>{{ $data->colour }}</td>
            <td>{{ $data->transmission->transmission_name }}</td>
            <td>{{ $data->type }}</td>
            <td>{{ $data->year }}</td>
            <td>{{ $data->plat_no }}</td>
            <td>{{ $data->status }}</td>
            <td>{{ $data->link_report_zoom }}</td>
        </tr>
    @endforeach
    </tbody>