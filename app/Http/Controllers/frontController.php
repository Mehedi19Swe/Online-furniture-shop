<?php

namespace App\Http\Controllers;

use App\category;
use App\discount;
use App\product;
use App\stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class frontController extends Controller
{
    public function welcome()
    {
        $category = category::all();
        $product = DB::table('products')->orderBy('company', 'desc')->paginate(16);
        $stock = stock::all();
        $discount = discount::all();
        return view('front.index',compact('product','stock','discount','category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        if ($request->category == 0){
            if ($request->content == null){
                return redirect()->back();
            }else{
                $category = category::all();
                $stock = stock::all();
                $discount = discount::all();
                $product = DB::table('products')
                    ->where('name', 'like', '%'.$request->content.'%')
                    ->orderBy('company', 'desc')->paginate(16);
                return view('front.result',compact('product','stock','discount','category'));
            }
        }else{
            if ($request->content == null){
                $category = category::all();
                $stock = stock::all();
                $discount = discount::all();
                $product = DB::table('products')
                    ->where('category',$request->category)
                    ->orderBy('company', 'desc')->paginate(16);
                return view('front.result',compact('product','stock','discount','category'));
            }
            else{
                $stock = stock::all();
                $discount = discount::all();
                $category = category::all();
                $product = DB::table('products')
                    ->where('name', 'like', '%'.$request->content.'%')
                    ->where('category',$request->category)
                    ->orderBy('company', 'desc')->paginate(16);
                return view('front.result',compact('product','stock','discount','category'));
            }
        }
    }

    public function singleProductView($id)
    {
        $product = product::where('id',$id)->get()->first();
        $relProduct = DB::table('products')->where('category',$product->category)->paginate(4);

        return view('front.product-single',compact('product','relProduct'));
    }

    public function checkout(){
        return view('front.checkout');
    }

    public function check(){
        return view('front.check');
    }
    public function about(){
        return view('front.about');
    }
    public function contact(){
        return view('front.contact');
    }

}
