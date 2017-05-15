<?php declare(strict_types = 1);
namespace omnivalor\behat;


/**
 * Created by PhpStorm.
 * Date: 12.09.2016
 * Time: 18:22
 */

class MailSendFile extends PHPUnit_Framework_TestCase
{
    public function sendEmail()
    {
        $process = new \Symfony\Component\Process\Process('php app/console app:mail-send');
        $process->start();
    }
}