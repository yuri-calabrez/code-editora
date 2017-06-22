<?php

namespace CodeEduBook\Database\Seeders;

use CodeEduBook\Models\Book;
use CodeEduBook\Models\Chapter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        foreach ($books as $book) {
            $chapters = factory(Chapter::class, 5)->make();
            foreach ($chapters as $key => $chapter) {
                $chapter->book_id = $book->id;
                $chapter->order = $key + 1;
                $chapter->save();
            }
        }
    }
}
