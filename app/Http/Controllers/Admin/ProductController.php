<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuServices;
use App\Models\Product;

class ProductController extends Controller
{
    protected $menuServices;
    protected $productService;

    public function __construct(MenuServices $menuServices, ProductAdminService $productService)
    {
        $this->menuServices = $menuServices;
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Hiển thị danh sách sản phẩm';
        $products = $this->productService->get();
        return view('admin.Products.list', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm Sản Phẩm';
        $menus = $this->menuServices->getParent();
        return view('admin.products.add', compact('title', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.edit', [
            'title' => 'Chỉnh sửa sản phẩm',
            'product' => $product,
            'menus' => $this->menuServices->getParent()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}