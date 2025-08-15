<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class ReflectionCollection extends Collection
{
    public static function fromDirectory(string $directory): self
    {
        $files = File::allFiles(app_path($directory));

        $classes = collect($files)->map(function ($file) {
            $class = str_replace(
                [base_path() . '/', 'app/', '.php', '/'],
                ['', 'App/', '', '\\'],
                $file->getPathname()
            );

            return new ReflectionClass($class);
        });

        return new self($classes);
    }

    public function isInstantiable(): self
    {
        return $this->filter(function (ReflectionClass $class) {
            return $class->isInstantiable();
        });
    }

    public function isSubclassOf(string $class): self
    {
        return $this->filter(function (ReflectionClass $reflectionClass) use ($class) {
            return $reflectionClass->isSubclassOf($class);
        });
    }

    public function usesTrait(string $trait): self
    {
        return $this->filter(function (ReflectionClass $class) use ($trait) {
            return in_array($trait, $class->getTraitNames());
        });
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
