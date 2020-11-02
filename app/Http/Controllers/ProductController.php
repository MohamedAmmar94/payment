<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("welcome", compact("products"));
    }

    public function getproduct($id,Request $request)
    {
        $product = Product::where("id", $id)->first();
        if (isset($request->id)&&isset($request->resourcePath)) {
            $res = $this->getpaymentstatus($request->resourcePath);
            return view("product", compact("product","res"));
        }
        return view("product", compact("product"));
    }

    public function buy($id)
    {
        $product = Product::where("id", $id)->first();
        // dd($product);
        $response = $this->checkout($product->price);
        $view = view("script_item", compact("response", "id"))->render();
        return response()->json(['html' => $view]);
    }

    public function checkout($price)
    {
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
            "&amount=" . $price .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData = json_decode($responseData, true);
    }

    public function getpaymentstatus($resourcepath)
    {
        $url = "https://test.oppwa.com/";
        $url .= $resourcepath;
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData = json_decode($responseData, true);
    }
}
