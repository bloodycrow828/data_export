<?php

namespace spellsmell\x_seo\common\components\domainEvents;

use Exception;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;


class EventDispatcher extends Component
{
    /** @var EventHandlerInterface[] */
    protected $handlers;

    public function setHandlers(array $handlers)
    {
        array_map([$this, 'addHandler'], $handlers);
    }

    /**
     * @param $handler
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    private function addHandler($handler)
    {
        if ($handler instanceof EventHandlerInterface) {
            $this->handlers[] = $handler;
        } elseif (is_string($handler)) {
            $handler = Yii::$container->get($handler);
            if (!$handler instanceof EventHandlerInterface) {
                throw new Exception('Ошибка создания обработчика событий');
            }
            $this->handlers[] = $handler;
        } else {
            throw new Exception('Ошибка создания обработчика событий');
        }
    }

    public function handle(Eventable $eventable)
    {
        foreach ($eventable->releaseEvents() as $event) {
            foreach ($this->handlers as $handler) {
                $handler->handle($event);
            }
        }
    }
}