<?php

namespace BlogUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BlogUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
