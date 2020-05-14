<?php

namespace M1guelpf\Fun\Http;

use Illuminate\Support\Facades\Response;
use M1guelpf\Fun\FunServiceProvider;

class FunController
{
    public function __invoke()
    {
        return Response::redirectTo(collect(FunServiceProvider::FUN)->random());
    }
}
