<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Imports\Products;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /* Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next){
			$this->user = $request->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($this->user->products),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try{
            Excel::import(new Products, $request->file);
            return response()->json([
                'success' => true,
                'message' => __('messages.product.imported', ['count' => $this->user->products()->latest()->count()])
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => __('messages.error')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            $this->user->products()->findOrfail($product->id)->delete();
            return response()->json([
                'success' => true,
                'message' => __('messages.product.deleted')
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => __('messages.error')
            ]);
        }
    }
}
