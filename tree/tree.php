<?php

/**
 * Created by PhpStorm.
 * User: kendo
 * Date: 2016/12/16
 * Time: 下午5:32
 * preorder 前序遍历 根节点->左子树->右子树
 * inorder 中序遍历 左子树->根节点->右子树
 * postorder 后序遍历 左子树->右子树->根节点
 * 传入
 */
class Node
{
    public $value;
    public $left = null;
    public $right = null;
    private $outstack = [];
    private $output = [];


    //preorder 前序遍历 根节点->左子树->右子树
    public function preorder()
    {
        $stack = [];
        array_push($stack, $this);
        while (!empty($stack)) {
            $nownode = array_pop($stack);
            $this->output[] = $nownode->value;
            if ($nownode->right != null) {
                $stack[] = $nownode->right;
            }
            if ($nownode->left != null) {
                $stack[] = $nownode->left;
            }
        }
    }

    //inorder 中序遍历 左子树->根节点->右子树
    public function inorder()
    {
        $stack = [];
        $nownode = $this;
        while (!empty($stack) || $nownode != null) {
            while ($nownode != null) {
                array_push($stack, $nownode);
                $nownode = $nownode->left;
            }
            $nownode = array_pop($stack);
            $this->output[] = $nownode->value;
            $nownode = $nownode->right;
        }
    }

    //postorder 后序遍历 左子树->右子树->根节点
    public function postorder()
    {
        $stack = [];
        array_push($stack, $this);
        while (!empty($stack)) {
            $nownode = array_pop($stack);
            array_push($this->outstack, $nownode);
            if ($nownode->left != null) {
                array_push($stack, $nownode->left);
            }
            if ($nownode->right != null) {
                array_push($stack, $nownode->right);
            }
        }
        while (!empty($this->outstack)) {
            $nownode = array_pop($this->outstack);
            $this->output[] = $nownode->value;
        }

    }

    public function output()
    {
        echo join('', $this->output);
    }
}

$a = new Node();
$b = new Node();
$c = new Node();
$d = new Node();
$e = new Node();
$f = new Node();
$g = new Node();
$a->value = 'A';
$b->value = 'B';
$c->value = 'C';
$d->value = 'D';
$e->value = 'E';
$f->value = 'F';
$g->value = 'G';
$a->left = $b;
$a->right = $c;
$b->left = $d;
$b->right = $g;
$c->left = $e;
$c->right = $f;
$a->preorder();//A B D C E F
$a->output();//A B D C E F