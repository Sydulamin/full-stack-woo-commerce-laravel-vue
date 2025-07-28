<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => DB::raw("quantity + {$request->quantity}")]
        );

        return response()->json(['message' => 'Added to cart successfully']);
    }

    public function getCart()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();

        return response()->json($cart);
    }

    public function removeItem($id)
    {
        $item = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $item->delete();

        return response()->json(['message' => 'Item removed']);
    }
}
