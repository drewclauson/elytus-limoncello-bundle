<?php

namespace Elytus\LimoncelloBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ElytusLimoncelloBundle extends Bundle
{
    public function build(ContainerBuilder $builder)
    {
        $builder->addCompilerPass(new RegisterEventListenersPass());
    }
}
