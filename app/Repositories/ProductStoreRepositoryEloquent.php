<?php

namespace CodePub\Repositories;


use CodeEduBook\Repositories\BookRepositoryEloquent;
use CodeEduStore\Models\ProductStore;
use CodeEduStore\Repositories\CategoryRepository;
use CodeEduStore\Repositories\ProductRepository;

class ProductStoreRepositoryEloquent extends BookRepositoryEloquent implements ProductRepository
{
    private $categoryRepository;

    public function home()
    {
        //return $this->model->where('published', 1)->paginate(12)->items();
        return $this->model->where('published', 1)->take(12)->get();
    }

    public function findByCategory($categoryId)
    {
        $category = $this->categoryRepository->find($categoryId);
        return $category->books()->where('published', 1)->get();
    }

    public function boot()
    {
        $this->categoryRepository = app(CategoryRepository::class);
        parent::boot();
    }

    public function like($search)
    {
        return $this->model->where('title', 'like', "%$search%")->where('published', 1)->get();
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlugOrFail($slug);
    }

    public function makeProductStore($id)
    {
        $book = $this->find($id);

        $productStore = new ProductStore();
        $productStore->setId($book->id)
            ->setName($book->title)
            ->setPrice($book->price)
            ->setOriginalProduct($book);

        return $productStore;
    }
}