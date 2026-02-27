<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MainHomeController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    
      public function catalog(Request $request)
    {
        $query = DB::table('test');
        
        if($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif($request->sort == 'year_asc') {
            $query->orderBy('year', 'asc');
        } elseif($request->sort == 'year_desc') {
            $query->orderBy('year', 'desc');
        } else {
            $query->orderBy('name', 'asc');
        }
        
        $myproducts = $query->get();

        return view('catalog', ['myproducts' => $myproducts]);
    }
    public function where()
    {
        return view('where');
    }
    
    public function product($id)
    {
        $product = DB::table('test')->where('id', $id)->limit(1)->get();
        return view('product', ['myproducts' => $product]);
    }
    
    public function panel(){
        $yy = DB::table('test')->get();
        $tt = DB::table('test')->orderBy('id', 'DESC')->limit(1)->get();
        return view('panel', ['yy'=> $yy, 'tt'=> $tt]);
    }
    
    public function del(Request $gg){
        DB::table('test')->where('id', $gg->id)->delete();
        return redirect()->back();
    }
    
    public function add(Request $gg){
        DB::table('test')->insert(['name' => $gg->name]);
        return redirect()->back();
    }
    
    public function redact(Request $gg){
        DB::table('test')->where('id', $gg->id)->update(['name' => $gg->name]);
        return redirect()->back();
    }

    public function add_img(Request $request){
        $img = $request->file('image');
        $typeImg = $img->extension();

        $uniqName = Str::uuid();
        $nameImg = $uniqName.'.'.$typeImg;

        $path = 'images';
        $img->move(public_path($path), $nameImg);

        DB::table('test')->insert([
            'name' => $request->name_product,
            'price' => $request->price_product,
            'about' => $request->about_product,
            'year' => $request->year_product,
            'img' => $nameImg,
        ]);

        return redirect(url()->previous())->with(['msg' => 'Карточка с фото добавлена']);
    }
}