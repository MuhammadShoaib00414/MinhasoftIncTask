<?php

namespace App\Http\Controllers;


use App\Models\Consignment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Dompdf\Adapter\Identity;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class ConsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $consignments = Consignment::all();

        return view('consignments.index', compact('consignments'));
    }


    public function generate(Request $request)
    {
        // Retrieve the selected IDs from the request
        $selectedIds = $request->input('ids');

        // Retrieve the selected consignments based on the IDs

        if ($request->input('ids') == null) {
            $consignments = Consignment::get();
        } else {
            $selectedIds = $request->input('ids');
            // Retrieve the selected consignments
            $consignments = Consignment::whereIn('id', $selectedIds)->get();
        }


        // Create a new instance of Dompdf
        $dompdf = new Dompdf();

        // Set the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Load the view file into a variable as a string
        $html = view('pdf.pdf', compact('consignments'));

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();


        // Set the desired file name for the PDF
        $filename = Carbon::now().rand().'.pdf';

        // Output the generated PDF as a download
        return $dompdf->stream($filename);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
