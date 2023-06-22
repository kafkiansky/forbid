<?php

declare(strict_types=1);

namespace Kafkiansky\Forbid\EventHandler;

use Psalm\CodeLocation;
use Psalm\Issue\PluginIssue;

final class NonFinalClassesAreForbidden extends PluginIssue
{
    public function __construct(CodeLocation $codeLocation)
    {
        parent::__construct('Non final classes are forbidden.', $codeLocation);
    }
}
