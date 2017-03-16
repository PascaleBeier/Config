<?php

namespace PascaleBeier\Config\Exception;

class FileNotFoundException extends \Exception
{
    protected $message = 'Specified Configuration File not found. Did you set the Config Path correctly?';
}
