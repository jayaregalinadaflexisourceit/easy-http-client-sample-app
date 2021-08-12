<?php
declare(strict_types=1);

namespace App\Model;

final class PublicAPIEntry
{
    private array $entry;

    public function __construct(array $entry)
    {
        $this->entry = $entry;
    }

    /**
     * @return mixed|null
     */
    public function getAttribute(string $attribute)
    {
        return $this->entry[$attribute] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->entry[$name] ?? null;
    }

    /**
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        $this->entry[$name] = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->entry[$name]);
    }
}
