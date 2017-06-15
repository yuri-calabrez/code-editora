<?php

namespace CodeEduBook\Http\Requests;


class BookUpdateRequest extends BookCreateRequest
{

    //Não é mais necessario, pois a autorização esta sendo feita por Route model binding em RouteServiceProvider
    /*public function authorize()
    {
        $id = (int) $this->route('book');
        if($id == 0) {
            return false;
        }
        $book = $this->repository->find($id);
        $user = \Auth::user();
        return $user->can('update', $book);
    }*/

}
