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

namespace de\codenamephp\deployer\command\runner;

use de\codenamephp\deployer\command\iCommand;
use Deployer\Exception\Exception;
use Deployer\Exception\RunException;
use Deployer\Exception\TimeoutException;

/**
 * Interface for a command line runner.
 */
interface iRunner {

  /**
   * Implementations MUST run the command and return the output and pass on the runConfiguration. Implementations SHOULD support deployer-like placeholders.
   *
   * @param iCommand $command The command to run
   * @return string The output of the command
   *
   * @throws Exception|RunException|TimeoutException
   */
  public function run(iCommand $command) : string;
}