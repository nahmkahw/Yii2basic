<?php
namespace tests\codeception\unit\models;

use yii\codeception\TestCase;

class ProjectTest extends TestCase
{

	protected $project;

	protected function _before()
    {
        $this->project = new \app\models\Project;
    }

    protected function setUp()
    {
        parent::setUp();
        // uncomment the following to load fixtures for user table
        //$this->loadFixtures(['user']);
    }

    
    public function testAllAttributesHaveLabels()
    {
        $attributes = array_keys($this->project->attributes);

        foreach ($attributes as $attribute) {
            $this->assertArrayHasKey($attribute, $this->project->attributeLabels());
        }
    }

    public function testNameIsRequired()
    {
        $this->project->name = '';
        $this->assertFalse($this->project->validate(array('name')));

        $this->project->name = 'set-value';
        $this->assertTrue($this->project->validate(array('name')));
    }

    public function testNameMaxLengthIs128()
    {
        $this->project->name = $this->generateString(129);
        $this->assertFalse($this->project->validate(array('name')));

        $this->project->name = $this->generateString(128);
        $this->assertTrue($this->project->validate(array('name')));
    }

    public function testDescriptionIsRequired()
    {
        $this->project->description = '';
        $this->assertFalse($this->project->validate(array('description')));
    }

    public function testDescriptionMaxLengthIs500()
    {
        $this->project->description = $this->generateString(501);
        $this->assertFalse($this->project->validate(array('description')));

        $this->project->description = $this->generateString(500);
        $this->assertTrue($this->project->validate(array('description')));
    }

    public function testCreateUserIdIsNumerical()
    {
        $this->project->create_user_id = 'x';
        $this->assertFalse($this->project->validate(array('create_user_id')));

        $this->project->create_user_id = 1;
        $this->assertTrue($this->project->validate(array('create_user_id')));
    }

    public function testUpdateUserIdIsNumerical()
    {

        $this->project->update_user_id = 'value-string';
        $this->assertFalse($this->project->validate(array('update_user_id')));

        $this->project->update_user_id = 1;
        $this->assertTrue($this->project->validate(array('update_user_id')));
    }


    function generateString($length)
    {
        $random= "";
        srand((double)microtime()*1000000);
        $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $char_list .= "abcdefghijklmnopqrstuvwxyz";
        $char_list .= "1234567890";
        // Add the special characters to $char_list if needed

        for($i = 0; $i < $length; $i++)
        {
            $random .= substr($char_list,(rand()%(strlen($char_list))), 1);
        }
        return $random;
    }

    // TODO add test methods here
}