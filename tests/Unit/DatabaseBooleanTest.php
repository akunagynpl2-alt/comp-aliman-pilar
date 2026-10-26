<?php

namespace Tests\Unit;

use App\Casts\DatabaseBoolean;
use App\Models\Category;
use Tests\TestCase;

class DatabaseBooleanTest extends TestCase
{
    public function test_postgres_boolean_bindings_are_textual(): void
    {
        $category = new Category;
        $category->setConnection('pgsql');
        $cast = new DatabaseBoolean;

        $this->assertSame('true', $cast->set($category, 'is_active', true, []));
        $this->assertSame('false', $cast->set($category, 'is_active', false, []));
    }

    public function test_other_connections_keep_native_boolean_bindings(): void
    {
        $category = new Category;
        $category->setConnection('sqlite');

        $this->assertTrue((new DatabaseBoolean)->set($category, 'is_active', true, []));
    }

    public function test_postgres_boolean_values_are_cast_to_php_booleans(): void
    {
        $cast = new DatabaseBoolean;
        $category = new Category;

        $this->assertTrue($cast->get($category, 'is_active', 't', []));
        $this->assertFalse($cast->get($category, 'is_active', 'f', []));
    }
}
