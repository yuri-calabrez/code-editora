<?php

namespace CodeEduStore\Http\Controllers;

use CodeEduStore\Repositories\CategoryRepository;
use CodeEduStore\Repositories\OrderRepository;
use CodeEduStore\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Error\Card;

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
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        OrderRepository $orderRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->orderRepository = $orderRepository;
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

    public function checkout($id)
    {
        $product = $this->productRepository->find($id);
        return view('codeedustore::store.checkout', compact('product'));
    }

    public function process(Request $request, $id)
    {
        $product = $this->productRepository->makeProductStore($id);
        $user = $request->user();
        $token = $request->get('stripeToken');

        try {
            $order = $this->orderRepository->process($token, $user, $product);
            $status = true;
        } catch (Card $e) {
            $status = false;
        }
        return view('codeedustore::store.process', compact('order', 'status'));
    }

    public function orders()
    {
        $orders = $this->orderRepository->all();
        return view('codeedustore::store.orders', compact('orders'));
    }
}
