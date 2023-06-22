<?php

declare(strict_types=1);

namespace Kafkiansky\Forbid;

use Psalm\Plugin\EventHandler\AfterClassLikeAnalysisInterface;
use Psalm\Plugin\EventHandler\AfterStatementAnalysisInterface;
use Psalm\Plugin\PluginEntryPointInterface;
use Psalm\Plugin\RegistrationInterface;

/**
 * @api
 */
final class Plugin implements PluginEntryPointInterface
{
    public function __invoke(RegistrationInterface $registration, ?\SimpleXMLElement $config = null): void
    {
        foreach (self::hooks() as $hook) {
            /** @psalm-suppress UnresolvableInclude */
            require_once __DIR__ . '/' . str_replace([__NAMESPACE__, '\\'], ['', '/'], $hook) . '.php';

            $registration->registerHooksFromClass($hook);
        }
    }

    /**
     * @return iterable<class-string<AfterClassLikeAnalysisInterface>|class-string<AfterStatementAnalysisInterface>>
     */
    private static function hooks(): iterable
    {
        yield EventHandler\ForbidTraits::class;
        yield EventHandler\ForbidNonFinalClasses::class;
        yield EventHandler\ForbidNonExhaustiveAbstraction::class;
    }
}
