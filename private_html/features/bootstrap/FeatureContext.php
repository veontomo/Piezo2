<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    Behat\Behat\Event\SuiteEvent,
    Behat\Behat\Event\ScenarioEvent;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode,
    Behat\Mink\Element\NodeElement;
use Behat\MinkExtension\Context\MinkDictionary;

use Behat\Behat\Context\Step\Then,
    Behat\Behat\Context\Step\When,
    Behat\Behat\Context\Step\Given;


//
// Require 3rd-party libraries here:
//
   // require_once 'PHPUnit/Autoload.php';
   // require_once 'PHPUnit/Framework/Assert/Functions.php';


/**
 * Features context.
 */
class FeatureContext extends BehatContext
{

    use MinkDictionary;
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }




    /**
    * @BeforeScenario 
    */
    public static function prepare(){
        $models = ArticlesKeywords::model()->findAll();
        foreach ($models as $item) {
            $item->delete();
        }
        $models = ArticlesAuthors::model()->findAll();
        foreach ($models as $item) {
            $item->delete();
        }
        $models = Articles::model()->findAll();
        foreach ($models as $item) {
            $item->delete();
        }
        $models = Keywords::model()->findAll();
        foreach ($models as $item) {
            $item->delete();
        }
        $models = Journals::model()->findAll();
        foreach ($models as $item) {
            $item->delete();
        }

		
        
    }


    /**
     * @Given /^I am on home page$/
     */
    public function iAmOnHomePage2()
    {
        return new Given('I am on "?r=site/login"');
    }

    /**
     * @Given /^I should see the following: "([^"]*)"$/
     */
    public function iShouldSeeTheFollowing($commaSeparatedString)
    {
        $output = array();
        $words = array_unique(array_map('trim', explode(",", $commaSeparatedString)));
        foreach ($words as $word) {
             $output[] = new Then('I should see "'.$word.'"');
        }
        return $output;
    }

    /**
     * @Given /^I should not see the following: "([^"]*)"$/
     */
    public function iShouldNotSeeTheFollowing($commaSeparatedString)
    {
        $output = array();
        $words = array_unique(array_map('trim', explode(",", $commaSeparatedString)));
        foreach ($words as $word) {
             $output[] = new Then('I should not see "'.$word.'"');
        }
        return $output;
    }

    /**
     * @Given /^I am logged in as admin$/
     */
    public function iAmLoggedInAsAdmin(){
        return array(
            new Given('I am on "?r=site/login"'),
            new When('I fill in "LoginForm[username]" with "Andrew"'),
            new When('I fill in "LoginForm[password]" with "'.md5("test").'"'),
            new Then('I press "Login"'),
            new Then('I should see "Logout"'),
            new Then('I should not see "Login"'),
            );     
    }

    /**
     * @Given /^the following journals are present:$/
     */
    public function theFollowingJournalsArePresent(TableNode $journalsTable)
    {
        echo "Adding journals", PHP_EOL;
        $before =  count(Journals::model()->findAll());
        $journals = $journalsTable->getHash();
        foreach ($journals as $key => $journal) {
            $j = Journals::model()->find('name=:name', array(':name' => $journal['name']));
            if($j){
                $j->url = $journal['link'];
                $j->description = $journal['description'];
            }else{
                $j = new Journals();
                $j->name = $journal["name"];
                $j->url = $journal["link"];
                $j->description = $journal["description"];  
            }
            $j->save();
        }
        $end =  count(Journals::model()->findAll());
        echo $end - $before, " articles are added.", PHP_EOL;
    }

    /**
     * @Given /^the following users exist:$/
     */
    public function theFollowingUsersExist(TableNode $usersTable)
    {
        $users = $usersTable->getHash();
        foreach ($users as $user) {
            $u=Users::model()->find('login=:login', array(':login'=>$user["login"]));
            if($u){
                $u->pswd = md5($user["pswd"]);
            }else{
                $u = new Users();
                $u->login = $user["login"];
                $u->pswd = md5($user["pswd"]);
            }
            $u->save();
        }
    }

    /**
     * @Given /^I am logged in as "([^"]*)" with password "([^"]*)"$/
     */
    public function iAmLoggedInAsWithPassword($username, $pswd)
    {
        return array(
            new When('I am on "?r=site/login"'),
            new Then('I should not see "Logout"'),
            new When('I fill in "LoginForm[username]" with "'.$username.'"'),
            new When('I fill in "LoginForm[password]" with "'.$pswd.'"'),
            new When('I press "Login"'),
            // new When('I should see "'.$username.'"'),
            // new When('I should see "Logout"'),
            // new When('I should not see "Login"')
            );
    }

    /**
     * @When /^I am on edit page for journal "([^"]*)"$/
     */
    public function iAmOnEditPageForJournal($journalName)
    {
        $journal = Journals::model()->find("name=:name", array(":name" => $journalName));
        if($journal){
            return new When('I am on "?r=journals/update&id='.$journal->id.'"');
        }else{
            echo $journalName, " not found", PHP_EOL;
            return false;
        }
    }

    /**
     * @Given /^I am on view page for journal "([^"]*)"$/
     */
    public function iAmOnViewPageForJournal($journalName)
    {
		$journal = Journals::model()->find("name=:name", array(":name" => $journalName));
		if($journal){
			return new When('I am on "?r=journals/view&id='.$journal->id.'"');
		}else{
			echo $journalName, " not found", PHP_EOL;
			return false;
		}
    }

    /**
     * @When /^I am on edit page for article entitled "([^"]*)"$/
     */
    public function iAmOnEditPageForArticleEntitled($articleTitle)
    {
        $article = Articles::model()->find('title=:title', array(':title' => $articleTitle));
        if($article){
            return new When('I am on "?r=articles/update&id='.$article->id.'"');
        }else{
            echo $articleTitle, " not found!!!", PHP_EOL;
            return false;
        }
    }
    /**
     * @When /^I am on view page for article entitled "([^"]*)"$/
     */
    public function iAmOnViewPageForArticleEntitled($articleTitle)
    {
        $article = Articles::model()->find('title=:title', array(':title' => $articleTitle));
        if($article){
            return new When('I am on "?r=articles/view&id='.$article->id.'"');
        }else{
            echo $articleTitle, " not found", PHP_EOL;
            return false;
        }
    }

 

    /**
     * @When /^I am on view page for author "([^"]*)" "([^"]*)"$/
     */
    public function iAmOnViewPageForAuthorWithSurname($name, $surname)
    {
        $author = Authors::model()->find('name=:name AND surname=:surname', 
            array(':name' => $name, ':surname' => $surname));
        if($author){
            return new When('I am on "?r=authors/view&id='.$author->id.'"');
        }else{
            echo "author with name $name and surname $surname is not found", PHP_EOL;
            return false;
        }
    }

    /**
     * @When /^I am on view page for journals$/
     */
    public function iAmOnViewPageForJournals()
    {
        return new When('I am on "?r=journals/index');
    }

    /**
     * @Given /^the following articles are present:$/
     */
    public function theFollowingArticlesArePresent(TableNode $table)
    {
        $collection = $table->getHash();
        foreach ($collection as $item) {
            $title = trim($item['title']);
            $abstract = trim($item['abstract']);
            $url = trim($item['url']);
            $page = trim($item['page']);
            $year = trim($item['year']);
            $journal = trim($item['journal']);

            $article = Articles::model()->find('title=:title', array(':title' => $title));
            if(!$article){
                $article = new Articles();
                $article->title = $title;
            }
            $article->abstract = $abstract;
            $article->url = $url;
            $article->page = (int) $page;
            $article->year = (int) $year;
            $article->journal = Journals::model()->find('name = :name', array(':name' => $journal))->id;
            $article->save();            
        }
    }

    /**
    * @Given /^the article entitled "([^"]*)" has the following keywords: "([^"]*)"$/
    */
    public function theArticleEntitledHasTheFollowingKeywords($title, $keywords){
        $article = Articles::model()->find('title = :title', array(':title' => $title));
        if(!$article){
            throw new Exception("Article with title \"$title\" not found", 1);
        }
        $keywordsArr = explode(',', $keywords);
        foreach ($keywordsArr as $keyword) {
            $keywordModel = Keywords::model()->find_or_create_by_name(trim($keyword));
            $article->bindKeyword($keywordModel);
        }
    }


    /**
    * @Given /^I am on the view page of the article entitled "([^"]*)"$/
    */
    public function iAmOnTheViewPageOfTheArticleEntitled($articleName){
        $article = Articles::model()->find("title=:name", array(":name" => $articleName));
        if($article){
            return new When('I am on "?r=articles/view&id='.$article->id.'"');
        }else{
            echo 'article entitled ', $articleName, ' not found', PHP_EOL;
            throw new Exception("Article with title \"$title\" not found", 1);
        }    
    }


    /**
     * @Then /^article entitled "([^"]*)" should not be present$/
     */
    public function articleEntitledShouldNotBePresent($arg1)
    {
        $articles = Articles::model()->findAll('title = :name', array(':name' => trim($arg1)));
        if($articles){
           throw new Exception("Article entitled \"$arg1\" is still present", 1);
        }else{
            return true;
        }
    }

    /**
    * @When /^(?:|I )confirm the popup$/
    */
    public function confirmPopup(){
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

    /**
    * @When /^(?:|I )should see "([^"]*)" in popup$/
    *
    * @param string $message The message.
    * @return bool
    * @url  https://gist.github.com/benjaminlazarecki/2888851
    *
    */
    public function assertPopupMessage($message){
        return $message == $this->getSession()->getDriver()->getWebDriverSession()->getAlert_text();
    }


    /**
    * @Then /^I wait for jquery to load$/
    */
    public function iWaitForJqueryToLoad(){
        // $this->getSession()->wait(5000, "$('a:contains(\"Delete\")').length > 0");
        // $this->getSession()->wait(5000, "typeof $ != 'undefined' ");
        $this->getSession()->wait(5000);
    }


    /**
     * @Given /^I wait for (\d+) seconds$/
     */
    public function iWaitForSeconds($arg1)
    {
        $this->getSession()->wait($arg1);
    }



    /**
     * @Given /^the article entitled "([^"]*)" has the following authors:$/
     */
    public function theArticleEntitledHasTheFollowingAuthors($title, TableNode $table)
    {
        $authors = $table->getHash();
        $article = Articles::model()->find('title = :title', array(':title' => trim($title)));
        if(!$article){
           throw new Exception("Article entitled \"$title\" is not found", 1);
        }
        foreach($authors as $author){
        	$authorModel = Authors::model()->find_or_create_by_name_and_surname(
        		array('name' => $author['name'], 'surname' => $author['surname']));
        	$article->bindAuthor($authorModel);
        }

    }

    /**
    * Click some text
    *
    * @When /^I click on the text "([^"]*)"$/
    */
    public function iClickOnTheText($text)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', '*//*[text()="'. $text .'"]')
        );
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Cannot find text: "%s"', $text));
        }

        $element->click();

    }

    /**
    * Click field with id
    *
    * @When /^I click on field with id "([^"]*)"$/
    */
    public function iClickOnFieldWithId($text)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', '*//*[@id="'. $text .'"]')
        );
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Cannot find field with id: "%s"', $text));
        }

        $element->click();

    }

    /**
    * @Given /^I confirm deleting$/
    */
    public function iConfirmDeleting()
    {
    	$this->getSession()->start();
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

    /**
     * @Given /^the following articles have been written by authors:$/
     */
    public function theFollowingArticlesHaveBeenWrittenByAuthors(TableNode $table)
    {
        $collection = $table->getHash();
        foreach ($collection as $item) {
            $title = trim($item['title']);
            $article = Articles::model()->find('title=:title', array(':title' => $title));
            $surnames = explode(',' ,$item['surnames']);
            foreach($surnames as $surname){
                if($author = Authors::model()->find_or_create_by_name_and_surname(
                    array('surname' => $surname, 'name' => ""))) {
                    $article->bindAuthor($author);                    
                }else{
                    echo "error occurred when dealing with author $surname", PHP_EOL;
                }


            }
        }
    }

}
