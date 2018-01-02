<?php

namespace Craue\ConfigBundle\Tests\Repository;

use Craue\ConfigBundle\Entity\Setting;
use Craue\ConfigBundle\Tests\IntegrationTestCase;

/**
 * @group integration
 *
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-present Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class SettingRepositoryTest extends IntegrationTestCase {

	/**
	 * @dataProvider getPlatformConfigs
	 */
	public function testFindByNames($platform, $config, $requiredExtension) {
		$this->initClient($requiredExtension, array('environment' => $platform, 'config' => $config));

		$setting1 = $this->persistSetting(Setting::create('name1'));
		$setting2 = $this->persistSetting(Setting::create('name2'));

		$repo = $this->getSettingsRepo();

		$expectedResult = array(
			'name1' => $setting1,
			'name2' => $setting2,
		);

		$this->assertEquals($expectedResult, $repo->findByNames(array_keys($expectedResult)));
	}

}
