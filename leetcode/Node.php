<?php

/**
 * 节点类
 *
 * User: kendo
 * Date: 2019/2/19
 */
class Node
{
    public $data;
    public $next = null;

    function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * 统计单向链表长度
 *
 * @param $head
 * @return int
 */
function countNode($head)
{
    $cursor = $head;
    $len = 0;
    while (!is_null($cursor->next)) {
        $len++;
        $cursor = $cursor->next;
    }
    return $len;
}

/**
 * 向单向链表里增加节点
 *
 * @param $head 链表头节点
 * @param $data 需要增加的节点数据
 */
function appendNode($head, $data)
{
    $cursor = $head;
    while (!is_null($cursor->next)) {
        $cursor = $cursor->next;
    }
    $cursor->next = new Node($data);
}

/**
 * 在制定的位置后插入节点
 *
 * @param $head
 * @param $data
 * @param $no
 * @return bool
 */
function insertNode($head, $data, $no)
{
    if ($no > countNode($head)) {
        return false;
    }
    $cursor = $head;
    for ($i = 0; $i < $no; $i++) {
        $cursor = $cursor->next;
    }
    $new = new Node($data);
    $new->next = $cursor->next;
    $cursor->next = $new;
    return true;
}

/**
 * 删除第$no个节点
 *
 * @param $head
 * @param $no
 * @return bool
 */
function deleteNode($head, $no)
{
    if ($no > countNode($head)) {
        return false;
    }
    $cursor = $head;
    for ($i = 0; $i < $no; $i++) {
        $cursor = $cursor->next;
    }
    $cursor->next = $cursor->next->next;
    return true;
}

/**
 * 更新节点
 *
 * @param $head
 * @param $no
 * @param $data
 * @return bool
 */
function updateNode($head, $no, $data)
{
    if ($no > countNode($head)) {
        return false;
    }
    $cursor = $head;
    for ($i = 0; $i < $no - 1; $i++) {
        $cursor = $cursor->next;
    }
    $cursor->next = new Node($data);
    return true;
}

/**
 * 遍历链表
 *
 * @param $head
 * @return array
 */
function showNode($head)
{
    $result = [];
    while (!is_null($head)) {
        $result[] = $head->data;
        $head = $head->next;
    }
    return $result;
}

//定义头节点
$head = new Node(null);

appendNode($head, 'a');
appendNode($head, 'b');
appendNode($head, 'c');
appendNode($head, 'd');
appendNode($head, 'f');

insertNode($head, 'x', 3);

showNode($head);