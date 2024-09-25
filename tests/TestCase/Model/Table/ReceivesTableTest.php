<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReceivesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReceivesTable Test Case
 */
class ReceivesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReceivesTable
     */
    public $Receives;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Receives',
        'app.Categories',
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
        $config = TableRegistry::getTableLocator()->exists('Receives') ? [] : ['className' => ReceivesTable::class];
        $this->Receives = TableRegistry::getTableLocator()->get('Receives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Receives);

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
