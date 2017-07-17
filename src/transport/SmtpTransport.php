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
    /**
     * SMTP params for transport
     * host
     * port
     * login
     * password
     * @var array
     *
     */
    protected $params = [];

    /**
     * TODO: Запилить драйвер SMTP
     * @var
     */
    protected $connection;
    public function __construct($params)
    {
        foreach ($params as $name=>$value){
            $this->setParam($name,$value);
        }
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getParam($name)
    {
        if (isset($this->params[$name])){
            return $this->params[$name];
        }
        return false;
    }

    public function send(Mail $message)
    {
        // TODO: Implement send() method.
        return false;
    }
}