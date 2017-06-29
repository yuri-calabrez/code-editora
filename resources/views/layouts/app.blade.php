<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'userId' => Auth::check() ? Auth::user()->id : null
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <?php
    $navbar = Navbar::withBrand(config('app.name'), url("/"))->inverse();
    if (Auth::check()) {
        $arrayLinks = [
            [
                'link' => route('categories.index'),
                'title' => 'Categorias',
                'permission' => 'category-admin/list'
            ],
            [
                'Livros',
                [
                    [
                        'link' => route('books.index'),
                        'title' => 'Listar',
                        'permission' => 'book-admin/list'
                    ],
                    [
                        'link' => route('trashed.books.index'),
                        'title' => 'Lixeira',
                        'permission' => 'book-trahsed-admin/list'
                    ]
                ]
            ],
            [
                'Usuários',
                [
                    [
                        'link' => route('codeeduuser.users.index'),
                        'title' => 'Usuários',
                        'permission' => 'user-admin/list'
                    ],
                    [
                        'link' => route('codeeduuser.roles.index'),
                        'title' => 'Papel de usuário',
                        'permission' => 'role-admin/list'
                    ]
                ]
            ]
        ];

        $links = Navigation::links(\NavbarAuthorization::getLinksAuthorized($arrayLinks));
        $logout = Navigation::links([
            [
                Auth::user()->name,
                [
                    [
                        'link' => url("/logout"),
                        'title' => 'Sair',
                        'linkAttributes' => [
                            'onclick' => "event.preventDefault();document.getElementById(\"logout-form\").submit();"
                        ]
                    ]
                ]
            ]
        ])->right();
        $navbar->withContent($links)->withContent($logout);
    }
    ?>

    {!! $navbar !!}
    {!! Form::open(['url' => url('/logout'), 'id' => 'logout-form', 'style' => 'display:none']) !!}
    {!! Form::close() !!}

    @if(Session::has('message'))
        <div class="container">
            {!! Alert::success(Session::get('message')) !!}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="container">
            {!! Alert::danger(Session::get('error')) !!}
        </div>
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
@stack('scripts')
</body>
</html>
