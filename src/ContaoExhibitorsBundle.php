<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoExhibitorsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
