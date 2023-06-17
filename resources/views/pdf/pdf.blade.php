<html>

<head>
    <style>
        /* Add your custom styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Consignments PDF</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Company</th>
                <th scope="col">Contact</th>
                <th scope="col">Address Line 1</th>
                <th scope="col">Address Line 2</th>
                <th scope="col">Address Line 3</th>
                <th scope="col">City</th>
                <th scope="col">Country</th>
            </tr>
        </thead>
        @foreach($consignments as $consignment)
        <tr>
            <td>{{ $consignment->id }}</td>
            <td>{{ $consignment->company }}</td>
            <td>{{ $consignment->contact }}</td>
            <td>{{ $consignment->addressline1 }}</td>
            <td>{{ $consignment->addressline2 }}</td>
            <td>{{ $consignment->addressline3 }}</td>
            <td>{{ $consignment->city }}</td>
            <td>{{ $consignment->country }}</td>
        </tr>
        @endforeach

    </table>
</body>

</html>
