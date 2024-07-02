<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\Factory;
use App\Models\Unit;

class ChartController extends Controller
{
    public function Chart(Request $request)
    {
        $products = Product::all();
        return View ('all', ['products' => $products]);
    }

    public function ChartProduct(Request $request)
    {
        $day = $request->input('search_day');
        $month = $request->input('search_month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');



        $query = Product::join('type_products', 'products.Type_product_id', '=', 'type_products.Type_Id')
        ->join('factories', 'products.Factory_id', '=', 'factories.Fac_Id');

        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('products.Pro_OnDate', [$startDate, $endDate]);
        } elseif (!empty($day) && !empty($month)) {
            $query->whereMonth('products.Pro_OnDate', $month)
                ->whereDay('products.Pro_OnDate', $day);
        }

        $chartDataByType = clone $query;
        $chartDataByType = $chartDataByType->selectRaw('type_products.Type_Name as type, COUNT(products.Pro_Id) as count')
        ->groupBy('type_products.Type_Name')
        ->get();

        $chartDataByFactory = clone $query;
        $chartDataByFactory = $chartDataByFactory->selectRaw('factories.Fac_Name as factory, COUNT(products.Pro_Id) as count')
        ->groupBy('factories.Fac_Name')
        ->get();

        $chartDataByMonth = clone $query;
        $chartDataByMonth = $chartDataByMonth->selectRaw('MONTH(products.Pro_OnDate) as month, COUNT(products.Pro_Id) as count')
        ->whereYear('products.Pro_OnDate', now()->year)
            ->groupBy(DB::raw('MONTH(products.Pro_OnDate)'))
            ->get();
        $formattedDataByType = [['Product Type', 'Number of Products']];
        foreach ($chartDataByType as $data) {
            $formattedDataByType[] = [$data->type, $data->count];
        }

        $formattedDataByFactory = [['Factory Name', 'Number of Products']];
        foreach ($chartDataByFactory as $data) {
            $formattedDataByFactory[] = [$data->factory, $data->count];
        }

        $formattedDataByMonth = [['Month', 'Number of Products']];
        foreach ($chartDataByMonth as $data) {
            $formattedDataByMonth[] = [$data->month, $data->count];
        }

        return view('chartproduct', compact('formattedDataByType', 'formattedDataByFactory', 'formattedDataByMonth'));
    }

    public function ChartFactory(Request $request)
    {
        $factories = Factory::all();  // ดึงข้อมูลจากตาราง factories
        return view('factory', compact('factories'));
    }

}
