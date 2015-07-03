<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 03/07/2015
 * Time: 08:32
 */

namespace AppBundle\Entity;


class AlertBootStrap {
    private $type;
    private $message;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}