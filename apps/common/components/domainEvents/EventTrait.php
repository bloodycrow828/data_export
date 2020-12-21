<?php
declare(strict_types=1);

namespace spellsmell\x_seo\common\components\domainEvents;

trait EventTrait
{
    private array $events = [];

    public function addEvent(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    /** @return DomainEvent[] */
    public function releaseEvents(): array
    {
        $result = $this->events;
        $this->events = [];
        return $result;
    }

    public function isChanged(): bool
    {
        return !empty($this->events);
    }

    public function hasEvent(string $eventClass): bool
    {
        foreach ($this->events as $event) {
            if ($event === $eventClass or $event instanceof $eventClass) {
                return true;
            }
        }

        return false;
    }
}
