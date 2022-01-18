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

namespace de\codenamephp\deployer\command\service;

use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;

/**
 * Uses systemctl to handle the service. The command is executed using an iRunner instance
 */
final class Systemctl implements iService {

  public function __construct(public iRunner $runner = new WithDeployerFunctions()) {}

  public function run(string $serviceName, string $action, bool $sudo = true) : string {
    return $this->runner->run(new Command(binary: 'systemctl', arguments: [$action, $serviceName], sudo: $sudo));
  }
}