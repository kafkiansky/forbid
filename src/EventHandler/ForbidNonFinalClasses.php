<?php

declare(strict_types=1);

namespace Kafkiansky\Forbid\EventHandler;

use PhpParser\Node\Stmt\Class_;
use Psalm\CodeLocation;
use Psalm\IssueBuffer;
use Psalm\Plugin\EventHandler\AfterClassLikeAnalysisInterface;
use Psalm\Plugin\EventHandler\Event\AfterClassLikeAnalysisEvent;

final class ForbidNonFinalClasses implements AfterClassLikeAnalysisInterface
{
    /**
     * {@inheritdoc}
     */
    public static function afterStatementAnalysis(AfterClassLikeAnalysisEvent $event)
    {
        if ($event->getStmt() instanceof Class_) {
            $class = $event->getStmt();

            if (false === $class->isAbstract() && false === $class->isFinal() && false === $class->isAnonymous()) {
                IssueBuffer::accepts(
                    new NonFinalClassesAreForbidden(
                        new CodeLocation($event->getStatementsSource(), $event->getStmt()),
                    ),
                    $event->getStatementsSource()->getSuppressedIssues(),
                );
            }
        }
    }
}
