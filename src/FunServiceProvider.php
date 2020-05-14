<?php

namespace M1guelpf\Fun;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use M1guelpf\Fun\Http\FunController;

class FunServiceProvider extends ServiceProvider
{
    const PATHS = [
        '.env',
        'wp-login.php',
        'wp-admin',
        'admin.php',
        'xmlrpc.php',
        'admin',
    ];

    const FUN = [
        'https://www.youtube.com/watch?v=wbby9coDRCk',
        'https://www.youtube.com/watch?v=nb2evY0kmpQ',
        'https://www.youtube.com/watch?v=eh7lp9umG2I',
        'https://www.youtube.com/watch?v=z9Uz1icjwrM',
        'https://www.youtube.com/watch?v=Sagg08DrO5U',
        'https://www.youtube.com/watch?v=5XmjJvJTyx0',
        'https://www.youtube.com/watch?v=IkdmOVejUlI',
        'https://www.youtube.com/watch?v=jScuYd3_xdQ',
        'https://www.youtube.com/watch?v=S5PvBzDlZGs',
        'https://www.youtube.com/watch?v=9UZbGgXvCCA',
        'https://www.youtube.com/watch?v=O-dNDXUt1fg',
        'https://www.youtube.com/watch?v=MJ5JEhDy8nE',
        'https://www.youtube.com/watch?v=VnnWp_akOrE',
        'https://www.youtube.com/watch?v=jwGfwbsF4c4',
        'https://www.youtube.com/watch?v=8ZcmTl_1ER8',
        'https://www.youtube.com/watch?v=gLmcGkvJ-e0',
        'https://www.youtube.com/watch?v=hGlyFc79BUE',
        'https://www.youtube.com/watch?v=xA8-6X8aR3o',
        'https://www.youtube.com/watch?v=7R1nRxcICeE',
        'https://www.youtube.com/watch?v=sCNrK-n68CM',
    ];

    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            $this->registerRoutes();
        }
    }

    protected function registerRoutes()
    {
        collect(static::PATHS)
            ->reject(fn ($path) => Route::exists($path))
            ->each(fn ($path) => Route::redirect($path, FunController::class));
    }
}
