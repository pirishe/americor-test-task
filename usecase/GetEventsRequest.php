<?php

namespace app\usecase;

final class GetEventsRequest
{
    private $page;

    private function __construct(int $page)
    {
        $this->page = $page;
    }

    public static function makeFromArray(array $queryParams): self
    {
        $page = $queryParams['page'] ?? 1;
        if ($page <= 0) {
            throw new \InvalidArgumentException('Page must be greater than 0');
        }

        return new self($page);
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
