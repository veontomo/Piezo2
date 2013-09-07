Feature: adding and editing article info
  As a site admin
  In order to keep information updated
  I need to be able to insert article info

 Background: I am logged in
    Given the following users exist:
    | login     | pswd |
    | test_user | test |
    Given I am logged in as "test_user" with password "test"
    Given the following journals are present:
    | name          | link              | description           |
    | Murzilka      | www.murz.com      | advanced child journal| 
    | Phys. Lett    | www.elsevire.com  | expensive journal     |

Scenario: adding article 
    Given I am on "?r=articles/create"
    When I fill in "Articles[title]" with "About all properties"
    And I fill in "Articles[abstract]" with "Oho-ho-ho"
    And I fill in "Articles[url]" with "www.oho-ho.com"
    And I fill in "Articles[page]" with "112"
    And I fill in "Articles[year]" with "1987"
    And I select "Murzilka" from "Articles[journal]" 
    And I press "Add"
    Then I should see the following: "About all properties, Oho-ho-ho, www.oho-ho.com, 112, 1987, Murzilka"


Scenario: editing existing article
    Given the following articles are present:
    | title      | abstract      | url               | page  | year | journal    |
    | Happy NY   | NY tree       | www.HappyNY.com   | 102   | 1999 | Murzilka   | 
    | Black hole | event horizon | www.plb.com       | 2     | 2005 | Phys. Lett |
    When I am on edit page for article entitled "Happy NY"
    And I fill in "Articles[title]" with "Edited Article"
    And I fill in "Articles[abstract]" with "updated abstract"
    And I fill in "Articles[page]" with "101"
    And I select "Phys. Lett" from "Articles[journal]" 
    And I press "Update"
    Then I should see the following: "Edited Article, updated abstract, 101, Phys. Lett, www.HappyNY.com, 1999"


Scenario: inserting article along with keywords
    Given I am on "?r=articles/create"
    Then I should see "keyword"
    When I fill in "Articles[title]" with "Article with keywords"
    And I fill in "Articles[abstract]" with "this is article with keywords"
    And I fill in "Articles[url]" with "www.journal.com/article-with-keywords"
    And I fill in "Articles[page]" with "1"
    And I fill in "Articles[year]" with "2012"
    And I select "Phys. Lett" from "Articles[journal]"
    And I press "Add"
    Then I should see the following: "About all properties, Oho-ho-ho, www.oho-ho.com, 112, 1987, Murzilka"    


