<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\Scan;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class ScanningController extends Controller
{
    public function index(){
        return view('scanning');
    }

    public function makescan(Request $request){

        $this->validate($request,[
            'scan' => 'required|numeric',
        ]);
        $scan = $request['scan'];
        if($scan){
            $scan_row = Scan::where('scancode', $scan)->first();
            $scan_row = $scan_row ? $scan_row : "";
            $product_row = ($scan_row) ? (Product::where('id', $scan_row->product_id)->first()) : "";
            $product_title = $product_row ? $product_row->title : "";
            $new_scancode = (!$product_row) ? 1 : 0;
        }

        return view('scanning', compact('scan', 'product_title', 'new_scancode'));
    }

    public function storescan(Request $request, Scan $scan){
        $this->validate($request,[
            'new_scan' => 'required|numeric',
            'product'=>'required|numeric'
        ]);

        if(isset($request['new_scan']) && isset($request['product'])){
            $scan->insert(
                ['product_id' => $request['product'], 'scancode' => $request['new_scan']]
            );

            $product = Product::where('id', $request['product'])->first();

            $msq = "Скан-код " . $request['new_scan'] . " привязан к продукту " . $product->title . ".";
            session()->flash('message', $msq);
        }

        return redirect()->route('makescan');
    }
}
