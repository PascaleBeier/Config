<?php

namespace PascaleBeier\Config\Exception;

class NotAnArrayException extends \Exception
{
    protected $message = 'The included Configuration File did not return an array.';
}
