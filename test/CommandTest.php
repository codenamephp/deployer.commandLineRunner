<?php declare(strict_types=1);
/*
 *   Copyright 2022 Bastian Schwarz <bastian@codename-php.de>.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */

namespace de\codenamephp\deployer\command\test;

use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use PHPUnit\Framework\TestCase;

final class CommandTest extends TestCase {

  private Command $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Command('');
  }

  public function test__construct() : void {
    $binary = 'some binary';
    $runConfiguration = $this->createMock(iRunConfiguration::class);
    $arguments = ['test', '--test'];
    $envVars = ['some' => 'env'];

    $this->sut = new Command($binary, $runConfiguration, $arguments, $envVars, true);

    self::assertSame($binary, $this->sut->binary);
    self::assertSame($runConfiguration, $this->sut->runConfiguration);
    self::assertSame($arguments, $this->sut->arguments);
    self::assertSame($envVars, $this->sut->envVars);
    self::assertTrue($this->sut->sudo);
  }

  public function test__toString() : void {
    $this->sut->binary = 'some binary';
    $this->sut->arguments = ['bla' => 'test', '--test'];
    $this->sut->envVars = ['some' => 'env', 'more' => 'vars'];
    $this->sut->sudo = true;

    self::assertEquals('some=env; more=vars; sudo some binary test --test', $this->sut->__toString());
  }

  public function test__toString_withMinimalProperties() : void {
    $this->sut->binary = 'some binary';

    self::assertEquals('some binary', $this->sut->__toString());
  }

  public function testGetRunConfiguration() : void {
    self::assertSame($this->sut->runConfiguration, $this->sut->getRunConfiguration());
  }
}
