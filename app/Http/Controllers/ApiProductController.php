<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "nama"      => ['required'],
            "deskripsi" => ['required'],
            "harga"     => ['required'],
        ];

        $validated = Validator::make($request->all(),$rules);
        if($validated->fails()) {
            return response()->json([
                "status"    => 403,
                "errors"    => $validated->errors()
            ]);
        }

        $product = Product::create([
            'nama'      => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga'     => $request->input('harga'),
        ]);

        return response()->json([
            'message' => 'Product berhasil dibuat',
            'product' => $product
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }
        return response()->json(['data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        $this->validate($request, [
            'nama'      => 'required',
            'deskripsi' => 'required',
            'harga'     => 'required',
        ]);

        $product->nama      = $request->input('nama');
        $product->deskripsi = $request->input('deskripsi');
        $product->harga     = $request->input('harga');
        $product->save();

        return response()->json([
            'message' => 'Product berhasil diperbarui',
            'product' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        $product->delete();

    return response()->json([
            'message' => 'Product berhasil dihapus'
        ], 200);
    }
}
