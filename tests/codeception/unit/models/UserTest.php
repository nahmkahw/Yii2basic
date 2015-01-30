<?php

namespace tests\codeception\unit\models;

use yii\codeception\TestCase;

class UserTest extends TestCase
{

	protected $users;

	protected function _before()
    {
        $this->users = new \app\models\User;
    }

    protected function setUp()
    {
        parent::setUp();
        // uncomment the following to load fixtures for user table
        //$this->loadFixtures(['user']);
    }

    public function testCheck(){
    	$msg = 'Hello';
    	$this->assertEquals('Hello',$msg);
    	$this->assertTrue($this->users->check());

    	$user = $this->users->findIdentity(100);
    	$this->assertEquals('admin',$user->username);
    }



    // TODO add test methods here
}
