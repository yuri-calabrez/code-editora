<?php

namespace CodeEduUser\Facade;


use CodeEduUser\Menu\NavBar;
use Illuminate\Support\Facades\Facade;

class NavbarAuthorization extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NavBar::class;
    }
}