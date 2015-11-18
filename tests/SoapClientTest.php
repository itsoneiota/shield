<?php
namespace itsoneiota\shield;

class SoapClientTest extends \PHPUnit_Framework_TestCase {

	protected $sut;
	protected $cache;

	public function setUp() {
		$this->sut = new SoapClient(NULL, ['location'=>'http://foo.bar.com', 'uri'=>'namespace']);
	}

	/**
	 * It throw an exception from __doRequest() directly.
	 * @test
	 * @expectedException \SoapFault
	 */
	public function canThrowSoapFaultViaSpecialDoRequestMethod() {
		$this->sut->__doRequestAndThrowExceptions('someRequest', 'http://foo.bar.com' , 'someAction' , 1);
	}

	/**
	 * It should not throw an exception from __doRequest() directly.
	 * @test
	 */
	public function canSwallowSoapFaultInDoRequest() {
		try {
			$this->sut->__doRequest('someRequest', 'http://foo.bar.com' , 'someAction' , 1);
			$this->assertTrue(TRUE);
		} catch (\Exception $e) {
			$this->assertTrue(FALSE);
		}

	}

	/**
	 * Continue to throw an exception from an indirect __call method.
	 * @test
	 * @expectedException \SoapFault
	 */
	public function canThrowSoapFaultFromMagicMethodCall() {
		$this->sut->foo();
	}
}
