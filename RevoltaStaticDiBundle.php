<?php

namespace Revolta\StaticDiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RevoltaStaticDiBundle extends Bundle
{
    public function boot()
    {
        parent::boot();
        StaticDI::setContainer($this->container);
    }
}
