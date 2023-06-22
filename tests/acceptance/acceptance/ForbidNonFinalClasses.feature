@forbid
Feature: Forbid non-final classes
  Non final classes are forbidden

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
  Scenario: Asserting non final classes are forbidden
    Given I have the following code
    """
    <?php
    class Something {}
    """
    When I run Psalm
    Then I see these errors
      | Type                        | Message                          |
      | NonFinalClassesAreForbidden | Non final classes are forbidden. |

  Scenario: Assert that final classes are allowed
    Given I have the following code
    """
    <?php
    final class Something
    {
    }
    """
    When I run Psalm
    Then I see no errors

  Scenario: Assert that abstract classes are allowed
    Given I have the following code
    """
    <?php
    abstract class Something
    {
    }
    """
    When I run Psalm
    Then I see no errors

  Scenario: Assert that anonymous classes are allowed
    Given I have the following code
    """
    <?php
    $_a = new class () {};
    """
    When I run Psalm
    Then I see no errors