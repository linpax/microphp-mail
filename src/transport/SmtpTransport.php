<?php
/**
 * @link https://github.com/linpax/microphp-mail
 * @copyright Copyright &copy; 2017 Linpax
 * @license https://github.com/linpax/microphp-mail/blob/master/LICENSE
 */

namespace Micro\Mail\Transport;

use Micro\Mail\Mail;
use Micro\Mail\TransportInterface;


class SmtpTransport implements TransportInterface
{
    public function send(Mail $message)
    {
        // TODO: Implement send() method.
        return false;
    }
}