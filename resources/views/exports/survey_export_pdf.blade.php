<html>
    <body>
        <h1>Realtime survey report</h1>
        @foreach($query as $key => $data)
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>No Register</strong>&nbsp; </span>:&nbsp; {{ $data->register_no }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Costumer Name</strong>&nbsp; </span>:&nbsp; {{ $data->customer->customer_name }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Surveyor</strong>&nbsp; </span>:&nbsp; {{ $data->surveyor }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Survey Date</strong>&nbsp; </span>:&nbsp; {{ $data->survey_date }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Branch</strong>&nbsp; </span>:&nbsp; {{ $data->branch->province_name }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Tanggal Dibuat</strong>&nbsp; </span>:&nbsp; {{ $data->created_at }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Manufaktur</strong>&nbsp; </span>:&nbsp; {{ $data->vehicle->nama }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Vehicle Type</strong>&nbsp; </span>:&nbsp; {{ $data->type }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Colour</strong>&nbsp; </span>:&nbsp; {{ $data->colour }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Transmission AT/MT</strong>&nbsp; </span>:&nbsp; {{ $data->transmission->transmission_name }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Year</strong>&nbsp; </span>:&nbsp; {{ $data->year }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Plat No</strong>&nbsp; </span>:&nbsp; {{ $data->plat_no }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Status</strong>&nbsp; </span>:&nbsp; {{ $data->status }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>Link Report Zoom</strong>&nbsp; </span>:&nbsp; {{ $data->link_report_zoom }}
            </span>
        </p>
        @endforeach
        
    </body>
</html>
