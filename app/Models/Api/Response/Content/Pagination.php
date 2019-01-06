<?php

namespace App\Models\Api\Response\Content;


class Pagination implements \JsonSerializable
{
    protected $page_size;
    protected $page;
    protected $total;

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->page_size;
    }

    /**
     * @param int $page_size
     */
    public function setPageSize($page_size)
    {
        $this->page_size = $page_size;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Specify data which should be serialized to JSON.
     */
    public function jsonSerialize()
    {
        return [
            'page_size' => $this->page_size,
            'page' => $this->page,
            'total' => $this->total,
        ];
    }
}