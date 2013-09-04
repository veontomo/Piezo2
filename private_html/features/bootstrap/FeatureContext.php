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
            echo 'searching for "', $word, '", its trimmed version: "', trim($word), '"',PHP_EOL;
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
        foreach ($journals as $key => $journal) {
            $j = Journals::model()->find('name=:name', array(':name' => $journal['name']));
            if($j){
                echo 'updating Journal ', $journal['name'], ' info.',  PHP_EOL;
                $j->url = $journal['link'];
                $j->description = $journal['description'];
            }else{
                $j = new Journals();
                $j->name = $journal["name"];
                $j->url = $journal["link"];
                $j->description = $journal["description"];  
                echo 'creating new Journal ', $j->name, PHP_EOL;              
            }
            echo $j->save() ? 'Journal info is saved' : 'Journal remains unsaved';
            echo PHP_EOL;
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
            echo $journalName, " has id ", $journal->id, PHP_EOL;
            return new When('I am on "?r=journals/update&id='.$journal->id.'"');
        }else{
            return false;
        }

    }
}
