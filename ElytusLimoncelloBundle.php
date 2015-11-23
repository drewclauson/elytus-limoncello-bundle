<?php

namespace Elytus\LimoncelloBundle;

use Elytus\LimoncelloBundle\DependencyInjection\RegisterEventListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ElytusLimoncelloBundle extends Bundle
{
    public function build(ContainerBuilder $builder)
    {
        $builder->addCompilerPass(new RegisterEventListenersPass());
    }
}
