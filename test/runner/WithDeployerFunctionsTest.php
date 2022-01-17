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

namespace de\codenamephp\deployer\command\test\runner;

use de\codenamephp\deployer\base\functions\iRun;
use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use PHPUnit\Framework\TestCase;

final class WithDeployerFunctionsTest extends TestCase {

  private WithDeployerFunctions $sut;

  protected function setUp() : void {
    parent::setUp();

    $deployerFunction = $this->createMock(iRun::class);

    $this->sut = new WithDeployerFunctions($deployerFunction);
  }

  public function test__construct() : void {
    $deployerFunction = $this->createMock(iRun::class);

    $this->sut = new WithDeployerFunctions($deployerFunction);

    self::assertSame($deployerFunction, $this->sut->deployerFunction);
  }

  public function testRun() : void {
    $runConfiguration = $this->createMock(iRunConfiguration::class);
    $runConfiguration->expects(self::once())->method('getOptions')->willReturn(['some' => 'options']);

    $command = $this->createMock(iCommand::class);
    $command->expects(self::once())->method('__toString')->willReturn('some command');
    $command->expects(self::once())->method('getRunConfiguration')->willReturn($runConfiguration);

    $this->sut->deployerFunction = $this->createMock(iRun::class);
    $this->sut->deployerFunction->expects(self::once())->method('run')->with('some command', ['some' => 'options'])->willReturn('some output');

    self::assertEquals('some output', $this->sut->run($command));
  }
}
