<?php

declare(strict_types=1);

namespace Kafkiansky\Forbid\EventHandler;

use PhpParser\Node\Stmt\Class_;
use Psalm\CodeLocation;
use Psalm\IssueBuffer;
use Psalm\Plugin\EventHandler\AfterClassLikeAnalysisInterface;
use Psalm\Plugin\EventHandler\Event\AfterClassLikeAnalysisEvent;

final class ForbidNonExhaustiveAbstraction implements AfterClassLikeAnalysisInterface
{
    /**
     * {@inheritdoc}
     */
    public static function afterStatementAnalysis(AfterClassLikeAnalysisEvent $event)
    {
        if ($event->getStmt() instanceof Class_ && $event->getStmt()->isAbstract()) {
            foreach ($event->getStmt()->getMethods() as $method) {
                if (false === $method->isFinal() && false === $method->isPrivate() && false === $method->isAbstract()) {
                    IssueBuffer::accepts(
                        new NonExhaustiveAbstractionAreForbidden(
                            new CodeLocation($event->getStatementsSource(), $method),
                        ),
                        $event->getStatementsSource()->getSuppressedIssues(),
                    );
                }
            }
        }
    }
}
