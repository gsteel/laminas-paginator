<?php

/**
 * @see       https://github.com/laminas/laminas-paginator for the canonical source repository
 * @copyright https://github.com/laminas/laminas-paginator/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-paginator/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Paginator\Adapter;

use Laminas\Paginator;
use Laminas\Paginator\Adapter;

/**
 * @group      Laminas_Paginator
 * @covers  Laminas\Paginator\Adapter\NullFill<extended>
 */
class NullFillTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Laminas\Paginator\Adapter\NullFill
     */
    private $adapter;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->adapter = new Adapter\NullFill(101);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->adapter = null;
        parent::tearDown();
    }

    public function testGetsItems()
    {
        $actual = $this->adapter->getItems(0, 10);
        $this->assertEquals(array_fill(0, 10, null), $actual);
    }

    public function testReturnsCorrectCount()
    {
        $this->assertEquals(101, $this->adapter->count());
    }

    /**
     * @group Laminas-3873
     */
    public function testAdapterReturnsCorrectValues()
    {
        $paginator = new Paginator\Paginator(new Adapter\NullFill(2));
        $paginator->setCurrentPageNumber(1);
        $paginator->setItemCountPerPage(5);

        $pages = $paginator->getPages();

        $this->assertEquals(2, $pages->currentItemCount);
        $this->assertEquals(2, $pages->lastItemNumber);

        $paginator = new Paginator\Paginator(new Adapter\NullFill(19));
        $paginator->setCurrentPageNumber(4);
        $paginator->setItemCountPerPage(5);

        $pages = $paginator->getPages();

        $this->assertEquals(4, $pages->currentItemCount);
        $this->assertEquals(19, $pages->lastItemNumber);
    }

    /**
     * @group Laminas-4151
     */
    public function testEmptySet()
    {
        $this->adapter = new Adapter\NullFill(0);
        $actual = $this->adapter->getItems(0, 10);
        $this->assertEquals([], $actual);
    }

    /**
     * Verify that the fix for Laminas-4151 doesn't create an OBO error
     */
    public function testSetOfOne()
    {
        $this->adapter = new Adapter\NullFill(1);
        $actual = $this->adapter->getItems(0, 10);
        $this->assertEquals(array_fill(0, 1, null), $actual);
    }
}
