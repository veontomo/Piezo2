<?php
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'Authors.php');

class AuthorsTest extends PHPUnit_Framework_TestCase
{
    public function testCreateOrFindByNameAndSurname(){
    	$author = Authors::model()->find_or_create_by_name_and_surname(array('name' => 'Mario', 'surname' => 'Galvani'));
    	$this->assertEquals('Mario', $author->name);
    	$this->assertEquals('Galvani', $author->surname);

// find the above model by its id and to see whether its name and surname are set correctly
    	$author2 = Authors::model()->find($author->id);
    	$this->assertEquals('Mario', $author2->name);
    	$this->assertEquals('Galvani', $author2->surname);

    }

    public function testSetAuthor(){
		$author = $this->getMock('Articles', array('bindAuthor'));
		$author->expects($this->any())
	         ->method('bindAuthor')
	         ->will($this->returnValue());

	        
    }   


}
?>