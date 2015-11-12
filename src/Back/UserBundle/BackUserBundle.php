<?php

namespace Back\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BackUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
