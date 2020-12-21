<?php declare(strict_types=1);

namespace spellsmell\x_seo\common\components\domainEvents;

interface EventHandlerInterface
{
    public function handle(DomainEvent $event): void;
}