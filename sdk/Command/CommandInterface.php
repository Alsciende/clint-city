<?php

namespace Sdk\Command;

interface CommandInterface extends \Api\Dto\CommandInterface
{
    public function getClassName(): string;
    public function setResult($result);
    public function getResult();
}