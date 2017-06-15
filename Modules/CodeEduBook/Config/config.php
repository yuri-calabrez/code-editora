<?php

return [
    'name' => 'CodeEduBook',
    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'permissions' => [
            'book_manager_all' => 'books-admin/manage-all'
        ]
    ]
];
