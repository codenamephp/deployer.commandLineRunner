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

use Deployer\Exception\Exception;
use Deployer\Exception\RunException;
use Deployer\Exception\TimeoutException;

/**
 * Interface to control services, e.g. through service, init.d or systemctl
 */
interface iService {

  /**
   * Performs the given action for the given service. Implementations should use an iRunner implementation to execute the command
   *
   * @param string $serviceName The name of the service to handle, e.g. apache2, docker, ...
   * @param string $action The action to perform, e.g. restart, reload, ...
   * @param bool $sudo To use sudo or not, defaults to true
   * @return string The output of the command
   *
   * @throws Exception|RunException|TimeoutException
   */
  public function run(string $serviceName, string $action, bool $sudo = true) : string;
}