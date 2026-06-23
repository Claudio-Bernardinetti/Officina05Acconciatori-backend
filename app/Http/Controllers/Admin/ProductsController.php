<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    // ── Lista prodotti nel backoffice ──
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    // ── Form nuovo prodotto ──
    public function create()
    {
        return view('admin.products.create');
    }

    // ── Salva nuovo prodotto ──
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable',
            'price'       => 'nullable|numeric',
            'category'    => 'nullable|max:100',
            'brand'       => 'nullable|max:100',
            'image'       => 'nullable|image|max:4096',
        ]);

        $product = new Product;
        $product->name        = $validated['name'];
        $product->description = $validated['description'] ?? null;
        $product->price        = $validated['price'] ?? null;
        $product->category    = $validated['category'] ?? null;
        $product->brand       = $validated['brand'] ?? null;
        $product->featured    = $request->has('featured');
        $product->active      = $request->has('active') ? true : true; // default attivo

        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Prodotto creato con successo.');
    }

    // ── Form modifica prodotto ──
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // ── Aggiorna prodotto ──
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable',
            'price'       => 'nullable|numeric',
            'category'    => 'nullable|max:100',
            'brand'       => 'nullable|max:100',
            'image'       => 'nullable|image|max:4096',
        ]);

        $product->name        = $validated['name'];
        $product->description = $validated['description'] ?? null;
        $product->price        = $validated['price'] ?? null;
        $product->category    = $validated['category'] ?? null;
        $product->brand       = $validated['brand'] ?? null;
        $product->featured    = $request->has('featured');
        $product->active      = $request->has('active');

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $product->image_path = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Prodotto aggiornato con successo.');
    }

    // ── Elimina prodotto ──
    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();

        return redirect()->back()->with('success', 'Prodotto eliminato con successo.');
    }

    // ── API pubblica per il frontend Vue ──
    // GET /api/products
    public function apiIndex()
    {
        $products = Product::where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($p) {
                return [
                    'id'          => $p->id,
                    'name'        => $p->name,
                    'description' => $p->description,
                    'price'       => $p->price,
                    'category'    => $p->category,
                    'brand'       => $p->brand,
                    'featured'    => $p->featured,
                    'image_url'   => $p->image_path ? asset('storage/' . $p->image_path) : null,
                ];
            });

        return response()->json($products);
    }
}