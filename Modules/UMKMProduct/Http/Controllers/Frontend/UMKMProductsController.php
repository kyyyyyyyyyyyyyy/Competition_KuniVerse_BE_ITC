<?php

namespace Modules\UMKMProduct\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Modules\ProductCateory\Models\ProductCateory;

class UMKMProductsController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'UMKMProducts';

        // module name
        $this->module_name = 'umkmproducts';

        // directory path of the module
        $this->module_path = 'umkmproduct::frontend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\UMKMProduct\Models\UMKMProduct";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
public function index()
{
    $module_title = $this->module_title;
    $module_name = $this->module_name;
    $module_path = $this->module_path;
    $module_icon = $this->module_icon;
    $module_model = $this->module_model;
    $module_name_singular = Str::singular($module_name);

    $module_action = 'List';

    // Ambil semua produk tanpa filter search
    $products = $module_model::latest()->get(); // Livewire akan handle pagination/filter

    // Ambil semua kategori unik dari database untuk filter kategori
    $categories = ProductCateory::pluck('name')->toArray();

    // Tambahkan opsi "Semua Produk" di awal
    array_unshift($categories, 'Semua Produk');

    // Kirim ke view Livewire
    return view(
        "$module_path.$module_name.index",
        compact(
            'module_title',
            'module_name',
            "products",
            'module_icon',
            'module_action',
            'module_name_singular',
            'categories' // dikirim ke view untuk Livewire category filter
        )
    );
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $id = decode_id($id);

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::findOrFail($id);

        return view(
            "$module_path.$module_name.show",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular")
        );
    }
}
