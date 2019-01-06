<?php

namespace App\Models\Api\Response;


class Content implements \JsonSerializable
{
    protected $data;
    protected $duration;
    protected $pagination;
    protected $error;

    /**
     * @return mixed
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    /**
     * @param mixed $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @return mixed
     */
    public function getError(): Error
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * Specify data which should be serialized to JSON.
     */
    public function jsonSerialize()
    {
        return array_filter([
            'data' => $this->data,
            'duration' => $this->duration,
            'pagination' => $this->pagination,
            'error' => $this->error,
        ]);
    }
}