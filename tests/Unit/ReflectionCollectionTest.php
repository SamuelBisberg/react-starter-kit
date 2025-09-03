<?php

namespace Tests\Unit;

use App\Support\ReflectionCollection;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

// --- Fakes for isolated testing ---
interface FakeInterface {}
trait FakeTrait {}
abstract class FakeAbstract {}
class FakeBase {}
class FakeClass extends FakeBase implements FakeInterface
{
    use FakeTrait;
}
class FakeClassNoTrait extends FakeBase {}
class FakeClassNoInterface
{
    use FakeTrait;
}
// --- End fakes ---

class ReflectionCollectionTest extends TestCase
{
    private function fakeCollection(): ReflectionCollection
    {
        return new ReflectionCollection([
            new ReflectionClass(FakeClass::class),
            new ReflectionClass(FakeClassNoTrait::class),
            new ReflectionClass(FakeClassNoInterface::class),
            new ReflectionClass(FakeAbstract::class),
        ]);
    }

    public function test_reflection_collection_contains_reflection_classes()
    {
        $collection = $this->fakeCollection();
        $this->assertInstanceOf(ReflectionCollection::class, $collection);
        $this->assertNotEmpty($collection);
        $this->assertContainsOnlyInstancesOf(ReflectionClass::class, $collection);
    }

    public function test_is_instantiable_filters_non_instantiable_classes()
    {
        $collection = $this->fakeCollection();
        $instantiable = $collection->isInstantiable();
        $this->assertInstanceOf(ReflectionCollection::class, $instantiable);
        foreach ($instantiable as $class) {
            $this->assertTrue($class->isInstantiable());
        }
        $this->assertFalse($instantiable->contains(fn ($c) => $c->getName() === FakeAbstract::class));
    }

    public function test_is_subclass_of_filters_by_subclass()
    {
        $collection = $this->fakeCollection();
        $subclasses = $collection->isSubclassOf(FakeBase::class);
        $this->assertInstanceOf(ReflectionCollection::class, $subclasses);
        foreach ($subclasses as $class) {
            $this->assertTrue($class->isSubclassOf(FakeBase::class));
        }
        $this->assertFalse($subclasses->contains(fn ($c) => $c->getName() === FakeClassNoInterface::class));
    }

    public function test_uses_trait_filters_by_trait()
    {
        $collection = $this->fakeCollection();
        $traits = $collection->usesTrait(FakeTrait::class);
        $this->assertInstanceOf(ReflectionCollection::class, $traits);
        foreach ($traits as $class) {
            $this->assertContains(FakeTrait::class, $class->getTraitNames());
        }
        $this->assertFalse($traits->contains(fn ($c) => $c->getName() === FakeClassNoTrait::class));
    }

    public function test_implements_interface_filters_by_interface()
    {
        $collection = $this->fakeCollection();
        $interfaces = $collection->implementsInterface(FakeInterface::class);
        $this->assertInstanceOf(ReflectionCollection::class, $interfaces);
        foreach ($interfaces as $class) {
            $this->assertTrue($class->implementsInterface(FakeInterface::class));
        }
        $this->assertFalse($interfaces->contains(fn ($c) => $c->getName() === FakeClassNoInterface::class));
    }

    public function test_get_class_names_returns_class_names()
    {
        $collection = $this->fakeCollection();
        $names = $collection->getClassNames();
        $this->assertInstanceOf(Collection::class, $names);
        foreach ($names as $name) {
            $this->assertIsString($name);
            $this->assertTrue(class_exists($name));
        }
    }
}
