@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12 pb-3 text-end">
            <p class="text-right">
                <button type="button" class="btn btn-primary" id="get-consignment-btn">Get Consignment</button>

                <button type="button" class="btn btn-success" id="pdf-generate-btn">PDF Generate</button>

            </p>
        </div>
    </div>
    <div class="row">



        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"></th>
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
                <tbody> @foreach($consignments as $consignment)
                    <tr>

                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck{{$consignment->id}}" value="{{$consignment->id}}">
                            </div>

                        </td>
                        <td>{{ $consignment->id }}</td>
                        <td>{{ $consignment->company }}</td>
                        <td>{{ $consignment->contact }}</td>
                        <td>{{ $consignment->addressline1 }}</td>
                        <td>{{ $consignment->addressline2 }}</td>
                        <td>{{ $consignment->addressline3 }}</td>
                        <td>{{ $consignment->city }}</td>
                        <td>{{ $consignment->country }}</td>
                    </tr> @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('get-consignment-btn').addEventListener('click', getSelectedConsignments);

    function getSelectedConsignments() {

        // Array to store the selected IDs
        var selectedIds = [];

        // Get all checkboxes that are checked
        var checkboxes = document.querySelectorAll('.custom-control-input:checked');

        // Iterate over the checkboxes and push the IDs to the array
        for (var i = 0; i < checkboxes.length; i++) {
            selectedIds.push(checkboxes[i].value);
        }

        // Make the AJAX request to your API
        $.ajax({
            url: '/api/consignments', // Modify the URL if needed
            type: 'GET',
            data: {
                ids: selectedIds
            }, // Pass the selected IDs as a parameter
            success: function(response) {
                // Handle the API response here
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle any errors
                console.log(error);
            }
        });
    }

    document.getElementById('pdf-generate-btn').addEventListener('click', function() {
        // Get the selected checkboxes
        var selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

        // Create an array to store the selected IDs
        var selectedIds = [];

        // Loop through the selected checkboxes and extract the IDs
        selectedCheckboxes.forEach(function(checkbox) {
            selectedIds.push(checkbox.value);
        });

        // Get the CSRF token value from the meta tag
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Make an AJAX request to the server-side endpoint to generate the PDF
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/generate-pdf'); // Replace '/generate-pdf' with your actual endpoint URL
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // Set the CSRF token in the request headers
        xhr.responseType = 'blob';

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Create a download link for the generated PDF
                var downloadLink = document.createElement('a');
                downloadLink.href = window.URL.createObjectURL(xhr.response);
                downloadLink.download = 'consigned_data.pdf'; // Set the desired file name for the PDF
                downloadLink.style.display = 'none';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        };

        xhr.send(JSON.stringify({
            ids: selectedIds
        }));
    });
</script>

@endsection