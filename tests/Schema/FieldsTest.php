<?php

/**
 * Cycle ORM Schema Builder.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Cycle\Schema\Tests;

use Cycle\Schema\Definition\Field;
use Cycle\Schema\Definition\Map\FieldMap;
use PHPUnit\Framework\TestCase;

class FieldsTest extends TestCase
{
    /**
     * @expectedException \Cycle\Schema\Exception\FieldException
     */
    public function testNoField(): void
    {
        $m = new FieldMap();
        $m->get('id');
    }

    public function testSetGet(): void
    {
        $m = new FieldMap();

        $this->assertFalse($m->has('id'));
        $m->set('id', $f = new Field());
        $this->assertTrue($m->has('id'));
        $this->assertSame($f, $m->get('id'));

        $this->assertSame(['id' => $f], iterator_to_array($m->getIterator()));
    }

    /**
     * @expectedException \Cycle\Schema\Exception\FieldException
     */
    public function testSetTwice(): void
    {
        $m = new FieldMap();

        $m->set('id', $f = new Field());
        $m->set('id', $f = new Field());
    }

    /**
     * @expectedException \Cycle\Schema\Exception\FieldException
     */
    public function testNoType(): void
    {
        $m = new FieldMap();

        $m->set('id', $f = new Field());
        $m->get('id')->getType();
    }

    /**
     * @expectedException \Cycle\Schema\Exception\FieldException
     */
    public function testNoColumn(): void
    {
        $m = new FieldMap();

        $m->set('id', $f = new Field());
        $m->get('id')->getColumn();
    }
}
