<?php

class tx_crawler_domain_process_collection_testcase extends \TYPO3\CMS\Core\Tests\UnitTestCase {


	public function setUp() {

	}

	/**
	 * @test
	 */
	public function canGetUids() {
		$processes = array();
		$row1=array('process_id'=>11);
		$processes[]= new tx_crawler_domain_process($row1);
		$row2=array('process_id'=>13);
		$processes[]= new tx_crawler_domain_process($row2);
		$collection = new tx_crawler_domain_process_collection($processes);

		$this->assertEquals($collection->getProcessIds(),array('11','13'));

	}

}