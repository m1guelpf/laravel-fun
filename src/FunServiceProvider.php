<?php

namespace M1guelpf\Fun;

use Illuminate\Routing\Route;
use M1guelpf\Fun\Http\FunController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route as Router;

class FunServiceProvider extends ServiceProvider
{
    const PATHS = [
        '.env',
        'wp-login',
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
        'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'https://www.youtube.com/watch?v=LnwyycFoKkY',
        'https://www.youtube.com/watch?v=RMMlWvLJBtQ',
        'https://www.youtube.com/watch?v=SkgTxQm9DWM',
        'https://www.youtube.com/watch?v=O2ulyJuvU3Q',
        'https://www.youtube.com/watch?v=yYhj9QYW7bc',
        'https://www.youtube.com/watch?v=croUKrggms8',
        'https://www.youtube.com/watch?v=gfkts0u-m6w',
		'https://www.youtube.com/watch?v=NL6CDFn2i3I',
    ];

    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            $this->registerRoutes();
        }
    }

    protected function registerRoutes()
    {
        $routes = Router::getRoutes()->get('GET');

        collect(static::PATHS)
            ->reject(fn ($path) => $this->routeExists($routes, $path))
            ->each(fn ($path)   => Router::get($path, FunController::class));
    }

    protected function routeExists(array $routes, string $path)
    {
        [$fallbacks, $routes] = collect($routes)->partition(function ($route) {
            return $route->isFallback;
        });

        return $routes->merge($fallbacks)->first(function (Route $route) use ($path) {
            $compiled = $route->compiled ?? $route->toSymfonyRoute()->compile();

            return preg_match($compiled->getRegex(), rawurldecode($path));
        });
    }
}
