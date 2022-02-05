# deployer.command

![Packagist Version](https://img.shields.io/packagist/v/codenamephp/deployer.command)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/codenamephp/deployer.command)
![Lines of code](https://img.shields.io/tokei/lines/github/codenamephp/deployer.command)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/codenamephp/deployer.command)
![CI](https://github.com/codenamephp/deployer.command/workflows/CI/badge.svg)
![Packagist Downloads](https://img.shields.io/packagist/dt/codenamephp/deployer.command)
![GitHub](https://img.shields.io/github/license/codenamephp/deployer.command)

## What is it?

This package provides basic functionality for command line tasks and service handling.

## Installation

Easiest way is via composer. Just run `composer require codenamephp/deployer.command` in your cli which should install the latest version for you.

## Usage

### Commands

This package provides a `\de\codenamephp\deployer\command\runner\iRunner` that abstracts running of commands. The default implementation
`\de\codenamephp\deployer\command\runner\WithDeployerFunctions` - as the name suggests - uses the `Deployer\run()` method to run commands.

The `\de\codenamephp\deployer\command\iCommand` interface is designed to just get a command string along with a
`\de\codenamephp\deployer\command\runConfiguration\iRunConfiguration` that holds the options like timeouts etc. to run the command with. The
default `\de\codenamephp\deployer\command\Command` provides a simple API to build a command. Recommended usage is to create a Factory to build a command with
the binary, arguments etc. This factory can then be used in tasks to build the command and the runner to run it.

### Service

There is a `\de\codenamephp\deployer\command\service\iService` interface that is intended to manage service with
`\de\codenamephp\deployer\command\service\Service` and `\de\codenamephp\deployer\command\service\Systemctl` to manage debian services.
