<?php

namespace Rogermedico\FactoryWithoutEvents;

trait WithoutEvents
{
    /**
     * Clear "after making" and "after creating" callbacks.
     *
     * @return static
     */
    public function withoutEvents()
    {
        return $this->newInstance([
            'afterCreating' => collect(),
            'afterMaking' => collect(),
        ]);
    }
}
