@forbid
Feature: Forbid traits
  Traits are forbidden

  Background:
    Given I have the following config
      """
      <?xml version="1.0"?>
      <psalm errorLevel="1">
        <projectFiles>
          <directory name="."/>
          <ignoreFiles> <directory name="../../vendor"/> </ignoreFiles>
        </projectFiles>
        <plugins>
          <pluginClass class="Kafkiansky\Forbid\Plugin"/>
        </plugins>
      </psalm>
      """
  Scenario: Asserting traits are forbidden
    Given I have the following code
    """
    <?php
    trait Something {}
    """
    When I run Psalm
    Then I see these errors
      | Type              | Message              |
      | TraitAreForbidden | Trait are forbidden. |