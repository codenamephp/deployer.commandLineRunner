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

namespace de\codenamephp\deployer\command\test\runConfiguration;

use de\codenamephp\deployer\command\runConfiguration\SimpleContainer;
use PHPUnit\Framework\TestCase;

final class SimpleContainerTest extends TestCase {

  private SimpleContainer $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new SimpleContainer();
  }

  public function testGetOptions() : void {
    self::assertEquals([], $this->sut->getOptions());

    $this->sut->timeout = 123;
    $this->sut->idleTimeout = 456;
    $this->sut->secret = 'some secret';
    $this->sut->env = ['some' => 'env', 'bla' => ''];
    $this->sut->realTimeOutput = true;
    $this->sut->noThrow = true;
    $this->sut->cwd = 'some dir';
    $this->sut->shell = 'some shell';

    self::assertEquals([
      'timeout' => 123,
      'idle_timeout' => 456,
      'secret' => 'some secret',
      'env' => ['some' => 'env'],
      'real_time_output' => true,
      'no_throw' => true,
      'cwd' => 'some dir',
      'shell' => 'some shell',
    ], $this->sut->getOptions());
  }

  public function test__construct() : void {
    $this->sut = new SimpleContainer(
      123,
      456,
      'some secret',
      ['some' => 'env'],
      true,
      true,
      'some dir',
      'some shell'
    );

    self::assertSame(123, $this->sut->timeout);
    self::assertSame(456, $this->sut->idleTimeout);
    self::assertSame('some secret', $this->sut->secret);
    self::assertSame(['some' => 'env'], $this->sut->env);
    self::assertTrue($this->sut->realTimeOutput);
    self::assertTrue($this->sut->noThrow);
    self::assertSame('some dir', $this->sut->cwd);
    self::assertSame('some shell', $this->sut->shell);
  }
}
