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

namespace de\codenamephp\deployer\command\runConfiguration;

/**
 * Interface that acts as a simple container by providing named fields. The fields are then packed into an array
 */
final class SimpleContainer implements iRunConfiguration {

  public function __construct(
    public int    $timeout = 0,
    public int    $idleTimeout = 0,
    public string $secret = '',
    public array  $env = [],
    public bool   $realTimeOutput = false,
    public bool   $noThrow = false,
    public string $cwd = '',
    public string $shell = ''
  ) {}

  public function getOptions() : array {
    return array_filter([
      'timeout' => $this->timeout,
      'idle_timeout' => $this->idleTimeout,
      'secret' => $this->secret,
      'env' => $this->env,
      'real_time_output' => $this->realTimeOutput,
      'no_throw' => $this->noThrow,
      'cwd' => $this->cwd,
      'shell' => $this->shell,
    ]);
  }
}