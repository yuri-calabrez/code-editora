<?php

namespace CodeEduBook\Jobs;

use CodeEduBook\Models\Book;
use CodeEduBook\Pub\BookExport;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class GenerateBook implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Queueable;
    /**
     * @var Book
     */
    private $book;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        //
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @param BookExport $bookExport
     * @return void
     */
    public function handle(BookExport $bookExport)
    {
        $bookExport->export($this->book);
        $easyBookCmd = "easybook/book publish --no-interaction --dir={$this->book->disk} {$this->book->id}";
        exec("php ".base_path("$easyBookCmd print"));
        exec("php ".base_path("$easyBookCmd kindle"));
        exec("php ".base_path("$easyBookCmd ebook"));
        $bookExport->compress($this->book);
        /*$exeptionCustom = new \Exception("Flalhou Job!!!");
        $this->fail($exeptionCustom);
        throw $exeptionCustom;*/
    }
}
