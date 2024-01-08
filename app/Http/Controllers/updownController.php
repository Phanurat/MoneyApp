<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Carbon\Carbon;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require 'vendor/autoload.php';


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
    }

    public function allTransExport(){
        $user = auth()->user();
        $userdata = DB::table('users')
            ->select('name', 'id', 'fiat_wallet')
            ->where('id', $user->id)->first();
    
        $all_trans = DB::table('transcations')
            ->where('user_name', $userdata->name)
            ->orderByDesc('id_transaction')
            ->get();

        // HTML content for PDF
        $html = '<html lang="th">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<style>';
        $html .= 'body { font-family: "TH Sarabun New", sans-serif; }';
        $html .= '</style>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<h1>ภาษาไทย</h1>';
        $html .= '<table>';
        $html .= '<thead><tr><th>Name</th><th>Value</th><th>Date</th></tr></thead>';
        $html .= '<tbody>';

        foreach ($all_trans as $transaction) {
            $html .= '<tr>';
            $html .= '<td>' . $transaction->name_transaction . '</td>';
            $html .= '<td>' . $transaction->value . '</td>';
            $html .= '<td>' . $transaction->created_at . '</td>';
            $html .= '</tr>';
        }
    
        $html .= '</tbody></table>';
        $html .= '</body>';
        $html .= '</html>';
    
        // Dompdf configuration and rendering
        $options = new Options();
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'TH Sarabun New');
    
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        return $dompdf->stream('all_transactions.pdf');

    }
    
}
?>