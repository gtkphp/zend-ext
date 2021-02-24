<?php

namespace G;

use \G\HashTableIter;
use \SplDoublyLinkedList;

/*
 * A convenience wrapper Gtkmm ?
namespace G;
class HashTable {
    private $hashTable;
    private $size;
    function __getter(string $name) {
        return g_hash_table_size($this->hashTable);
    }
}
*/


/*
use G\HashFunc;
use G\EqualFunc;
use G\DestroyNotify;
use phpDocumentor\Reflection\Types\Nullable;
*/

/**
 * Hash Tables
 * Associations between keys and values so that given a key the value can
 * be found quickly
 */
class HashTable {
    /**
     * Creates a new GHashTable with a reference count of 1.
     * Simulate a php array ?
     * G\HashTable $hash;
     * $hash['foo']='bar'; => $hash->replace('foo', 'bar')
     */
    public function __construct (callable $hashFunc,
                                 callable $keyEqualFunc,
                                 callable $keyDestroyFunc,
                                 callable $valueDestroyFunc) {
    }
    /**
     * Destroys all keys and values in the GHashTable and decrements its ref...
     */
    public function __destruct (){/*Internal*/}
    /**
     * Inserts a new key and value into a GHashTable.
     */
    public function insert (Object $key, Object $value): bool{/*Internal*/}
    /**
     * Inserts a new key and value into a GHashTable similar to g_hash_table...
     */
    public function replace (Object $key, Object $value): bool{/*Internal*/}
    /**
     * This is a convenience function for using a GHashTable as a set.
     */
    public function add (Object $key): bool{/*Internal*/}
    /**
     * Checks if key  is in hash_table .
     * string|int|Object
     */
    public function contains (mixed $key): bool{/*Internal*/}
    /**
     * Returns the number of elements contained in the GHashTable.
     */
    public function size (): int{/*Internal*/}
    /**
     * Looks up a key in a GHashTable.
     */
    public function lookup (gconstpointer $key): Object{/*Internal*/}
    /**
     * Looks up a key in the GHashTable, returning the original key and the ...
     */
    public function lookupExtended (gconstpointer $lookup_key, Object $orig_key, Object $value): bool{/*Internal*/}
    /**
     * Calls the given function for each of the key/value pairs in the GHash...
     */
    public function forEach (callback $func, Object $user_data): void{/*Internal*/}
    /**
     * Calls the given function for key/value pairs in the GHashTable until ...
     */
    public function find (callback $predicate, Object $user_data): Object{/*Internal*/}
    /**
     * Removes a key and its associated value from a GHashTable.
     */
    public function remove (gconstpointer $key): bool{/*Internal*/}
    /**
     * Removes a key and its associated value from a GHashTable without call...
     */
    public function steal (gconstpointer $key): bool{/*Internal*/}
    /**
     * Calls the given function for each key/value pair in the GHashTable.
     */
    public function foreachRemove (callback $func, Object $user_data): int{/*Internal*/}
    /**
     * Calls the given function for each key/value pair in the GHashTable.
     */
    public function foreachSteal (callback $func, Object $user_data): int{/*Internal*/}
    /**
     * Removes all keys and their associated values from a GHashTable.
     */
    public function removeAll (): void{/*Internal*/}
    /**
     * Removes all keys and their associated values from a GHashTable withou...
     */
    public function stealAll (): void{/*Internal*/}
    /**
     * Retrieves every key inside hash_table .
     */
    public function getKeys (): SplDoublyLinkedList{/*Internal*/}
    /**
     * Retrieves every value inside hash_table .
     */
    public function getValues (): SplDoublyLinkedList{/*Internal*/}
    /**
     * Retrieves every key inside hash_table , as an array.
     */
    public function getKeysAsArray (int $length): Object{/*Internal*/}
    /**
     * Atomically increments the reference count of hash_table  by one.
     */
    public function ref (): HashTable{/*Internal*/}
    /**
     * Atomically decrements the reference count of hash_table  by one.
     */
    public function unref (): void{/*Internal*/}
    /**
     * Initializes a key/value pair iterator and associates it with hash_tab...
     */
    public function iterInit (HashTableIter $iter, HashTable $hash_table): void{/*Internal*/}
    /**
     * Advances iter  and retrieves the key and/or value that are now pointe...
     */
    public function iterNext (HashTableIter $iter, Object $key, Object $value): bool{/*Internal*/}
    /**
     * Returns the GHashTable associated with iter .
     */
    public function iterGetHashTable (HashTableIter $iter): HashTable{/*Internal*/}
    /**
     * Replaces the value currently pointed to by the iterator from its asso...
     */
    public function iterReplace (HashTableIter $iter, Object $value): void{/*Internal*/}
    /**
     * Removes the key/value pair currently pointed to by the iterator from ...
     */
    public function iterRemove (HashTableIter $iter): void{/*Internal*/}
    /**
     * Removes the key/value pair currently pointed to by the iterator from ...
     */
    public function iterSteal (HashTableIter $iter): void{/*Internal*/}

}
