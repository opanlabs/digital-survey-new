<html>
    <head>
        <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>
    </head>  
    <body>
        <h1>Realtime Claim Report</h1>
        @foreach($query as $key => $data)
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>No Polis</strong>&nbsp; </span>:&nbsp; {{ $data->no_polis }}
            </span>
        </p>
        <p>
            <span style="font-family: 'book antiqua', palatino, serif;"><span style="font-size: 10pt;">
                <strong>No Register</strong>&nbsp; </span>:&nbsp; {{ $data->register_number }}
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
                <strong>Transmission</strong>&nbsp; </span>:&nbsp; {{ $data->transmission->transmission_name }}
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
        
        @foreach($allCategories as $key => $data)
        <h2>{{ $data->type_nama }}</h2>

        <table>
          <tr>
            <th>NO</th>
            <th>PART</th>
            <th>NON STANDARD</th>
            <th>DESCRIPTION</th>
            <th>PHOTO</th>
          </tr>

            @foreach($data->children as $koy => $field)
                <tr>
                    <td>{{ $field->id_part }}</td>
                    <td>{{ $field->part_nama }}</td>
                    <td>{{ $field->isStandard ? 'Standard' :  'Non Standard' }}</td>
                    <td>{{ $field->description }}</td>
                    <td>
                        <img  src="{{ $field->photoURL }}" height="150" width="150">
                    </td>
                </tr>
            @endforeach  
        </table>
        @endforeach  
    </body>
</html>
