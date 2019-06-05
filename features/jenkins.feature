Feature: Carry out some tasks using the Jenkins API

  Scenario Outline: Trigger a build
    Given I trigger the "<jobName>" Jenkins build with the token "<token>"
    And I retrieve the console output for the last "<jobName>" Jenkins build

    Examples:
    | jobName | token |
    | test    | test  |