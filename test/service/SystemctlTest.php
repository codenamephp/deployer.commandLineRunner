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

namespace de\codenamephp\deployer\command\test\service;

use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\command\service\Systemctl;
use PHPUnit\Framework\TestCase;

final class SystemctlTest extends TestCase {

  private Systemctl $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Systemctl();
  }

  public function test__construct() : void {
    $this->sut = new Systemctl();

    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->runner);
  }

  public function test__construct_withArguments() : void {
    $runner = $this->createMock(iRunner::class);

    $this->sut = new Systemctl($runner);

    self::assertSame($runner, $this->sut->runner);
  }

  public function testRun() : void {
    $command = new Command(binary: 'systemctl', arguments: ['restart', 'apache2'], sudo: true);

    $this->sut->runner = $this->createMock(iRunner::class);
    $this->sut->runner->expects(self::once())->method('run')->with($command)->willReturn('some output');

    self::assertEquals('some output', $this->sut->run('apache2', 'restart'));
  }
}
