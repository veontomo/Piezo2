<?php
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'Articles.php');
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'Authors.php');

class ArticlesTest extends PHPUnit_Framework_TestCase
{
    public function testAllAuthorsString(){
		$author = $this->getMock('Authors', array('id'));
		$author->expects($this->any())
	         ->method('id')
	         ->will($this->returnValue(1));
	    echo $author->id;
	    $article = new Articles;
	    $this->assertSame(null, $article->bindAuthor($author));

    }   


}
?>