Feature: adding and editing article info
  As a site admin
  In order to keep information updated
  I need to be able to insert article info

 Background: I am logged in
    Given the following journals are present:
        | name          | link              | description           |
        | Murzilka      | www.murz.com      | advanced child journal| 
        | Phys. Lett    | www.elsevire.com  | expensive journal     |
    Given the following users exist:
        | login         | pswd |
        | test_user     | test |
    Given I am logged in as "test_user" with password "test"

Scenario: adding article keywords, no javascript used
    Given I am on "?r=articles/create"
    When I fill in "Articles[title]" with "About all properties"
    And I fill in "Articles[abstract]" with "Oho-ho-ho"
    And I fill in "Articles[url]" with "www.oho-ho.com"
    And I fill in "Articles[page]" with "112"
    And I fill in "Articles[year]" with "1987"
    And I fill in "Articles[volume]" with "volume d6"
    And I select "Murzilka" from "Articles[journal]"
    And I fill in "Authors[0][name]" with "M"
    And I fill in "Authors[0][surname]" with "Galvani"
    And I press "Add"
    Then I should see the following: "About all properties, Oho-ho-ho, 112, 1987, Murzilka, M Galvani, volume d6"

@javascript
Scenario: adding article without keywords
    Then I wait for 2 seconds
    Given I am on "?r=articles/create"
    Then I wait for 2 seconds
    When I fill in "Articles[title]" with "About all properties"
    And I fill in "Articles[abstract]" with "Oho-ho-ho"
    And I fill in "Articles[url]" with "www.oho-ho.com"
    And I fill in "Articles[page]" with "112"
    And I fill in "Articles[year]" with "1987"
    And I select "Murzilka" from "Articles[journal]"
    And I fill in "Authors[0][name]" with "M"
    And I fill in "Authors[0][surname]" with "Galvani"
    And I click on field with id "addNewAuthor"
    And I fill in "Authors[1][name]" with "Dimitri"
    And I fill in "Authors[1][surname]" with "Mendeleev"
    And I press "Add"
    Then I wait for 2 seconds
    Then I should see the following: "About all properties, Oho-ho-ho, 112, 1987, Murzilka, M Galvani, Dimitri Mendeleev"

Scenario: inserting article along with keywords
    Given I am on "?r=articles/create"
    When I fill in "Articles[title]" with "Article with keywords"
    And I fill in "Articles[abstract]" with "this is article with keywords"
    And I fill in "Articles[url]" with "www.journal.com/article-with-keywords"
    And I fill in "Articles[page]" with "1"
    And I fill in "Articles[year]" with "2012"
    And I select "Phys. Lett" from "Articles[journal]"
    And I fill in "Keywords[name]" with "keyword 1, keyword 2"
    And I press "Add"
    Then I should see the following: "Article with keywords, this is article with keywords, 1, 2012, Phys. Lett, keyword 1, keyword 2"  

Scenario: editing existing article
    Given the following articles are present:
    | title      | abstract      | url               | page  | year | journal    |
    | Happy NY   | NY tree       | www.HappyNY.com   | 102   | 1999 | Murzilka   | 
    | Black hole | event horizon | www.plb.com       | 2     | 2005 | Phys. Lett |
    Given the article entitled "Happy NY" has the following keywords: "k1, k2, k3"
    Given the article entitled "Happy NY" has the following authors: 
    | name  | surname   |
    | Mario |   Galvani |
    | John  |   Frank   |
    | E.    |   Mallow  |
    When I am on edit page for article entitled "Happy NY"
#    Then I should see the following: "Happy NY, NY tree"
    Then the "Articles[title]" field should contain "Happy NY"
    And the "Articles[abstract]" field should contain "NY tree"
    And the "Authors[1][name]" field should contain "John"
    And the "Authors[1][surname]" field should contain "Frank"
    And  I should see "Murzilka"
    And I fill in "Articles[title]" with "Edited Article"
    And I fill in "Articles[abstract]" with "updated abstract"
    And I fill in "Articles[page]" with "101"
    And I select "Phys. Lett" from "Articles[journal]"
    And I fill in "Keywords[name]" with "new keyword 1, new keyword 2, k3"
    And I fill in "Authors[1][name]" with "Edward"
    And I fill in "Authors[1][surname]" with "Rokki"  
    And I press "Update"
    Then I should see the following: "Edited Article, updated abstract, 101, Phys. Lett, 1999, new keyword 1, new keyword 2, k3, Edward Rokki"
    And I should not see the following: "Happy NY, k1, k2, John, Frank"


@javascript @current
Scenario: deleting existing article
    Then I wait for 2 seconds
    Given the following articles are present:
    | title      | abstract      | url               | page  | year | journal    |
    | Happy NY   | NY tree       | www.HappyNY.com   | 102   | 1999 | Murzilka   | 
    | Black hole | event horizon | www.plb.com       | 2     | 2005 | Phys. Lett |
    Then I wait for 2 seconds
    Given the article entitled "Happy NY" has the following keywords: "k1, k2, k3"
    Given I am on the view page of the article entitled "Happy NY"
    Then I wait for jquery to load
    And I wait for 10 seconds
    # Then print last response
    Then I wait for "Delete Article" to appear
    When I follow "Delete Article"
    Then I confirm the popup
    Then I wait for 2 seconds
    Then article entitled "Happy NY" should not be present