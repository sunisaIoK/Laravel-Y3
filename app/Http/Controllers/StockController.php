<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\Factory;
use App\Models\Unit;

class StockController extends Controller
{
    public function index()
    {

        $products = Product::latest()
            ->join('type_products', 'products.Type_product_id', '=', 'type_products.Type_Id')
            ->join('factories', 'products.Factory_id', '=', 'factories.Fac_Id')
            ->join('units', 'products.Unit_id', '=', 'units.Un_Id')
            ->select('products.*', 'type_products.Type_Name', 'factories.Fac_Name','units.Un_Name')
            ->paginate(20);

        $typeProducts = TypeProduct::all();
        $factories = Factory::all();
        $units = Unit::all();

        return view('index', compact('products', 'typeProducts', 'factories','units'));
    }


    public function Stock(Request $request)
    {
        $name = $request->input('Pro_Name');
        $type = $request->input('Type_product_id');
        $factory = $request->input('Factory_id');
        $dateTime = $request->input('Pro_OnDate');
        $price = $request->input('Pro_Price');
        $unit = $request->input('Unit_id');
        $amount = $request->input('Pro_Amount');
        $image = $request->file('file');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);


        $product = new Product();
        $product->Pro_Name = $name;
        $product->Type_product_id = $type;
        $product->Factory_id = $factory;
        $product->Pro_OnDate = $dateTime;
        $product->Pro_Price = $price;
        $product->Unit_id = $unit;
        $product->Pro_Amount = $amount;
        $product->Pro_image = $imageName;
        $product->save();


        return back();

    }

    public function searchPro(Request $request)
    {
        $search = $request->input('search');

        $products = Product::latest()
            ->join('type_products', 'products.Type_product_id', '=', 'type_products.Type_Id')
            ->join('factories', 'products.Factory_id', '=', 'factories.Fac_Id')
            ->join('units', 'products.Unit_id', '=', 'units.Un_Id')
            ->select('products.*', 'type_products.Type_Name', 'factories.Fac_Name','units.Un_Name')
            ->where('Pro_Name', 'like', '%' . $search . '%')
            ->paginate(8);

        $typeProducts = TypeProduct::all();
        $factories = Factory::all();
        $units = Unit::all();

        return view('index', ['products' => $products, 'typeProducts' => $typeProducts, 'factories' => $factories, 'units' => $units]);
    }


    public function updatePro(Request $request)
    {
        $validatedData = $request->validate([
            'Pro_Name' => 'required|string|max:255',
            'Pro_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1280',
            'Type_product_id' => 'required',
            'Factory_id' => 'required',
            'Pro_Price' => 'required',
            'Unit_id' => 'required',
            'Pro_Amount' => 'required',
        ]);

        $product = Product::find($request->input('pro_id'));

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $dataToUpdate = [
            'Pro_Name' => $validatedData['Pro_Name'],
            'Type_product_id' => $validatedData['Type_product_id'],
            'Factory_id' => $validatedData['Factory_id'],
            'Pro_Price' => $validatedData['Pro_Price'],
            'Unit_id' => $validatedData['Unit_id'],
            'Pro_Amount' => $validatedData['Pro_Amount'],
        ];
        if ($request->hasFile('Pro_image') && $request->file('Pro_image')->isValid()) {
            $oldImageName = $product->Pro_image;

            $image = $request->file('Pro_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            if ($oldImageName && file_exists(public_path('images') . '/' . $oldImageName)) {
                unlink(public_path('images') . '/' . $oldImageName);
            }

            $dataToUpdate['Pro_image'] = $imageName;
        }


        $product->update($dataToUpdate);

        return redirect()->back()->with('success', 'Product updated successfully');
    }






    public function DelPro(Request $request, $Pro_Id)
    {
        $product = Product::find($Pro_Id);
        if ($product) {
            unlink(public_path('images').'/'.$product->Pro_image);
            $product->delete();
        }

        return back();
    }





    //-------------------ประเภทสินค้า-------------------------- //

    public function TypeProduct(Request $request)
    {
        $name = $request->Type_Name;

        $type = new TypeProduct();
        $type->Type_Name = $name;
        $type->save();

        return back()->with('group_type_added', 'Type Product added successfully');
    }

    public function TP()
    {
        $types = TypeProduct::all();
        $types = TypeProduct::latest()->paginate(10);
        return view('products.typeproduct', compact('types'));
    }

    public function updateType(Request $request)
    {
        $validatedData = $request->validate([
            'Type_Name' => 'required|string|max:255',
        ]);

        $type_id = $request->input('type_id');
        $type = TypeProduct::find($type_id);

        if ($type) {
            $type->Type_Name = $validatedData['Type_Name'];
            $type->save();
            return redirect()->back()->with('success', 'TypeProduct updated successfully');
        } else {
            return redirect()->back()->with('error', 'TypeProduct not found');
        }
    }

    public function searchType(Request $request)
    {
        $search = $request->input('search');
        $types = TypeProduct::where('Type_Name', 'like', '%' . $search . '%')->paginate(10);

        return view('products.typeproduct', ['types' => $types]);
    }


    public function DelType(Request $request, $Type_Id)
    {
        // ตรวจสอบว่ามีการส่งคำร้องขอแบบ DELETE มา
        if ($request->isMethod('delete')) {
            $type = TypeProduct::find($Type_Id);
            if ($type) {
                $type->delete();
            }
        }

        return back();
    }
    //-------------------ประเภทสินค้า-------------------------- //


    //-------------------โรงงาน-------------------------- //

    public function Factory(Request $request)
    {
        $name = $request->Fac_Name;
        $address = $request->Fac_Address;
        $email = $request->Fac_Email;
        $phone = $request->Fac_Phone;

        $fact = new Factory();
        $fact->Fac_Name = $name;
        $fact->Fac_Address = $address;
        $fact->Fac_Email = $email;
        $fact->Fac_Phone = $phone;
        $fact->save();

        return back();

    }

    public function FAC()
    {
        $facts = Factory::all();
        $facts = Factory::latest()->paginate(8);
        return view('products.factory', compact('facts'));
    }

    public function searchFac(Request $request)
    {
        $search = $request->input('search');
        $facts = Factory::where('Fac_Name', 'like', '%' . $search . '%')->paginate(8);

        return view('products.factory', ['facts' => $facts]);
    }

    public function updateFac(Request $request)
    {
        $validatedData = $request->validate([
            'Fac_Name' => 'required|string|max:255',
            'Fac_Address' => 'required|string|max:255',
            'Fac_Email' => 'required|string|max:255',
            'Fac_Phone' => 'required|string|max:10',
        ]);

        $fac_id = $request->input('fac_id');
        $fact = Factory::find($fac_id);

        if ($fact) {
            $fact->Fac_Name = $validatedData['Fac_Name'];
            $fact->Fac_Address = $validatedData['Fac_Address'];
            $fact->Fac_Email = $validatedData['Fac_Email'];
            $fact->Fac_Phone = $validatedData['Fac_Phone'];
            $fact->save();
            return redirect()->back()->with('success', 'Factory updated successfully');
        } else {
            return redirect()->back()->with('error', 'Factory not found');
        }
    }


    public function DelFac(Request $request, $Fac_Id)
    {
        if ($request->isMethod('delete')) {
            $fact = Factory::find($Fac_Id);
            if ($fact) {
                $fact->delete();
            }
        }

        return back();
    }

    public function getFactoryDetails($id) {
        $factory = Factory::find($id);
        return response()->json($factory);
    }


    //-------------------หน่วยนับ-------------------------- //

public function Unit(Request $request)
{
    $name = $request->Un_Name;

    $un = new Unit();
    $un->Un_Name = $name;
    $un->save();

    return back()->with('Unit_added', 'Unit added successfully');
}

public function UN()
{
    $uns = Unit::all();
    $uns = Unit::latest()->paginate(8);
    return view('products.unit', compact('uns'));
}

public function updateUnit(Request $request)
{
    $validatedData = $request->validate([
        'Un_Name' => 'required|string|max:255',
    ]);

    $un_id = $request->input('un_id');
    $un = Unit::find($un_id);

    if ($un) {
        $un->Un_Name = $validatedData['Un_Name'];
        $un->save();
        return redirect()->back()->with('success', 'Unit updated successfully');
    } else {
        return redirect()->back()->with('error', 'Unit not found');
    }
}

public function searchUnit(Request $request)
{
    $search = $request->input('search');
    $uns = Unit::where('Un_Name', 'like', '%' . $search . '%')->paginate(8);

    return view('products.Unit', ['uns' => $uns]);
}


public function DelUnit(Request $request, $Un_Id)
{
    if ($request->isMethod('delete')) {
        $un = Unit::find($Un_Id);
        if ($un) {
            $un->delete();
        }
    }

    return back();
}
//-------------------หน่วยนับ-------------------------- //


public function searchReport(Request $request)
{
    $day = $request->input('search_day');
    $month = $request->input('search_month');

    $products = Product::whereMonth('Pro_OnDate', $month)
                ->whereDay('Pro_OnDate', $day)
                ->join('type_products', 'products.Type_product_id', '=', 'type_products.Type_Id')
                ->join('factories', 'products.Factory_id', '=', 'factories.Fac_Id')
                ->join('units', 'products.Unit_id', '=', 'units.Un_Id')
                ->select('products.*', 'type_products.Type_Name', 'factories.Fac_Name','units.Un_Name')
                ->get();

            $typeProducts = TypeProduct::all();
            $factories = Factory::all();
            $units = Unit::all();

                return view('report', ['products' => $products, 'typeProducts' => $typeProducts, 'factories' => $factories, 'units' => $units]);
}



public function showReportForm() {
    return view('report');
}

public function generateReport(Request $request) {
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $products = Product::whereBetween('Pro_OnDate', [$startDate, $endDate])
                ->join('type_products', 'products.Type_product_id', '=', 'type_products.Type_Id')
                ->join('factories', 'products.Factory_id', '=', 'factories.Fac_Id')
                ->join('units', 'products.Unit_id', '=', 'units.Un_Id')
                ->select('products.*', 'type_products.Type_Name', 'factories.Fac_Name','units.Un_Name')
                ->get();

    return view('report', compact('products'));
}


public function getChartData(Request $request) {
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

    return view('graph', compact('formattedDataByType', 'formattedDataByFactory','formattedDataByMonth'));
}


}

