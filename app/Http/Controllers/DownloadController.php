<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDF;

class DownloadController extends Controller
{

    public function PDFdownload(Request $request)
{
    $day = $request->input('search_day');
    $month = $request->input('search_month');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');


    $query = Product::join('type_products', 'products.Type_product_id', '=', 'type_products.Type_Id')
                    ->join('factories', 'products.Factory_id', '=', 'factories.Fac_Id')
                    ->join('units', 'products.Unit_id', '=', 'units.Un_Id')
                    ->select('products.*', 'type_products.Type_Name', 'factories.Fac_Name','units.Un_Name');


    if (!empty($startDate) && !empty($endDate)) {
        $query->whereBetween('Pro_OnDate', [$startDate, $endDate]);

    } elseif (!empty($day) && !empty($month)) {

        $query->whereMonth('Pro_OnDate', $month)
              ->whereDay('Pro_OnDate', $day);
    }
    $products = $query->get();
    $pdf = PDF::loadView('pdf_report', compact('products'));
    $pdf->setPaper('a4', 'landscape');

    return $pdf->download('product_report.pdf');
}

}
