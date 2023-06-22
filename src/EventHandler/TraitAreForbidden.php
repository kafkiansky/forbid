<?php

declare(strict_types=1);

namespace Kafkiansky\Forbid\EventHandler;

use Psalm\CodeLocation;
use Psalm\Issue\PluginIssue;

final class TraitAreForbidden extends PluginIssue
{
    public function __construct(CodeLocation $codeLocation)
    {
        parent::__construct('Trait are forbidden.', $codeLocation);
    }
}
