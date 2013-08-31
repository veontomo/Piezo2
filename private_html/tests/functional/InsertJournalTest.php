<?php

class InsertJournalTest extends WebTestCase
{

	public function login(){
		$this->open('');
	   	if($this->isTextPresent('Logout')){
			$this->clickAndWait('link=Logout');
		}
	   	$this->clickAndWait('link=Login');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','Andrew');
		$this->click("//input[@value='Login']");
		$this->type('name=LoginForm[password]','test');
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextPresent('Logout');
	}

	public function testIndex()
	{
		$this->open('?r=journals/index');
		$this->assertTextPresent('List');
	}

	public function testArticleInsertion()
	{
		$this->open('?r=journals/index');
		$this->assertTextPresent('List');
		$this->login();
		$this->open('?r=journals/create');
		$this->assertElementPresent('name=Journals[name]');
		$this->type('name=Journals[name]', 'Some Journal');
		$this->assertElementPresent('name=Journals[url]');
		$this->type('name=Journals[url]', 'www.journal.com');
		$this->assertElementPresent('name=Journals[description]');
		$this->type('name=Journals[description]', 'Lorem ipsum');
		$this->clickAndWait("//input[@value='Create']");
		$this->assertTextPresent('Some Journal');
		$this->assertTextPresent('www.journal.com');
		$this->assertTextPresent('Lorem ipsum');




	}

}
