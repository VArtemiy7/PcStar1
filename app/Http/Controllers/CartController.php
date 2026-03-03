<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cart()
    {
        $uu = DB::table('cart')
            ->select('users.name as u_name', 'test.name as t_name', 'count', 'cart.id as cart_id', 'cart.id_tovar as product_id')
            ->join('users', 'users.id', 'cart.id_user')
            ->join('test', 'test.id', 'cart.id_tovar')
            ->where('cart.id_user', auth()->id())
            ->where('cart.status', 'active')
            ->get();

        return view('cart', ['uu' => $uu]);
    }

    private function check($id_user, $id_tovar){
        return DB::table('cart')
            ->where('id_user', $id_user)
            ->where('id_tovar', $id_tovar)
            ->where('status', 'active') 
            ->exists();
    }

    public function add_cart(Request $gg)
    {
        $userId = auth()->user()->id;
        $productId = $gg->id;
        
        
        if($this->check($userId, $productId)){
        
            DB::table('cart')
                ->where('id_user', $userId)
                ->where('id_tovar', $productId)
                ->where('status', 'active')
                ->increment('count');
        } else {
            
            DB::table('cart')->insert([
                'id_user' => $userId,
                'id_tovar' => $productId,
                'count' => 1,
                'status' => 'active'
            ]);
        }

        return redirect(route('cart'))->with('success', 'Товар добавлен в корзину');
    }

    public function delete_cart(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->id;

        DB::table('cart')
            ->where('id_user', $userId)
            ->where('id_tovar', $productId)
            ->where('status', 'active')
            ->delete();

        return redirect()->route('cart')->with('success', 'Товар удален из корзины');
    }
    
    public function add_order()
    {
        $cart_items = DB::table('cart')
            ->where('id_user', auth()->user()->id)
            ->where('status', 'active')
            ->get();

        if($cart_items->isEmpty()){
            return redirect()->back()->with('error', 'Корзина пуста');
        }

        DB::table('order')->insert(['status' => 'active']);
        $order = DB::table('order')->orderBy('id', 'desc')->first();

        foreach($cart_items as $cart_item){
            DB::table('order_cart')->insert([
                'cart_id' => $cart_item->id, 
                'order_id' => $order->id, 
                'id_user' => auth()->id(), 
                'status' => 'active'
            ]);
        }
        
        DB::table('cart')
            ->where('id_user', auth()->user()->id)
            ->where('status', 'active')
            ->update(['status' => 'passive']);

        return redirect()->route('order')->with('success', 'Заказ успешно оформлен');
    }

    public function order()
{
    if(auth()->user()->is_admin == 1) {
        $orders = DB::table('order')->get();
        
        foreach($orders as $order){
            $order->product = DB::table('order_cart')
                ->select(
                    'users.name as user_name',
                    'users.surname as user_surname',
                    'test.name as product_name',
                    'cart.count'
                )
                ->join('cart', 'order_cart.cart_id', '=', 'cart.id')
                ->join('test', 'cart.id_tovar', '=', 'test.id')
                ->join('users', 'order_cart.id_user', '=', 'users.id')
                ->where('order_cart.order_id', '=', $order->id)
                ->get();
        }
    } 
    else {

        $orders = DB::table('order')
            ->join('order_cart', 'order.id', '=', 'order_cart.order_id')
            ->where('order_cart.id_user', auth()->id())
            ->select('order.*')
            ->distinct()
            ->get();

        foreach($orders as $order){
            $order->product = DB::table('order_cart')
                ->select(
                    'users.name as user_name',
                    'users.surname as user_surname',
                    'test.name as product_name',
                    'cart.count'
                )
                ->join('cart', 'order_cart.cart_id', '=', 'cart.id')
                ->join('test', 'cart.id_tovar', '=', 'test.id')
                ->join('users', 'order_cart.id_user', '=', 'users.id')
                ->where('order_cart.order_id', '=', $order->id)
                ->where('order_cart.id_user', '=', auth()->id())
                ->get();
        }
    }

    return view('order', compact('orders'));
}
}