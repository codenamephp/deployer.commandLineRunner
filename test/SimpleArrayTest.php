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

use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\command\SimpleArray;
use PHPUnit\Framework\TestCase;

final class SimpleArrayTest extends TestCase {

  private SimpleArray $sut;

  protected function setUp() : void {
    parent::setUp();

    $runConfiguration = $this->createMock(iRunConfiguration::class);

    $this->sut = new SimpleArray([], $runConfiguration);
  }

  public function testGetRunConfiguration() : void {
    $runConfiguration = $this->createMock(iRunConfiguration::class);

    $this->sut->runConfiguration = $runConfiguration;

    self::assertSame($runConfiguration, $this->sut->getRunConfiguration());
  }

  public function test__construct() : void {
    $runConfiguration = $this->createMock(iRunConfiguration::class);
    $commandParts = ['some', 'command'];

    $this->sut = new SimpleArray($commandParts, $runConfiguration);

    self::assertSame($runConfiguration, $this->sut->getRunConfiguration());
    self::assertEquals($commandParts, $this->sut->commandParts);
  }

  public function test__toString() : void {
    $this->sut->commandParts = ['some', 'command', '', 'parts'];

    self::assertEquals('some command parts', $this->sut->__toString());
  }
}
