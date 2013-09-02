Feature: adding and editing article info
  As a site admin
  In order to keep information updated
  I need to be able to insert article info

 Background: I am logged in as admin
    Given I am on "index.php?r=site/login"
    When I fill in "LoginForm[username]" with "Andrew"
    And  I fill in "LoginForm[password]" with "test"
    And I press "Login"
    Then I should see "Andrew"
    And I should see "Logout"
    And I should not see "Login"

  Scenario: creating article 
    Given I am on "/index.php?r=articles/create"
    When I fill in "Articles[title]" with "About all properties"
    And I fill in "Articles[abstract]" with "Oho-ho-ho"
    And I fill in "Articles[url]" with "www.oho-ho.com"
    And I fill in "Articles[page]" with "112"
    And I fill in "Articles[year]" with "1987"
    And I select "" from "Articles[journal]" 
    And I press "Create"
    Then I should see "About all properties"
    Then I should see "Oho-ho-ho"
    Then I should see "www.oho-ho.com"
    Then I should see "112"
    Then I should see "1987"
    Then I should see ""



