<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->user_id = $request->user()->id;
        $product->save();

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    public function show($id, Request $request)
    {
        return Product::find($id);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'data' => 'Not Found',
            ]);  
        }

        if ($product->user_id != $request->user()->id) {
            return response()->json([
                'data' => 'User not update',
            ]);
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    public function destroy($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'data' => 'Not Found',
            ]);  
        }

        if ($product->user_id != $request->user()->id) {
            return response()->json([
                'data' => 'User not update',
            ]);
        }

        $product->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}