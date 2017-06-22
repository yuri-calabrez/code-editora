<?php

namespace CodeEduBook\Pub;


use CodeEduBook\Criteria\FindByBook;
use CodeEduBook\Criteria\OrderByOrder;
use CodeEduBook\Models\Book;
use CodeEduBook\Repositories\ChapterRepository;
use CodeEduBook\Util\ExtendedZip;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class BookExport
{
    /**
     * @var ChapterRepository
     */
    private $chapterRepository;
    /**
     * @var Parser
     */
    private $ymlParser;
    /**
     * @var Dumper
     */
    private $ymlDumper;


    /**
     * BookExport constructor.
     */
    public function __construct(ChapterRepository $chapterRepository, Parser $ymlParser, Dumper $ymlDumper)
    {
        $this->chapterRepository = $chapterRepository;
        $this->ymlParser = $ymlParser;
        $this->ymlDumper = $ymlDumper;
    }

    public function export(Book $book)
    {
        $chapters = $this->chapterRepository
            ->pushCriteria(new FindByBook($book->id))
            ->pushCriteria(new OrderByOrder())
            ->all();

        $this->exportContents($book, $chapters);

        file_put_contents("{$book->contents_storage}/dedication.md", $book->dedication);

        $configContents = file_get_contents("{$book->template_config_file}");
        $config = $this->ymlParser->parse($configContents);
        $config['book']['title'] = $book->title;
        $config['book']['author'] = $book->author->name;

        $contents = [];
        foreach ($chapters as $chapter) {
            $contents[] = [
                'element' => 'chapter',
                'number' => $chapter->order,
                'content' => "{$chapter->order}.md"
            ];
        }

        $config['book']['contents'] = array_merge($config['book']['contents'], $contents);

        $yml = $this->ymlDumper->dump($config, 4);
        file_put_contents("{$book->config_file}", $yml);
    }

    public function compress(Book $book)
    {
        ExtendedZip::zipTree($book->output_storage, $book->zip_file, ExtendedZip::CREATE);
    }

    protected function exportContents(Book $book, $chapters)
    {
        if(!is_dir($book->contents_storage)) {
            mkdir($book->contents_storage, 0775, true);
        }

        foreach ($chapters as $chapter) {
            file_put_contents("{$book->contents_storage}/{$chapter->order}.md", $chapter->content);
        }
    }
}