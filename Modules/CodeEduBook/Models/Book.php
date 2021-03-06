<?php

namespace CodeEduBook\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Events\BookPreIndexEvent;
use Collective\Html\Eloquent\FormAccessible;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Book extends Model implements TableInterface
{
    use FormAccessible;
    use SoftDeletes;
    use BookStorageTrait;
    use BookThumbnailTrait;
    use Sluggable;
    use SluggableScopeHelpers;
    use Searchable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id',
        'dedication',
        'description',
        'website',
        'percent_complete',
        'published'
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $event = new BookPreIndexEvent($this);
        event($event);

        $array = array_merge($array, ['ranking' => $event->getRanking()]);
        return $array;
    }

    public function author()
    {
        return $this->belongsTo(\CodeEduUser\Models\User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->all();
    }
    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Título', 'Autor', 'Subtitulo', 'Valor'];
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
            case 'Título':
                if (file_exists($this->zip_file)) {
                    $route = route('books.download', ['id' => $this->id]);
                    return "<a href=\"{$route}\" target=\"_blank\" title=\"Download\">{$this->title}</a>";
                } else {
                    return $this->title;
                }
            case 'Autor':
                return $this->author->name;
            case 'Subtitulo':
                return $this->subtitle;
            case 'Valor':
                return number_format($this->price, 2, ',', '.');
        }
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
