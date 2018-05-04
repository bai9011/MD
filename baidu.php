<?php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverAction;

require_once('vendor/autoload.php');


/*
 * 六娃
 *  */
  
$capabilities = DesiredCapabilities::chrome();
/*
 * 使用firefox驱动的时候
 * 方法 sendkeys 竟然会报异常throwException
 * 异常 61:
 * /Users/Yuki/Desktop/php-web/vendor/facebook/webdriver/lib/Exception/WebDriverException.php
 * 我真是
 * 日了狗了
 *  */
//$capabilities = DesiredCapabilities::firefox();

$webDriver=
 RemoteWebDriver::create('http://localhost:4444/wd/hub',$capabilities);
////测试地址//打开页面
$webDriver->get("https://wwww.baidu.com/");
$kw = $webDriver->findElement(WebDriverBy::id('kw'));
$kw->sendKeys("999999");
sleep(1);
/*
研究了一天为啥不能使用click
 * java和python使用click 一次就生效
 * 唯有php 死活不通过 真是跪了
 *  */
//用webdriver获取对象，再进行JS操作
$ele = $webDriver->findElement(WebDriverBy::id('su'));
//isElementExsit($webDriver, WebDriverBy::id('su'));
/*
封装点击事件
 *  *  */
$webDriver->executeScript("arguments[0].click();",[$ele]);
/*用JS获取对象进行操作
 * 等会封装起来
 */
//$js = <<<js
//var ele = document.getElementById('su');
//ele.click();
//js;
//$webDriver->executeScript($js);
//if(isElementExsit($webDriver, WebDriverBy::id('quickdelete'))){
//这个clear方法 12月16号一天没有生效,到了17号下午一运行竟然成功了……我还能说什么
$kw->clear(); 
$kw->sendKeys("这是因为什么啊!");
//这个click竟然可以用,第一个无法用,逼得我使用js点击来实现,why!!!!!!!
$ele->click();
//$webDriver->close();

/**
 * 判断元素是否存在
 * @param WebDriver $driver
 * @param WebDriverBy $locator
 */
function isElementExsit($driver,$locator){
    try {
        $nextbtn = $driver->findElement($locator);
        return true;
    } catch (\Exception $e) {
        echo 'element is not found!';
        return false;
    }
}
?>