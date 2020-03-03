<?php


namespace App\Model;


class ListNode
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = NULL;
    }

    public function readNode()
    {
        return $this->data;
    }
}