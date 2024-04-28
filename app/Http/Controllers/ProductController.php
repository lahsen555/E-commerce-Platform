<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Statistic;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
        $user_id = Auth::user()->id;

        if($id !== null){
            $user = DB::table('statistics')
            ->where('user_id', $user_id)
            ->get();

            if($user->count() == 0){
                $stat = new Statistic();

                $stat->user_id = $user_id;
                $stat->pronum = 0;
                $stat->made = 0;

                $stat->save();
            }
                DB::table('statistics')
                    ->where('user_id', $user_id)
                    ->increment('pronum', 1);
                
                $p = DB::table('products')
                        ->where('id', $id)
                        ->first();
                    
                DB::table('statistics')
                    ->where('user_id', $user_id)
                    ->increment('made', $p->price);
        }

    $stat = Statistic::where('user_id', $user_id)
            ->get();
        $products = Product::where('user_id',  Auth::user()->id)->get();
        return view('product.index', ['products' => $products, 'money'=> $stat, 'pro' => $id]);

    }

    public function index1(Request $request){

        // if ($request->filled('search')) {
        //     $products = Product::search($request->search)->get(); // search by value
        //     // $products = Product::search($request->ville)->get(); // search by ville
        //     $status = $request->input('ville');
        // } else {
        //     $products = Product::all();
        // }

        // return view('welcome', compact('products'));

       if ($request->filled('search')){
            $product2 = Product::search($request->search)->get();

            if($request->filled('ville')){
                $product1 = Product::where( function($query) use($request){
                    return $request->ville ? $query->from('products')->where('origin',$request->ville) : '';
                    })->get();

                if($request->filled('category')){
                    $product3 = Product::where( function($query) use($request){
                        return $request->category ? $query->from('products')->where('category',$request->category) : '';
                    })->get();
                    $product4 = $product1->merge($product2);
                    $products = $product3->merge($product4);
                    $res = count($products);
                    return view('welcome',compact('products'))->with('result', $res);
                    
                }
                    $products = $product1->merge($product2);
                    $res = count($products);
                    return view('welcome',compact('products'))->with('result', $res);
            }else if($request->filled('category')) {
                $product3 = Product::where( function($query) use($request){
                    return $request->category ? $query->from('products')->where('category',$request->category) : '';
                })->get();
                $products = $product3->merge($product2);
                $res = count($products);
                return view('welcome',compact('products'))->with('result', $res);
            }
            $res = count($product2);
            return view('welcome',['products' => $product2, 'result' => $res]);

       }else if($request->filled('ville')){
        
            $product1 = Product::where( function($query) use($request){
                return $request->ville ? $query->from('products')->where('origin',$request->ville) : '';
            })->get();

            if($request->filled('category')){
                $product3 = Product::where( function($query) use($request){
                    return $request->category ? $query->from('products')->where('category',$request->category) : '';
                })->get();
                $products = $product3->merge($product1);
                $res = count($products);
                return view('welcome',compact('products'))->with('result', $res);
                
            }
            $res = count($product1);
            return view('welcome',['products' => $product1])->with('result', $res);
        }else if ($request->filled('category')){
            $products = Product::where( function($query) use($request){
                return $request->category ? $query->from('products')->where('category',$request->category) : '';
            })->get();
            $res = count($products);
            return view('welcome',compact('products'))->with('result', $res);
        }

        if(Auth::guest()){
            return view('welcome',['products' => Product::latest()->get(), 'result' => 0]);
        }

        $cats = DB::table('user_categories')
            ->where('user_id', Auth::user()->id)
            ->pluck('category_id');

        $vils = DB::table('user_cities')
            ->where('user_id', Auth::user()->id)
            ->pluck('city_id');

        

        $ids = DB::table('likes')->where('user_id', Auth::user()->id)->pluck('likeable_id');

        $likcat = Product::whereIn('id', $ids)->pluck('category');

        $catrs = Category::whereIn('id', $cats)->pluck('name');
        $vilrs = City::whereIn('id', $vils)->pluck('name');

        $pros =  Product::whereIn('category', $catrs)->get();

        $pros1 =  Product::whereIn('origin', $vilrs)->get();

        $lipros = Product::whereIn('category', $likcat)->get();

        // $po = $pros->merge($lipros);

        $po = $pros1->concat($pros)->concat($lipros);
        // $po = $po1->merge($pros1);

        

        if($cats->count() == 0 && $lipros->count() == 0 && $vils->count() == 0){
            return view('welcome',['products' => Product::latest()->get(), 'result' => 0]);
        }

        
        // alors on va afficher les autres produits en dessous de la page , est merci 
        
        $pr = $po->merge(Product::latest()->get());
        $allpro = $pr->unique();

       return view('welcome',['products' => $allpro, 'result' => 0]);
        

}

    
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $table1=new User();
        $pro = new Product();

        $pro->name = $request->input('name');
        $pro->origin = $request->input('ville');
        $pro->price = $request->input('price');
        $pro->user_id = Auth::user()->id; // here we have to put the id of the user who created the product
        $file = $request->file('pic');
        $filename = $file->store('pros', 'photo');
        $pro->img = $filename;
        $pro->desc = $request->input('desc');
        $pro->category = $request->input('cat');
        // $pro->like = 0;

        // $files = $request->file('files');
        

        // foreach ($files as $fil) {
        //     $fil->store('uploads', 'photo');
        //     // Do something with the path, such as storing it in a database
        // }
    
        $pro->save();

        // $products = Product::where('user_id', Auth::user()->id)->get();
        return view('dashboard');
    }

    
    public function show(string $id)
    {
        $pro = Product::find($id);
        // //$index = array_search($id, array_column($products, 'id'));
        // if($index === false){
        //     abort(404);
        // }
        $comments = DB::table('comments')
                    ->where('product_id', '=', $id)
                    ->get();
        $sim = DB::table('products')
                    ->where('name', 'LIKE', '%'.$pro->name.'%')
                    ->where('id', '<>', $id)
                    ->get();
        return view('pro', ['pro' => $pro, 'sim'=>$sim, 'comments' => $comments]);

        // return redirect()->route('pro')->with('pro', $pro);
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $product)
    {
        return view('product.edit', ['product' => Product::findOrFail($product)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $product = Product::findOrFail($id);

        // $product->update($request->all());
        $product->name=$request->input('name');
        $product->price =$request->input('price');
        $product->origin =$request->input('ville');
        // $product->img =$request->input('pic');
        $product->desc =$request->input('desc');
        $product->category =$request->input('cat');

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }

    public function getAllProducts()
    {
        $products = Product::latest()->get();
        return $products;
    }

    public function search(Request $request){
        $search = $request->input('search');
  
        $members = Product::where('name', 'like', "$search%")
           ->get();
  
        return view('result')->with('members', $members);
    }

}


// that is it for this controler we are done now we can move to other stuff 
// i don't know why i am i writing this but i really 