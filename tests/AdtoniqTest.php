<?php
use PHPUnit\Framework\TestCase;
require_once('../src/Adtoniq.class.php');

// mocks
function loadAdtoniqScript() {
  return null;
}
function saveAdtoniqScript($script) {
}

final class AdtoniqTest extends TestCase
{
    public function testCanSetApiKey()
    {
        $config = array(
          'apiKey' => '469ddcde-e87d-4f61-8bce-a759c46dcad9',
          'loadScript' => 'loadAdtoniqScript',
          'saveScript' => 'saveAdtoniqScript'
        );
        $instance = new Adtoniq($config);
        $this->assertEquals(
            '469ddcde-e87d-4f61-8bce-a759c46dcad9',
            $instance->getApiKey()
        );
    }

    public function testCanGetJavascript()
    {
        $config = array(
          'apiKey' => '469ddcde-e87d-4f61-8bce-a759c46dcad9',
          'loadScript' => 'loadAdtoniqScript',
          'saveScript' => 'saveAdtoniqScript'
        );
        $instance = new Adtoniq($config);
        $instance->getLatestJavascript();
        $this->assertContains(
            '<script>',
            $instance->getJavascript()
        );
    }

    public function testCanGetHeadCode()
    {
        $config = array(
          'apiKey' => '469ddcde-e87d-4f61-8bce-a759c46dcad9',
          'loadScript' => 'loadAdtoniqScript',
          'saveScript' => 'saveAdtoniqScript'
        );
        $instance = new Adtoniq($config);
        $instance->getLatestJavascript();
        $this->assertContains(
            '<script>',
            $instance->getHeadCode()
        );
    }

    public function testCanGetBodyCode()
    {
      $config = array(
        'apiKey' => '469ddcde-e87d-4f61-8bce-a759c46dcad9',
        'loadScript' => 'loadAdtoniqScript',
        'saveScript' => 'saveAdtoniqScript'
      );
      $instance = new Adtoniq($config);
      $output = $instance->getBodyCode();
      $this->assertNotNull(
          $output
      );
    }
}
