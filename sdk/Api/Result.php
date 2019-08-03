<?php

namespace Sdk\Api;

class Result
{
    /**
     * @var array
     */
    private $context;

    /**
     * @var array|null
     */
    private $items;

    /**
     * Response constructor.
     * @param array      $context
     * @param array|null $items
     */
    public function __construct(array $context, ?array $items = null)
    {
        $this->context = $context;
        $this->items = $items;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }
}