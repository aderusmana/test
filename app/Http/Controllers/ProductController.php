<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Http::get('http://103.23.235.214/kanaldata/Webservice/bank_method');
        $data = json_decode($product->getBody()->getContents())->data;
        return view('product.index', compact('data'));
    }

    public function store(Request $request)
    {
        $product = Http::post('http://103.23.235.214/kanaldata/Webservice/bank_method');
        $data_json = json_decode($product->getBody()->getContents())->data;

        $data_json = array([
            'id' => 3,
            'name' => $request->name,
            'nickname' => $request->nickname,
            'url' => $request->url,
            'account' => [],
        ]);
        return response()->json($data_json);
    }
}
