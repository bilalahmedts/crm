<html>
    <head>
        <title>Export Mortgage</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Zip</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Client</th>
                    <th>Project</th>
                    <th>Agent Name</th>
                    <th>Agent HRMSID</th>
					<th>Reporting to</th>
                    <th>Created At</th>
                </tr>
                
            </thead>
            <tbody>
                @php $cout=1; @endphp
                @foreach($saleSolars as $row)
                    <tr>
                        <td>{{$cout++}}</td>
                        <td>{{$row->first_name ?? ''  }}</td>
                        <td>{{$row->last_name ?? '' }}</td>
                        <td>{{$row->phone ?? '' }}</td>
                        <td>{{$row->email ?? '' }}</td>
                        <td>{{$row->address ?? '' }}</td>
                        <td>{{$row->zipcode ?? '' }}</td>
                        <td>{{$row->city ?? '' }}</td>
                        <td>{{$row->state ?? '' }}</td>
                        <td>{{@$row->client->name ?? '' }} </td>
                        <td>{{@$row->project->name ?? '' }} </td>
                        <td>{{@$row->user->name ?? '' }}</td>
                        <td>{{@$row->user->HRMSID ?? '' }}</td>
						<td>{{ $row->user->reporting_to_name->name ?? '' }}</td>
                        <td>{{$row->created_at ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </body>
</html>