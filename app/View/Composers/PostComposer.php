<?php

namespace App\View\Composers;

use Illuminate\View\View;
class PostComposer {

    public function compose(View $view)
    {
        $view->with('marca2', 'Este es una marca temporal 2...');
    }
}