<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Criteria\FindByBook;
use CodeEduBook\Criteria\OrderByOrder;
use CodeEduBook\Http\Requests\ChapterCreateRequest;
use CodeEduBook\Http\Requests\ChapterUpdateRequest;
use CodeEduBook\Models\Book;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\ChapterRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="categories-admin", description="Admnistração de categorias")
 */
class ChaptersController extends Controller
{
    /**
     * @var \CodeEduBook\Repositories\ChapterRepository
     */
    private $repository;
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(ChapterRepository $repository, BookRepository $bookRepository)
    {
        $this->repository = $repository;
        $this->bookRepository = $bookRepository;
        $this->bookRepository->pushCriteria(new FindByAuthor());
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="chapter", description="Capítulos")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Book $book)
    {
        $search = $request->get('search');
        $this->repository->pushCriteria(new FindByBook($book->id))
                            ->pushCriteria(new OrderByOrder());
        $chapters = $this->repository->paginate(10);
        return view('codeedubook::chapters.index', compact('chapters', 'search', 'book'));
    }

    /**
     * @Permission\Action(name="chapter", description="Capítulos")
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('codeedubook::chapters.create', compact('book'));
    }

    /**
     * @Permission\Action(name="chapter", description="Capítulos")
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterCreateRequest $request, Book $book)
    {
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->repository->create($data);
        $url = $request->get('redirectTo', route('chapters.index', ['book' => $book->id]));
        $request->session()->flash('message', 'Capítulo cadastrado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="chapter", description="Capítulos")
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $chapter = $this->repository->find($chapterId);
        return view('codeedubook::chapters.edit', compact('chapter', 'book'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="chapter", description="Capítulos")
     * @param ChapterUpdateRequest $request
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function update(ChapterUpdateRequest $request, Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $data = $request->except('book_id');
        $this->repository->update($data, $chapterId);
        $url = $request->get('redirectTo', route('chapters.index', ['book' => $book->id]));
        $request->session()->flash('message', 'Capítulo editado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="chapter", description="Capítulos")
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $this->repository->delete($chapterId);
        \Session::flash('message', 'Capítulo removido com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
