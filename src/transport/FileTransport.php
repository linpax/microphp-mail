<?php
/**
 * @link https://github.com/linpax/microphp-mail
 * @copyright Copyright &copy; 2017 Linpax
 * @license https://github.com/linpax/microphp-mail/blob/master/LICENSE
 */

namespace Micro\Mail\Transport;

use Micro\Mail\Mail;
use Micro\Mail\TransportInterface;


class FileTransport implements TransportInterface
{
    protected $basepath;


    public function send(Mail $message)
    {
        return file_put_contents($this->basepath . '/' . $this->genFilename(), serialize($message), FILE_APPEND);
    }

    public function genFilename()
    {
        $time = \time();

        return \date('Y-m-d_H-i-s_' . \mt_rand(0, 9999), $time);
    }
}