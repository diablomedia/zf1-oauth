<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */


/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 */
class Zend_Oauth_ConsumerTest extends PHPUnit\Framework\TestCase
{
    public function teardown(): void
    {
        Zend_Oauth::clearHttpClient();
    }

    public function testConstructorSetsConsumerKey()
    {
        $config   = array('consumerKey' => '1234567890');
        $consumer = new Zend_Oauth_Consumer($config);
        $this->assertEquals('1234567890', $consumer->getConsumerKey());
    }

    public function testConstructorSetsConsumerSecret()
    {
        $config   = array('consumerSecret' => '0987654321');
        $consumer = new Zend_Oauth_Consumer($config);
        $this->assertEquals('0987654321', $consumer->getConsumerSecret());
    }

    public function testSetsSignatureMethodFromOptionsArray()
    {
        $options = array(
            'signatureMethod' => 'rsa-sha1'
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('RSA-SHA1', $consumer->getSignatureMethod());
    }

    public function testSetsRequestMethodFromOptionsArray() // add back
    {
        $options = array(
            'requestMethod' => Zend_Oauth::GET
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals(Zend_Oauth::GET, $consumer->getRequestMethod());
    }

    public function testSetsRequestSchemeFromOptionsArray()
    {
        $options = array(
            'requestScheme' => Zend_Oauth::REQUEST_SCHEME_POSTBODY
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals(Zend_Oauth::REQUEST_SCHEME_POSTBODY, $consumer->getRequestScheme());
    }

    public function testSetsVersionFromOptionsArray()
    {
        $options = array(
            'version' => '1.1'
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('1.1', $consumer->getVersion());
    }

    public function testSetsCallbackUrlFromOptionsArray()
    {
        $options = array(
            'callbackUrl' => 'http://www.example.com/local'
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/local', $consumer->getCallbackUrl());
    }

    public function testSetsRequestTokenUrlFromOptionsArray()
    {
        $options = array(
            'requestTokenUrl' => 'http://www.example.com/request'
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/request', $consumer->getRequestTokenUrl());
    }

    public function testSetsUserAuthorizationUrlFromOptionsArray()
    {
        $options = array(
            'userAuthorizationUrl' => 'http://www.example.com/authorize'
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/authorize', $consumer->getUserAuthorizationUrl());
    }

    public function testSetsAccessTokenUrlFromOptionsArray()
    {
        $options = array(
            'accessTokenUrl' => 'http://www.example.com/access'
        );
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/access', $consumer->getAccessTokenUrl());
    }

    public function testSetSignatureMethodThrowsExceptionForInvalidMethod()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);

        $this->expectException(Zend_Oauth_Exception::class);
        $consumer->setSignatureMethod('buckyball');
    }

    public function testSetRequestMethodThrowsExceptionForInvalidMethod()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);

        $this->expectException(Zend_Oauth_Exception::class);
        $consumer->setRequestMethod('buckyball');
    }

    public function testSetRequestSchemeThrowsExceptionForInvalidMethod()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);

        $this->expectException(Zend_Oauth_Exception::class);
        $consumer->setRequestScheme('buckyball');
    }

    public function testSetLocalUrlThrowsExceptionForInvalidUrl()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);

        $this->expectException(Zend_Oauth_Exception::class);
        $consumer->setLocalUrl('buckyball');
    }

    public function testSetRequestTokenUrlThrowsExceptionForInvalidUrl()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);

        $this->expectException(Zend_Oauth_Exception::class);
        $consumer->setRequestTokenUrl('buckyball');
    }

    public function testSetUserAuthorizationUrlThrowsExceptionForInvalidUrl()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);

        $this->expectException(Zend_Oauth_Exception::class);
        $consumer->setUserAuthorizationUrl('buckyball');
    }

    public function testSetAccessTokenUrlThrowsExceptionForInvalidUrl()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);

        $this->expectException(Zend_Oauth_Exception::class);
        $consumer->setAccessTokenUrl('buckyball');
    }

    public function testGetRequestTokenReturnsInstanceOfOauthTokenRequest()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);
        $token    = $consumer->getRequestToken(null, null, new Test_Http_RequestToken_48231);
        $this->assertInstanceOf(Zend_Oauth_Token_Request::class, $token);
    }

    public function testGetRedirectUrlReturnsUserAuthorizationUrlWithParameters()
    {
        $config = array('consumerKey' => '12345','consumerSecret' => '54321',
            'userAuthorizationUrl'    => 'http://www.example.com/authorize');
        $consumer = new Test_Consumer_48231($config);
        $params   = array('foo' => 'bar');
        $uauth    = new Zend_Oauth_Http_UserAuthorization($consumer, $params);
        $token    = new Zend_Oauth_Token_Request;
        $token->setParams(array('oauth_token' => '123456', 'oauth_token_secret' => '654321'));
        $redirectUrl = $consumer->getRedirectUrl($params, $token, $uauth);
        $this->assertEquals(
            'http://www.example.com/authorize?oauth_token=123456&oauth_callback=http%3A%2F%2Fwww.example.com%2Flocal&foo=bar',
            $redirectUrl
        );
    }

    public function testGetAccessTokenReturnsInstanceOfOauthTokenAccess()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Zend_Oauth_Consumer($config);
        $rtoken   = new Zend_Oauth_Token_Request;
        $rtoken->setToken('token');
        $token = $consumer->getAccessToken(array('oauth_token' => 'token'), $rtoken, null, new Test_Http_AccessToken_48231);
        $this->assertInstanceOf(Zend_Oauth_Token_Access::class, $token);
    }

    public function testGetLastRequestTokenReturnsInstanceWhenExists()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Test_Consumer_48231($config);
        $this->assertTrue($consumer->getLastRequestToken() instanceof Zend_Oauth_Token_Request);
    }

    public function testGetLastAccessTokenReturnsInstanceWhenExists()
    {
        $config   = array('consumerKey' => '12345','consumerSecret' => '54321');
        $consumer = new Test_Consumer_48231($config);
        $this->assertTrue($consumer->getLastAccessToken() instanceof Zend_Oauth_Token_Access);
    }
}

class Test_Http_RequestToken_48231 extends Zend_Oauth_Http_RequestToken
{
    public function __construct()
    {
    }
    public function execute(?array $params = null)
    {
        $return = new Zend_Oauth_Token_Request;
        return $return;
    }
    public function setParams(array $customServiceParameters)
    {
    }
}

class Test_Http_AccessToken_48231 extends Zend_Oauth_Http_AccessToken
{
    public function __construct()
    {
    }
    public function execute(?array $params = null)
    {
        $return = new Zend_Oauth_Token_Access;
        return $return;
    }
    public function setParams(array $customServiceParameters)
    {
    }
}

class Test_Consumer_48231 extends Zend_Oauth_Consumer
{
    public function __construct(array $options = array())
    {
        $this->_requestToken = new Zend_Oauth_Token_Request;
        $this->_accessToken  = new Zend_Oauth_Token_Access;
        parent::__construct($options);
    }
    public function getCallbackUrl()
    {
        return 'http://www.example.com/local';
    }
}
