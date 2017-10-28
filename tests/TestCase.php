<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionClass;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var mixed
     */
    protected $testedClass;

    /**
     * @var string
     */
    protected $testedClassName;

    /**
     * @var array
     */
    protected $dependencies = [];

    /**
     * @var array
     */
    protected $otherDependencies = [];

    /**
     * @var ReflectionClass
     */
    protected $reflection;

    /**
     * @var boolean
     */
    protected $activeReflection = false;

    public function setUp()
    {
        parent::setUp();

        $this->loadTestedClass();
        $this->loadReflection();
    }

    public function tearDown()
    {
        $this->testedClass = null;
        $this->dependencies = [];
        $this->otherDependencies = [];
        $this->reflection = null;
    }

    protected function loadTestedClass()
    {
        if (empty($this->testedClassName)) {
            return false;
        }

        $this->testedClass = new $this->testedClassName(
            ...array_values($this->dependencies)
        );
    }

    protected function loadReflection()
    {
        if (!$this->activeReflection) {
            return false;
        }

        $this->reflection = new ReflectionClass($this->testedClass);
    }

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($this->testedClassName),
            "Class not found: {$this->testedClassName}"
        );
    }
}
