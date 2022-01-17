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
 * Interface for the run configuration that is used when running commands. The interface is designed to work with the Deployer\run() and
 * Deployer\runLocally() methods. Sadly, the API has some bad design: Some options are available as named arguments but the options array will overwrite them
 * again. And to disable values they are supposed to be nulled. This creates a hard to follow state and options can be set twice.
 *
 * This interface only requires a options array that is built by implementations. So the implementations take care of the API and construct the array
 * and take care of fallbacks and cleaning empty values.
 */
interface iRunConfiguration {

  /**
   *  Array of options to be passed to the run and runLocally methods
   *
   * Implementations MUST make sure to remove empty values in order for deployer to use defaults
   *
   * @return array{
   *    timeout?: int,
   *    idle_timeout?: int,
   *    secret?: string,
   *    env?: array<scalar>,
   *    real_time_output?: bool,
   *    no_throw?: bool,
   *    cwd?: string,
   *    shell?: string,
   *  }
   */
  public function getOptions() : array;
}