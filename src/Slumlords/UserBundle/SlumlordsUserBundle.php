<?php

namespace Slumlords\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SlumlordsUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}