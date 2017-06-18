# DataStructures [![Build Status](https://travis-ci.org/SiroDiaz/DataStructures.svg?branch=master)](https://travis-ci.org/SiroDiaz/DataStructures) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/SiroDiaz/DataStructures/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/SiroDiaz/DataStructures/?branch=master) 
Data structures for PHP >= 7.0.

## Index

[Install](https://github.com/SiroDiaz/DataStructures#install)
**[API](https://github.com/SiroDiaz/DataStructures#api)**
    - [List implementations](https://github.com/SiroDiaz/DataStructures#lists)
        - [Singly linked list](https://github.com/SiroDiaz/DataStructures#singly-linked-list)
        - [Singly circular linked list](https://github.com/SiroDiaz/DataStructures#circular-linked-list)

## Install

Via Composer just copy and paste:
```sh
composer require siro-diaz/data-structures:"dev-master"
```
## API
### Lists

The list data structures supported are the following:

*list type*: **class**

 - *Singly linked list*: **SimpleLinkedList**
 - *Circular singly linked list*: **CircularLinkedList**
 - *Circular doubly linked list*: **DoublyLinkedList**
 - *Stack*: **Stack**
 - *Queue*: **Queue**


#### Singly linked list
##### Introduction
Singly linked list is the simplest linked list that can be created. It has a pointer
to the next node in the list and the last node points to null.
All lists except stacks and queues have the same methods because they implements the same
interface.
##### Methods
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
##### Example
```php
use DataStructures\Lists\SimpleLinkedList;

$myList = new SimpleLinkedList();
$myList->push(20);
echo "Size of : ". $myList->size();
$myList->unshift(100);
echo "Item at the beginnig: ". $myList->get(0);
```


#### Circular linked list

##### Introduction
Circular linked list is a singly linked list that has a pointer to the last and first node. 
All lists except stacks and queues have the same methods because they implements the same
interface.

##### Methods
 - size()
 - empty()
 - get($index)
 - getAll()
 - getLast()
 - delete($index)
 - clear()
 - pop()
 - insert($index, $data)
 - push($data)
 - unshift($data)
 - shift()
 - toArray()
##### Example
```php
use DataStructures\Lists\CircularLinkedList;

$myList = new CircularLinkedList();
$myList->push(20);
$myList->push(10);
echo "Size of : ". $myList->size();
$myList->unshift(100);
echo "Item at the beginnig: ". $myList->get(0);
echo "Last item: ". $myList->getLast();
```

### Trees

### Hash tables
