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

/**
 * Interface for commands that will be resolved to a string and most likely passed to Deployer\run
 *
 * Implementations should take care of the binary, arguments, options, sudo, ...
 */
interface iCommand {

  /**
   * Array of options that will be passed to Deployer\run like timeout, env vars, ...
   *
   * @return array
   */
  public function getOptions() : array;

  /**
   * The complete command line as string, e.g. 'composer install -vvv --no-dev'
   *
   * @return string
   */
  public function __toString() : string;
}