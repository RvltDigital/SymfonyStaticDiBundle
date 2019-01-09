<?php

namespace RvltDigital\StaticDiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RvltDigitalStaticDiBundle extends Bundle
{
    public function boot()
    {
        parent::boot();
        StaticDI::setContainer($this->container);
    }
}
