<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
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



//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//

    /**
     * @Given /^I should see the following: "([^"]*)"$/
     */
    public function iShouldSeeTheFollowing($commaSeparatedString)
    {
        $output = array();
        $words = explode(",", $commaSeparatedString);
        foreach ($words as $word) {
            $output[] = new Then('I should see "'.trim($word).'"');
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
        $journals = $journalsTable->getHash();
        echo "There are ", count($journals), PHP_EOL;
        foreach ($journals as $key => $journal) {
            echo $key, "-th journal:", PHP_EOL;
            $j = Journals::model()->find('name=:name', array(':name' => $journal['name']));
            if($j){
                echo 'the title ', $journal['name'] , ' is found in the DB.' ,PHP_EOL;      
                if( $j->url != $journal['url'] ||
                    $j->description != $journal['description'])
                {
                    echo "found journal has other url and/or description", PHP_EOL;    
                    return new Exception('the journal '.$journal['name']. " exists with other url and/or description");
                }else{
                    echo "found journal has has the same url and description, so nothing is required", PHP_EOL;    

                }
            }else{
                echo 'the title ', $journal['name'], ' is NOT found in the DB.' , PHP_EOL; 
                $j = new Journals();
                $j->name = $journal["name"];
                $j->url = $journal["url"];
                $j->description = $journal["description"];
                $j->save();
                echo 'the journal was written to the DB.',  PHP_EOL; 

            }
        }
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
            new When('I should see "'.$username.'"'),
            new When('I should see "Logout"'),
            new When('I should not see "Login"')
            );
    }

    /**
     * @When /^I am on edit page for journal "([^"]*)"$/
     */
    public function iAmOnEditPageForJournal($journalName)
    {
        $journal = Journals::model()->find("name=:name", array(":name" => $journalName));
        if($journal){
            return new Then('I am on "?r=journals/update&id='.$journal->id.'"');
        }else{
            return false;
        }

    }
}
