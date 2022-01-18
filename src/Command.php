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

namespace de\codenamephp\deployer\command;

use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\command\runConfiguration\SimpleContainer;

/**
 * Simple command where the binary is mandatory and arguments, env vars, sudo and a run configuration can be set
 */
final class Command implements iCommand {

  /**
   * @param string $binary The binary to be executed, e.g. ls or composer
   * @param array<string> $arguments Arguments to use when running the command, e.g. '-l', 'install', '--composer', '--name=value'
   * @param array<string,string> $envVars Env vars to set when running the command. They will be prepended to the binary with the key as name
   * @param bool $sudo Flag to run the command with sudo
   * @param iRunConfiguration $runConfiguration The run configuration to use when running the command
   */
  public function __construct(
    public string            $binary,
    public array             $arguments = [],
    public array             $envVars = [],
    public bool              $sudo = false,
    public iRunConfiguration $runConfiguration = new SimpleContainer(),
  ) {}

  public function getRunConfiguration() : iRunConfiguration {
    return $this->runConfiguration;
  }

  public function __toString() : string {
    return implode(' ', array_filter([
      ...array_map(static fn(string $name, string $value) : string => sprintf('%s=%s;', $name, $value), array_keys($this->envVars), $this->envVars),
      $this->sudo ? 'sudo' : '',
      $this->binary,
      ...$this->arguments,
    ]));
  }

}