<?php

namespace My;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\WebDriverWait;
use dawood\PhpScreenRecorder\ScreenRecorder;
use Facebook\WebDriver\WebDriverSelect;

class doCheckoutTest extends MyAbstractTestCase {

    public function testShouldAddProductToCart() {
        /*$screenRecorder=new ScreenRecorder();
        $screenRecorder->setScreenSizeToCapture(1920,1080);

        $screenRecorder->startRecording('myVideo.flv');*/
        // Load the URL (will wait until page is loaded)
        $this->wd->get("https://coko-dev-banana.myshopify.com"); // $this->wd holds instance of \RemoteWebDriver

        // Do some assertion
        $this->assertContains('coko-dev-banana', $this->wd->getTitle());

        // You can use $this->log(), $this->warn() or $this->debug() with sprintf-like syntax
        $this->log('Current page "%s" has title "%s"', $this->wd->getCurrentURL(), $this->wd->getTitle());

        // Find Catalog
        $this->findByLinkText('Catalog')->click();

        // Add to cart
        $this->findByLinkText('Orange')->click();

        $this->findById("AddToCartText-product-template")->click();

        // Add to cart
        $this->wd->findElement(WebDriverBy::className('elm_pos_0'))->click();
        //$this->assertContains("Your Shopping Cart– coko-dev-banana",$this->wd->getTitle());

        //$this->assertContains("coko-dev-banana.myshopify.com - Secure Checkout",$this->wd->getTitle());

        // Wait to load -> Find email
        $this->waitForName("email")->click();

        //create cookie to check later which email was entered
        // Enter email
        $this->wd->getKeyboard()->sendKeys('sasokrajnc+1@gmail.com');

        // Find first name
        $this->findByName('first_name')->click();
        // Enter first name
        $this->wd->getKeyboard()->sendKeys('Sašo');

        // Find last name
        $this->findByName('last_name')->click();
        // Enter last name
        $this->wd->getKeyboard()->sendKeys('Krajnc');

        // Find address
        $this->findByName('address1')->click();
        // Enter address
        $this->wd->getKeyboard()->sendKeys('Jesenje 23D');

        // Find city
        $this->findByName('city')->click();
        // Enter city
        $this->wd->getKeyboard()->sendKeys('Kresnice');

        // Find country
        $selectElement = $this->wd->findElement(WebDriverBy::id('shipping_country'));
        $select = new WebDriverSelect($selectElement);
        $select->selectByVisibleText('Slovenia');

        // Find zip
        $this->findByName('zip')->click();
        // Enter zip
        $this->wd->getKeyboard()->sendKeys('1281');

        $this->wd->wait(10, 1000)->until(
            WebDriverExpectedCondition::elementTextContains(WebDriverBy::cssSelector(".ch-shipping-value span"),"$"));

        $this->wd->executeScript("window.scrollTo(0,document.body.scrollHeight)");

        //nmi
        $this->wd->wait(10, 1000)->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::tagName("payment-component")));

        $this->wd->wait(10)->until(
            WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id("cc-number")));

        // Find card number
        $this->findById("cc-number")->click();
        $this->wd->getKeyboard()->sendKeys('4111 1111 1111 1111');

        // Find card name
        $this->findById("cc-name")->click();
        $this->wd->getKeyboard()->sendKeys('Test User');

        // Find card exp
        $this->findById("cc-exp")->click();
        $this->wd->getKeyboard()->sendKeys('1219');

        // Find card cvc
        $this->findById("cc-cvc")->click();
        $this->wd->getKeyboard()->sendKeys('123');

        // Find submit button
        $this->wd->executeScript("$('[name=\"button\"]')[0].scrollIntoView();");
        $this->findByName("button")->click();

        // Wait for thank you page
        $this->wd->wait(30)->until(
            WebDriverExpectedCondition::urlContains("thank-you"));

        //$this->waitForTitleRegexp("Thank You");

        $this->assertContains('Thank You', $this->wd->getTitle());

       /*$screenRecorder->stopRecording();*/
        // End session
        $this->wd->quit();

    }


}