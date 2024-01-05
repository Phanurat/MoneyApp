<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

class updownController extends Controller
{
    public function generatePDF()
    {
        // HTML content to be converted to PDF
        $html = '<h1>Hello, World!</h1>';

        // Create Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generate)
        $dompdf->render();

        // Output PDF to browser or save to file
        return $dompdf->stream('document.pdf');
        // Or save to a file: $dompdf->save('path/to/file.pdf');

        // For Laravel, you might use the response()->stream() method to return the PDF as a response:
        // return response()->stream(function() use ($dompdf) {
        //     echo $dompdf->output();
        // }, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="document.pdf"'
        // ]);
    }
}
