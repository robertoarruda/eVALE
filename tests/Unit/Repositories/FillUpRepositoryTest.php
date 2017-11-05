<?php

namespace Tests\Nero\Evale\Repositories;

use Mockery;
use Nero\Evale\Models\FillUp;
use Nero\Evale\Repositories\FillUpRepository;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Repositories\FillUpRepository
 */
class FillUpRepositoryTest extends TestCase
{
    protected $testedClassName = FillUpRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            FillUp::class => Mockery::mock(FillUp::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new FillUpRepository(...array_values($this->dependencies));

        $this->assertInstanceOf(FillUpRepository::class, $testedClass);
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $fillUp = factory(FillUp::class, 1)->make();

        $this->dependencies[FillUp::class]
            ->shouldReceive('where->get')
            ->with(['id' => 1])
            ->with()
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $fillUp = factory(FillUp::class)->make();

        $this->dependencies[FillUp::class]
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $fillUp = factory(FillUp::class)->make();

        $this->dependencies[FillUp::class]
            ->shouldReceive('create')
            ->with($fillUp->toArray())
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->create($fillUp->toArray())
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $fillUp = factory(FillUp::class)->make();

        $this->dependencies[FillUp::class]
            ->shouldReceive('where->first->fill->save')
            ->with('id', 1)
            ->with()
            ->with($fillUp->toArray())
            ->with()
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->update(1, $fillUp->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $this->dependencies[FillUp::class]
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies[FillUp::class]);

        $this->assertInstanceOf(
            FillUp::class,
            $this->testedClass->delete(1)
        );
    }
}
