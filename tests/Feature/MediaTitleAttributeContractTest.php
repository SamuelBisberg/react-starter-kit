<?php

namespace Tests\Feature;

use App\Interfaces\HasTitleAttributeName;
use App\Support\ReflectionCollection;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Spatie\MediaLibrary\HasMedia;

class MediaTitleAttributeContractTest extends TestCase
{
    #[Test]
    public function all_media_models_implement_title_attribute_name_contract(): void
    {
        $failures = ReflectionCollection::fromDirectory('Models')
            ->implementsInterface(HasMedia::class)
            ->filter(fn (\ReflectionClass $class) => ! $class->implementsInterface(HasTitleAttributeName::class))
            ->values();

        $this->assertEmpty(
            $failures,
            'The following models implement HasMedia but not HasTitleAttributeName: '.implode(
                ', ',
                $failures->map(fn (ReflectionClass $class) => $class->getName())->toArray()
            )
        );
    }
}
