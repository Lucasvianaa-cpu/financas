<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ShoppingCardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ShoppingCardsTable Test Case
 */
class ShoppingCardsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ShoppingCardsTable
     */
    public $ShoppingCards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ShoppingCards',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ShoppingCards') ? [] : ['className' => ShoppingCardsTable::class];
        $this->ShoppingCards = TableRegistry::getTableLocator()->get('ShoppingCards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ShoppingCards);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
