<?php

namespace CodeEduStore\Http\Controllers;

use CodeEduStore\Repositories\CategoryRepository;
use CodeEduStore\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $products = $this->productRepository->home();
        return view('codeedustore::store.home', compact('products'));
    }

    public function category($categoryId)
    {
        $category = $this->categoryRepository->find($categoryId);
        $products = $this->productRepository->findByCategory($categoryId);
        return view('codeedustore::store.category', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $products = $this->productRepository->like($search);
        return view('codeedustore::store.search', compact('products'));
    }

    public function showProduct($slug)
    {
        $product = $this->productRepository->findBySlug($slug);
        return view('codeedustore::store.show-product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('codeedustore::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('codeedustore::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
