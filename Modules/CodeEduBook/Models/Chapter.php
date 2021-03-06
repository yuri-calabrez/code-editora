<?php

namespace CodeEduBook\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model implements TableInterface
{
    protected $fillable = [
        'name',
        'content',
        'order',
        'book_id'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }


    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Ordem'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Ordem':
                return $this->order;
        }
    }
}
