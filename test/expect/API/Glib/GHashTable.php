<?php
/**
 * Associations between keys and values so that given a key the value can be found quickly
 */
class GHashTable {
}
function GHashFunc ($key): int{ return 0;}
function GEqualFunc ($a, $b): bool{ return False;}

/**
 * Creates a new GHashTable.
 * @param callable $hashFunc With GHashFunc signature
 * @param callable $keyEqualFunc With GEqualFunc signature
 */
function g_hash_table_new (callback $hashFunc=Null, callback $keyEqualFunc=Null): GHashTable{ }
/**
 * Creates a new GHashTable with destroy callback
 */
function g_hash_table_new_full (callback $hashFunc, callback $keyEqualFunc, callback $keyDestroyFunc, callback $valueDestroyFunc): GHashTable{ }

/**
* Inserts a new key and value into a GHashTable.
* @param GHashTable $hashTable The object to convert
* @param Object $key The object to convert
* @param Object $value The object to convert
* @return bool The object to convert
*/
function g_hash_table_insert (GHashTable $hashTable, Object $key, Object $value): bool{ }

/**
* Inserts a new key and value into a GHashTable similar to g_hash_table...
* @param GHashTable $hashTable
* @param Object $key
* @param Object $value
* @return bool
*/
function g_hash_table_replace (GHashTable $hashTable, Object $key, Object $value): bool{ }
/**
 * This is a convenience function for using a GHashTable as a set.
 */
function g_hash_table_add (GHashTable $hashTable, Object $key): bool{ }
/**
 * Checks if key  is in hash_table .
 * @param GHashTable $hashTable The HashTable instance
 * @param int|string|object $key The key-value
 * @return bool True is exists else False
 */
function g_hash_table_contains (GHashTable $hashTable, $key): bool{ return False;}
/**
 * Returns the number of elements contained in the GHashTable.
 */
function g_hash_table_size (GHashTable $hashTable): int{ }
/**
 * Looks up a key in a GHashTable.
 */
function g_hash_table_lookup (GHashTable $hashTable, gconstpointer $key): Object{ }
/**
 * Looks up a key in the GHashTable, returning the original key and the ...
 */
function g_hash_table_lookup_extended (GHashTable $hashTable, gconstpointer $lookupKey, Object $origKey, Object $value): bool{ }
/**
* Calls the given function for each of the key/value pairs in the GHash...
*/
function g_hash_table_foreach (GHashTable $hashTable, callback $func, Object $userData): void{ }
/**
* Calls the given function for key/value pairs in the GHashTable until ...
*/
function g_hash_table_find (GHashTable $hashTable, callback $predicate, Object $userData): Object{ }
/**
* Removes a key and its associated value from a GHashTable.
*/
function g_hash_table_remove (GHashTable $hashTable, gconstpointer $key): bool{ }
/**
* Removes a key and its associated value from a GHashTable without call...
*/
function g_hash_table_steal (GHashTable $hashTable, gconstpointer $key): bool{ }
/**
* Calls the given function for each key/value pair in the GHashTable.
*/
function g_hash_table_foreach_remove (GHashTable $hashTable, callback $func, Object $userData): int{ }
/**
* Calls the given function for each key/value pair in the GHashTable.
*/
function g_hash_table_foreach_steal (GHashTable $hashTable, callback $func, Object $userData): int{ }
/**
* Removes all keys and their associated values from a GHashTable.
*/
function g_hash_table_remove_all (GHashTable $hashTable): void{ }
/**
* Removes all keys and their associated values from a GHashTable withou...
*/
function g_hash_table_steal_all (GHashTable $hashTable): void{ }
/**
* Retrieves every key inside hash_table .
*/
function g_hash_table_get_keys (GHashTable $hashTable): GList{ }
/**
* Retrieves every value inside hash_table .
*/
function g_hash_table_get_values (GHashTable $hashTable): GList{ }
/**
* Retrieves every key inside hash_table , as an array.
*/
function g_hash_table_get_keys_as_array (GHashTable $hashTable, int $length): Object{ }
/**
* Destroys all keys and values in the GHashTable and decrements its ref...
*/
function g_hash_table_destroy (GHashTable $hashTable): void{ }
/**
* Atomically increments the reference count of hash_table  by one.
*/
function g_hash_table_ref (GHashTable $hashTable): GHashTable{ }
/**
* Atomically decrements the reference count of hash_table  by one.
*/
function g_hash_table_unref (GHashTable $hashTable): void{ }
/**
* Initializes a key/value pair iterator and associates it with hash_tab...
*/
function g_hash_table_iter_init (GHashTableIter $iter, GHashTable $hashTable): void{ }
/**
* Advances iter  and retrieves the key and/or value that are now pointe...
*/
function g_hash_table_iter_next (GHashTableIter $iter, Object $key, Object $value): bool{ }
/**
* Returns the GHashTable associated with iter .
*/
function g_hash_table_iter_get_hash_table (GHashTableIter $iter): GHashTable{ }
/**
* Replaces the value currently pointed to by the iterator from its asso...
*/
function g_hash_table_iter_replace (GHashTableIter $iter, Object $value): void{ }
/**
* Removes the key/value pair currently pointed to by the iterator from ...
*/
function g_hash_table_iter_remove (GHashTableIter $iter): void{ }
/**
* Removes the key/value pair currently pointed to by the iterator from ...
*/
function g_hash_table_iter_steal (GHashTableIter $iter): void{ }
/**
* Compares two gpointer arguments and returns TRUE if they are equal.
*/
function g_direct_equal (gconstpointer $v1, gconstpointer $v2): bool{ }
/**
* Converts a gpointer to a hash value.
*/
function g_direct_hash (gconstpointer $v): int{ }
/**
* Compares the two gint values being pointed to and returns TRUE if the...
*/
function g_int_equal (gconstpointer $v1, gconstpointer $v2): bool{ }
/**
* Converts a pointer to a gint to a hash value.
*/
function g_int_hash (gconstpointer $v): int{ }
/**
* Compares the two gint64 values being pointed to and returns TRUE if t...
*/
function g_int64_equal (gconstpointer $v1, gconstpointer $v2): bool{ }
/**
* Converts a pointer to a gint64 to a hash value.
*/
function g_int64_hash (gconstpointer $v): int{ }
/**
* Compares the two gdouble values being pointed to and returns TRUE if ...
*/
function g_double_equal (gconstpointer $v1, gconstpointer $v2): bool{ }
/**
* Converts a pointer to a gdouble to a hash value.
*/
function g_double_hash (gconstpointer $v): int{ }
/**
* Compares two strings for byte-by-byte equality and returns TRUE if th...
*/
function g_str_equal (gconstpointer $v1, gconstpointer $v2): bool{ }
/**
* Converts a string to a hash value.
*/
function g_str_hash (gconstpointer $v): int{ }
