<?php

namespace App\Models\Api\Response\Content;


class Error implements \JsonSerializable
{
    protected $error;
    protected $message;
    protected $front_message;

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getFrontMessage()
    {
        return $this->front_message;
    }

    /**
     * @param string $front_message
     */
    public function setFrontMessage($front_message): void
    {
        $this->front_message = $front_message;
    }

    /**
     * Specify data which should be serialized to JSON.
     */
    public function jsonSerialize()
    {
        return array_filter([
            'error' => $this->error,
            'message' => $this->message,
            'front_message' => $this->front_message
        ]);
    }
}