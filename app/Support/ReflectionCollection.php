<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use ReflectionClass;

/**
 * @extends Illuminate\Support\Collection<ReflectionClass>
 */
class ReflectionCollection extends Collection
{
    public static function fromDirectory(string $directory): self
    {
        $files = File::allFiles(app_path($directory));

        $classes = collect($files)->map(function ($file) {
            $class = str_replace(
                [base_path().'/', 'app/', '.php', '/'],
                ['', 'App/', '', '\\'],
                $file->getPathname()
            );

            return new ReflectionClass($class);
        });

        return new self($classes);
    }

    public function isInstantiable(): self
    {
        return $this->filter(fn (ReflectionClass $class) => $class->isInstantiable())
            ->values();
    }

    public function isSubclassOf(string ...$classes): self
    {
        return $this->filter(
            fn (ReflectionClass $reflectionClass) => collect($classes)
                ->some(fn ($class) => $reflectionClass->isSubclassOf($class))
        )->values();
    }

    public function usesTrait(string ...$traits): self
    {
        return $this->filter(
            fn (ReflectionClass $class) => ! empty(array_intersect($traits, $class->getTraitNames()))
        )->values();
    }

    public function implementsInterface(string ...$interfaces): self
    {
        return $this->filter(
            fn (ReflectionClass $class) => collect($interfaces)
                ->some(fn ($interface) => $class->implementsInterface($interface))
        )->values();
    }

    /**
     * Return a collection of class names as strings.
     *
     * @return \Illuminate\Support\Collection<string>
     */
    public function getClassNames(): Collection
    {
        return $this->map(function (ReflectionClass $class) {
            return $class->getName();
        });
    }
}
