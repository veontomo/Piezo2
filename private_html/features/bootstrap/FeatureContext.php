<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context; 
//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{

    /**
    * @Given /^the following journals are present$/
    */
    public function theFollowingJournalsArePresent()
    {
        throw new PendingException();
    }

   /**
    * @Given /^I have done something with "([^"]*)"$/
    */
   public function iHaveDoneSomethingWith($argument)
   {
       doSomethingWith($argument);
   }


    /**
    * @Then /^I should see the following: "([^"]*)"$/
    */
    public function iShouldSeeTheFollowing($arg1)
    {
    //throw new PendingException();
    }


}
