<?php

namespace Rogermedico\FactoryWithoutEvents\Tests;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Rogermedico\FactoryWithoutEvents\WithoutEvents;

class WithoutEventsTest extends TestCase
{
    protected function setUp(): void
    {
        $container = Container::getInstance();

        $container->singleton(Generator::class, function ($app, $parameters) {
            return \Faker\Factory::create('en_US');
        });

        $container->instance(Application::class, $app = m::mock(Application::class));

        $app->shouldReceive('getNamespace')->andReturn('App\\');

        $db = new DB;

        $db->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);

        $db->bootEloquent();

        $db->setAsGlobal();

        $this->createSchema();
    }

    /**
     * Setup the database schema.
     *
     * @return void
     */
    public function createSchema()
    {
        $this->schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Tear down the database schema.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        m::close();

        $this->schema()->drop('users');

        Container::setInstance(null);
    }

    public function test_after_creating_and_after_making_callbacks_are_cleared()
    {
        FactoryTestUser::new()
            ->afterMaking(function ($user) {
                $_SERVER['__test.factory.no.events.user.making'] = $user;
            })
            ->afterCreating(function ($user) {
                $_SERVER['__test.factory.no.events.user.creating'] = $user;
            })
            ->withoutEvents()
            ->create();

        $this->assertArrayNotHasKey('__test.factory.no.events.user.making', $_SERVER);

        $this->assertArrayNotHasKey('__test.factory.no.events.user.creating', $_SERVER);
    }

    /**
     * Get a database connection instance.
     *
     * @return \Illuminate\Database\ConnectionInterface
     */
    protected function connection()
    {
        return Eloquent::getConnectionResolver()->connection();
    }

    /**
     * Get a schema builder instance.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected function schema()
    {
        return $this->connection()->getSchemaBuilder();
    }
}

class FactoryTestUser extends Factory
{
    use WithoutEvents;

    protected $model = TestUser::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}

class TestUser extends Eloquent
{
    use HasFactory;

    protected $table = 'users';
}
