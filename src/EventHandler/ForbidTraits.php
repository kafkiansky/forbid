<?php

declare(strict_types=1);

namespace Kafkiansky\Forbid\EventHandler;

use PhpParser\Node\Stmt\Trait_;
use Psalm\CodeLocation;
use Psalm\IssueBuffer;
use Psalm\Plugin\EventHandler\AfterStatementAnalysisInterface;
use Psalm\Plugin\EventHandler\Event\AfterStatementAnalysisEvent;

final class ForbidTraits implements AfterStatementAnalysisInterface
{
    /**
     * {@inheritdoc}
     */
    public static function afterStatementAnalysis(AfterStatementAnalysisEvent $event): ?bool
    {
        if ($event->getStmt() instanceof Trait_) {
            IssueBuffer::accepts(
                new TraitAreForbidden(
                    new CodeLocation($event->getStatementsSource(), $event->getStmt())
                ),
                $event->getStatementsSource()->getSuppressedIssues(),
            );
        }

        return null;
    }
}
