Feature: adding/editing journal info
    As a site admin
    In order to keep information updated
    I need to be able to insert journal info

Background: I am logged in
    Given the following users exist:
        | login     | pswd |
        | test_user | test |
    Given I am logged in as "test_user" with password "test"

    Scenario: adding article 
        Given I am on "?r=journals/create"
        When I fill in "Journals[name]" with "The best journal"
        And I fill in "Journals[url]" with "www.journal.com"
        And I fill in "Journals[description]" with "this journal publiShes only the best articles."
        And I press "Add"
        Then I should see the following: "The best journal, www.journal.com, this journal publiShes only the best articles."


    Scenario: editing article
        Given the following journals are present:
            | name          | url               | description           |
            | Murzilka      | www.murz.com      | advanced child journal| 
            | Phys. Lett    | www.elsevire.com  | expensive journal     |
        When I am on edit page for journal "Murzilka"
        Then I should see the following: "Update Murzilka, advanced child journal"
        And I should see "www.murz.com"

