# DataStructures [![Build Status](https://travis-ci.org/SiroDiaz/DataStructures.svg?branch=master)](https://travis-ci.org/SiroDiaz/DataStructures) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/SiroDiaz/DataStructures/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/SiroDiaz/DataStructures/?branch=master) 
Data structures for PHP >= 7.0. **STILL UNDER DEVELOPMENT, DON'T USE IT YET**: anyway
you can see the algorithms and data structures created at this moment.

## Index

[Install](https://github.com/SiroDiaz/DataStructures#install)<br>
**[API](https://github.com/SiroDiaz/DataStructures#api)**<br>
*[List implementations](https://github.com/SiroDiaz/DataStructures#lists)*<br>
- [Singly linked list](https://github.com/SiroDiaz/DataStructures#singly-linked-list)<br>
- [Singly circular linked list](https://github.com/SiroDiaz/DataStructures#circular-linked-list)<br>
- [Doubly circular linked list](https://github.com/SiroDiaz/DataStructures#doubly-circular-linked-list)<br>
- [Array list](https://github.com/SiroDiaz/DataStructures#array-list)<br>
- [Stack](https://github.com/SiroDiaz/DataStructures#stack)<br>
- [Queue](https://github.com/SiroDiaz/DataStructures#queue)<br>

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
 - *Array list*: **ArrayList**
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


#### Doubly circular linked list

##### Introduction
Doubly circular linked list is a doubly linked list that each node contained in the list
contains a pointer to the next and previous node. In the of the first node it is going to point 
to the last node. It uses some performance tricks for insert, get, and delete operations.

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
use DataStructures\Lists\DoublyLinkedList;

$myList = new DoublyLinkedList();
$myList->push(20);
$myList->push(10);
echo "Size of : ". $myList->size();
$myList->unshift(100);
echo "Item at position 1: ". $myList->get(1);
echo "Last item: ". $myList->getLast();
```

#### Array list

##### Introduction
Array list uses the built in arrays as lists. In PHP all uses hash tables and it give
array lists some performance advantages in operations like get that will be O(1). 
Array list auto increments their size internally, without the necessity of increment it
manually. It is translates in a very easy way to implement this type of list.

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
use DataStructures\Lists\ArrayList;

$myList = new ArrayList();
$myList->push(20);
$myList->push(10);
echo "Size of : ". $myList->size();
$myList->unshift(100);
echo "Item at position 1: ". $myList->get(1);
echo "Last item: ". $myList->getLast();
```


#### Stack

##### Introduction
Stack is a LIFO (Last In First Out) data structure that works like a stack (as its name
said). Last element that is inserted will be the first in going out. 
The implementation used in this library allow to especify a maximum size, in other words,
it can be a limited stack. When limited stack is been used is important check if it is full
before insert a new element.

##### Methods
 - size()
 - empty()
 - isFull()
 - peek()
 - pop()
 - push($data)

##### Example
```php
use DataStructures\Lists\Stack;

$myStack = new Stack(); // unlimited stack.
// new Stack(5) will contain a maximum of 5 elements.
$myStack->push(20);
$myStack->push(10);
echo "Size of : ". $myStack->size();
echo "Front element: ". $myStack->peek(1);
echo "Last element inserted and being removed: ". $myStack->pop();
```

### Trees

The tree data structures supported are the following:

*tree type*: **class**

 - *Trie tree*: **TrieTree**
 - *Binary search tree*: **BinarySearchTree**
 - *AVL tree*: **AVLTree**

#### Trie tree
##### Introduction
Singly linked list is the simplest linked list that can be created. It has a pointer
to the next node in the list and the last node points to null.
All lists except stacks and queues have the same methods because they implements the same
interface.
##### Methods
 - size()
 - empty()
 - wordCount()
 - withPrefix($prefix)
 - startsWith($prefix)
 - getWords()
 - clear()
 - delete($word)
 - contains($word)
 - add($word)
##### Example
```php
use DataStructures\Lists\SimpleLinkedList;

$myList = new SimpleLinkedList();
$myList->push(20);
echo "Size of : ". $myList->size();
$myList->unshift(100);
echo "Item at the beginnig: ". $myList->get(0);
```


### Hash tables
