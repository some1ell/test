<?php

namespace My;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class doCheckoutBSTest extends MyAbstractTestCase
{
    public function testShouldAddProductToCart()
    {
        $caps = array(
            "browser" => "Chrome",
            "browser_version" => "62.0",
            "os" => "Windows",
            "os_version" => "10",
            "resolution" => "1024x768",
            "local" => "true",
            "localIdentifier" => "BROWSERSTACK_LOCAL_IDENTIFIER"
        );
        $this->wd = RemoteWebDriver::create(
            "https://benfisher4:mVjnFtMSD3V8eGxaeorF@hub-cloud.browserstack.com/wd/hub",
            $caps
        );

        // Load the URL (will wait until page is loaded)
        $this->wd->get(self::$baseUrl); // $this->wd holds instance of \RemoteWebDriver

        // Do some assertion
        $this->assertContains('coko-dev-banana', $this->wd->getTitle());

        // You can use $this->log(), $this->warn() or $this->debug() with sprintf-like syntax
        $this->log('Current page "%s" has title "%s"', $this->wd->getCurrentURL(), $this->wd->getTitle());

        // Find Catalog
        $this->findByLinkText('Catalog')->click();

        // Add to cart
        $this->findByLinkText('Apple')->click();

        $this->findById("AddToCartText-product-template")->click();
        $this->wd->quit();
    }
}