Feature: adding/editing journal info
    As a site admin
    In order to keep information updated
    I need to be able to insert journal info

Background: I am logged in
    Given the following users exist:
        | login     | pswd |
        | test_user | test |
    Given I am logged in as "test_user" with password "test"

    Scenario: adding journal 
        Given I am on "?r=journals/create"
        When I fill in "Journals[name]" with "The best journal"
        And I fill in "Journals[url]" with "www.journal.com"
        And I fill in "Journals[description]" with "this journal publiShes only the best articles."
        And I press "Add"
        Then I should see the following: "The best journal, www.journal.com, this journal publiShes only the best articles."

    Scenario: adding a journal already present in the DB
        Given the following journals are present:
        | name          | link                      | description           |
        | Murzilka      | http://www.murz.com       | advanced child journal| 
        | Nature        | www nature com            | nice journal          |
        Given I am on "?r=journals/create"
        When I fill in "Journals[name]" with "Murzilka"
        And I fill in "Journals[url]" with "www.journal.com"
        And I fill in "Journals[description]" with "any text"
        And I press "Add"
        Then I should see "Please fix the following input errors:"
        Then I should see the following: "Name, has already been taken"



    Scenario: editing journal
        Given the following journals are present:
        | name          | link                      | description           |
        | Gazzetta      | http://www.gazzetta.com   | sport news            | 
        | Murzilka      | www.murz.com              | advanced child journal|
        Given I am on edit page for journal "Gazzetta"
        Then I should see "Update Gazzetta"
        And I should see "sport news"
        And I should see "1qazxsw2"
        And I should see "2wsxcde3"
        And I should see "http://www.gazzetta.com"
#        When I fill in "Journals[name]" with "New Nature"
#        And I fill in "Journals[url]" with "www.newnature.com"
#        And I fill in "Journals[description]" with "this is a new Nature"
 #       And I press "Update"
 #       Then I should see the following: "New Nature, www.newnature.com, this is a new Nature"
        
