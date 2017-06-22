<?php

return [
    'name' => 'CodeEduBook',
    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'permissions' => [
            'book_manager_all' => 'book-admin/manage-all'
        ]
    ],
    'book_storage' => env('BOOK_STORAGE_DISK', 'local_book'),
    'book_thumbs' => 'storage/books/thumbs',
];
