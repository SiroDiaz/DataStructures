# DataStructures [![Build Status](https://travis-ci.org/SiroDiaz/DataStructures.svg?branch=master)](https://travis-ci.org/SiroDiaz/DataStructures)
Data structures for PHP >= 7.0.

## Install

Via Composer just copy and paste:
```sh
composer require siro-diaz/data-structures:"dev-master"
```
## Lists

The list data structures supported are the following:

*list type*: **class**

 - *Singly linked list*: **SimpleLinkedList**
 - *Circular singly linked list*: **CircularLinkedList**
 - *Circular doubly linked list*: **DoublyLinkedList**
 - *Stack*: **Stack**
 - *Queue*: **Queue**


### Singly linked list
#### Introduction
Singly linked list is the simplest linked list that can be created. It has a pointer
to the next node in the list and the last node points to null.
All lists except stacks and queues have the same methods because they implements the same
interface.
#### Methods
 - size()
 - empty()
 - get($index)
 - getAll()
 - delete($index)
 - clear()
 - pop()
 - insert($index, $data)
 - push($data)
 - unshift($data)
 - shift()
 - toArray()
#### Example
```php
use DataStructures\Lists\SimpleLinkedList;

$myList = new SimpleLinkedList();
$myList->push(20);
echo "Size of : ". $myList->size();
$myList->unshift(100);
echo "Item at the beginnig: ". $myList->get(0);
```
## Trees

## Hash tables
