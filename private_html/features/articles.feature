Feature: adding and editing article info
  As a site admin
  In order to keep information updated
  I need to be able to insert article info

 Background: I am logged in
    Given the following users exist:
    | login     | pswd |
    | test_user | test |
    Given I am logged in as "test_user" with password "test"
    Given the following journals have been added:
    | name          | url               | description           |
    | Murzilka      | www.murz.com      | advanced child journal| 
    | Phys. Lett    | www.elsevire.com  | expensive journal     |

  Scenario: creating article 
    Given I am on "?r=articles/create"
    When I fill in "Articles[title]" with "About all properties"
    And I fill in "Articles[abstract]" with "Oho-ho-ho"
    And I fill in "Articles[url]" with "www.oho-ho.com"
    And I fill in "Articles[page]" with "112"
    And I fill in "Articles[year]" with "1987"
    And I select "Murzilka" from "Articles[journal]" 
    And I press "Create"
    Then I should see the following: "About all properties, Oho-ho-ho, www.oho-ho.com, 112, 1987, Murzilka"



