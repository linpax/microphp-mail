<?php
/**
 * @link https://github.com/linpax/microphp-mail
 * @copyright Copyright &copy; 2017 Linpax
 * @license https://github.com/linpax/microphp-mail/blob/master/LICENSE
 */

namespace Micro\Mail;


class Mail
{
    const MIME_TEXT = 'text/plain';
    const MIME_HTML = 'text/html';

    /** @var array $to Recipient */
    private $to = [];
    /** @var array $CC Carbon copy */
    private $CC = [];
    /** @var array $BCC Blind carbon copy */
    private $BCC = [];
    /** @var string $type Doctype */
    private $type = 'text/html';
    /** @var string $encoding encoding */
    private $encoding = 'utf-8';
    /** @var string $subject Subject */
    private $subject;
    /** @var string $text Body */
    private $text;
    /** @var array $headers Headers */
    private $headers = [];
    /** @var array $params Parameters */
    private $params = [];


    /**
     * Message constructor
     *
     * @access public
     *
     * @param string $from
     * @param string $fromName
     *
     * @result void
     */
    public function __construct($from = '', $fromName = '')
    {
        if ($from) {
            $this->setHeader('From', sprintf('=?utf-8?B?%s?= <%s>', base64_encode($fromName), $from));
        }
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $mail
     * @return $this
     */
    public function addTo($mail)
    {
        $this->to[] = $mail;
        return $this;
    }

    /**
     * @param string|string $mail
     * @return $this
     */
    public function setTo($mail)
    {
        $this->to = is_array($mail) ? $mail : [$mail];
        return $this;
    }

    /**
     * @return array
     */
    public function getCC()
    {
        return $this->CC;
    }

    /**
     * @param string $CC
     * @return $this
     */
    public function addCC($CC)
    {
        $this->CC[] = $CC;
        return $this;
    }

    /**
     * @param array|string $CC
     * @return $this
     */
    public function setCC($CC)
    {
        $this->CC = is_array($CC) ? $CC : [$CC];
        return $this;
    }

    /**
     * @return array
     */
    public function getBCC()
    {
        return $this->BCC;
    }

    /**
     * @param string $BCC
     * @return $this
     */
    public function addBCC($BCC)
    {
        $this->BCC[] = $BCC;
        return $this;
    }

    /**
     * @param array|string $BCC
     * @return $this
     */
    public function setBCC($BCC)
    {
        $this->BCC = is_array($BCC) ? $BCC : $BCC;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setSubject($text)
    {
        $this->subject = '=?utf-8?B?' . base64_encode($text) . '?=';
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $body
     * @param string $type
     * @param string $encoding
     * @return $this
     * @throws Exception
     */
    public function setText($body, $type = self::MIME_TEXT, $encoding = 'utf-8')
    {
        if (!in_array($type, [self::MIME_TEXT, self::MIME_HTML])) {
            throw new Exception('Mime-type ' . $type . ' is not allowed here');
        }
        $this->text = $body;
        $this->type = $type;
        $this->encoding = $encoding;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeaders()
    {
        return sprintf("%s\r\nContent-type: %s; charset=%s\r\n",
            implode("\r\n", array_values($this->headers)),
            $this->type,
            $this->encoding
        );
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $name . ': ' . $value;
        return $this;
    }

    /**
     * @param $name
     * @return bool|string
     */
    public function getHeader($name)
    {
        if (!isset($this->headers[$name])) {
            return false;
        }
        return $this->headers[$name];
    }

    /**
     * @return bool|string
     */
    public function getParamsAsString()
    {
        if (!$this->params) {
            return false;
        }

        return implode("\r\n", array_values($this->params)) . "\r\n";
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setParam($name, $value)
    {
        $this->params[$name] = $name . ': ' . $value;
        return $this;
    }
}