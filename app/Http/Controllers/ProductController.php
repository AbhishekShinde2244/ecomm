<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Cart;
use App\Models\profile;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    function index()
    {
        $data = Product::latest()
            ->take(10)
            ->get();

        $sliders = Slider::all();

        return view('index', ['products' => $data, 'sliders' => $sliders]);
    }

    function detail($id)
    {
        // Fetch the product with the given ID from the database
        $product = Product::find($id);

        if (!$product) {
            // Handle the case where the product is not found, e.g., show a 404 page
            abort(404);
        }

        $similer = Product::where('category', '=', $product['category'])->get();

        return view('product', ['details' => $product, 'similer' => $similer]);
        // Display the product details, e.g., using a view
        //return view('products.show', ['product' => $product]);
    }

    function search(Request $req)
    {
        $search = Product::where(
            'name',
            'like',
            '%' . $req['query'] . '%'
        )->get();
        $count = Product::where(
            'name',
            'like',
            '%' . $req['query'] . '%'
        )->count();
        return view('search', ['query' => $search, 'count' => $count]);
    }

    function add_to_cart(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new Cart();
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->productId;
            $cart->quantity = $req->quantity;
            $cart->save();
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    function cartItem()
    {
        if (Session::has('user')) {
            $userid = Session::get('user')['id'];
            if ($userid != null) {
                return Cart::where('user_id', $userid)
                    ->where('status', 0)
                    ->count();
            }
        }
    }

    function showCartData()
    {
        if (Session::has('user')) {
            $total = 0;
            $shipping = 0;
            $status = 0;

            $userId = Session::get('user')['id'];
            //  $address = profile::where('user_id', $userId);
            $products = DB::table('cart')
                ->join('products', 'cart.product_id', '=', 'products.id')
                ->where('cart.user_id', $userId)
                ->where('status', 0)
                ->select('products.*', 'cart.*')
                ->get();

            foreach ($products as $item) {
                $total += $item->price;
                $status = $item->status;
            }
            $rupees = $total; // Replace this with your Rupees amount
            $paise = $rupees * 100;

            return view('cart', [
                'items' => $products,
                'Subtotal' => $total,
                'Shipping' => $shipping,
                'Address' => Profile::where('user_id', $userId)->first(),
                'paise' => $paise,
                'status' => $status,
            ]);
        } else {
            return redirect('/login');
        }
    }

    function deleteCartItem($id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        return redirect('/cart');
    }

    function ordernow()
    {
        if (Session::has('user')) {
            $total = 0;
            $shipping = 0;
            $userId = Session::get('user')['id'];
            $products = DB::table('cart')
                ->join('products', 'cart.product_id', '=', 'products.id')
                ->where('cart.user_id', $userId)
                ->select('products.*', 'cart.*')
                ->get();
            foreach ($products as $item) {
                $total += $item->price;
            }

            return view('cart', [
                'items' => $products,
                'Subtotal' => $total,
                'Shipping' => $shipping,
            ]);
        } else {
            return 'Please Login';
        }
    }
}
