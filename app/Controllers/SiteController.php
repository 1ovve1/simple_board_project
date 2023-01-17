<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

class SiteController extends AbstractController
{
    function index(): string
    {
        return self::render('welcome');
    }
}