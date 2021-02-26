<?php
namespace Glib\API;
namespace Gio\API;

/**
 * associations between keys and values so that given a key the value ca...
 */
class GHashTable {
}

/**
 * Creates a new GHashTable with a reference count of 1.
 * @param callback(mixed): int $hashFunc  * a function to create a hash value from a key
 * @param callback(mixed, mixed): bool $keyEqualFunc  * a function to check two keys for equality
 * @return GHashTable
 */
function g_hash_table_new (callback $hashFunc, callback $keyEqualFunc): GHashTable{ }
/**
 * Creates a new GHashTable like g_hash_table_new() with a reference cou...
 * @param callback(mixed): int $hashFunc  * a function to create a hash value from a key
 * @param callback(mixed, mixed): bool $keyEqualFunc  * a function to check two keys for equality
 * @param callback(object): void $keyDestroyFunc  * a function to free the memory allocated for the key used when removin...
 * @param callback(object): void $valueDestroyFunc  * a function to free the memory allocated for the value used when remov...
 * @return GHashTable
 */
function g_hash_table_new_full (callback $hashFunc, callback $keyEqualFunc, callback $keyDestroyFunc, callback $valueDestroyFunc): GHashTable{ }
/**
 * Inserts a new key and value into a GHashTable.
 * @param GHashTable $hashTable  * a GHashTable
 * @param object $key  * a key to insert
 * @param object $value  * the value to associate with the key
 * @return bool
 */
function g_hash_table_insert (GHashTable $hashTable, object $key, object $value): bool{ }
/**
 * Inserts a new key and value into a GHashTable similar to g_hash_table...
 * @param GHashTable $hashTable  * a GHashTable
 * @param object $key  * a key to insert
 * @param object $value  * the value to associate with the key
 * @return bool
 */
function g_hash_table_replace (GHashTable $hashTable, object $key, object $value): bool{ }
/**
 * This is a convenience function for using a GHashTable as a set.
 * @param GHashTable $hashTable  * a GHashTable
 * @param object $key  * a key to insert
 * @return bool
 */
function g_hash_table_add (GHashTable $hashTable, object $key): bool{ }
/**
 * Checks if key is in hash_table .
 * @param GHashTable $hashTable  * a GHashTable
 * @param mixed $key  * a key to check
 * @return bool
 */
function g_hash_table_contains (GHashTable $hashTable,  $key): bool{ }
/**
 * Returns the number of elements contained in the GHashTable.
 * @param GHashTable $hashTable  * a GHashTable
 * @return int
 */
function g_hash_table_size (GHashTable $hashTable): int{ }
/**
 * Looks up a key in a GHashTable.
 * @param GHashTable $hashTable  * a GHashTable
 * @param mixed $key  * the key to look up
 * @return object
 */
function g_hash_table_lookup (GHashTable $hashTable,  $key): object{ }
/**
 * Looks up a key in the GHashTable, returning the original key and the ...
 * @param GHashTable $hashTable  * a GHashTable
 * @param mixed $lookupKey  * the key to look up
 * @param object $origKey  * return location for the original key.
 * @param object $value  * return location for the value associated with the key.
 * @return bool
 */
function g_hash_table_lookup_extended (GHashTable $hashTable,  $lookupKey, object $origKey, object $value): bool{ }
/**
 * Calls the given function for each of the key/value pairs in the GHash...
 * @param GHashTable $hashTable  * a GHashTable
 * @param callback(object, object, object): void $func  * the function to call for each key/value pair
 * @param object $userData  * user data to pass to the function
 */
function g_hash_table_foreach (GHashTable $hashTable, callback $func, object $userData): void{ }
/**
 * Calls the given function for key/value pairs in the GHashTable until ...
 * @param GHashTable $hashTable  * a GHashTable
 * @param callback(object, object, object): bool $predicate  * function to test the key/value pairs for a certain property
 * @param object $userData  * user data to pass to the function
 * @return object
 */
function g_hash_table_find (GHashTable $hashTable, callback $predicate, object $userData): object{ }
/**
 * Removes a key and its associated value from a GHashTable.
 * @param GHashTable $hashTable  * a GHashTable
 * @param mixed $key  * the key to remove
 * @return bool
 */
function g_hash_table_remove (GHashTable $hashTable,  $key): bool{ }
/**
 * Removes a key and its associated value from a GHashTable without call...
 * @param GHashTable $hashTable  * a GHashTable
 * @param mixed $key  * the key to remove
 * @return bool
 */
function g_hash_table_steal (GHashTable $hashTable,  $key): bool{ }
/**
 * Calls the given function for each key/value pair in the GHashTable.
 * @param GHashTable $hashTable  * a GHashTable
 * @param callback(object, object, object): bool $func  * the function to call for each key/value pair
 * @param object $userData  * user data to pass to the function
 * @return int
 */
function g_hash_table_foreach_remove (GHashTable $hashTable, callback $func, object $userData): int{ }
/**
 * Calls the given function for each key/value pair in the GHashTable.
 * @param GHashTable $hashTable  * a GHashTable
 * @param callback(object, object, object): bool $func  * the function to call for each key/value pair
 * @param object $userData  * user data to pass to the function
 * @return int
 */
function g_hash_table_foreach_steal (GHashTable $hashTable, callback $func, object $userData): int{ }
/**
 * Removes all keys and their associated values from a GHashTable.
 * @param GHashTable $hashTable  * a GHashTable
 */
function g_hash_table_remove_all (GHashTable $hashTable): void{ }
/**
 * Removes all keys and their associated values from a GHashTable withou...
 * @param GHashTable $hashTable  * a GHashTable
 */
function g_hash_table_steal_all (GHashTable $hashTable): void{ }
/**
 * Retrieves every key inside hash_table .
 * @param GHashTable $hashTable  * a GHashTable
 * @return GList
 */
function g_hash_table_get_keys (GHashTable $hashTable): GList{ }
/**
 * Retrieves every value inside hash_table .
 * @param GHashTable $hashTable  * a GHashTable
 * @return GList
 */
function g_hash_table_get_values (GHashTable $hashTable): GList{ }
/**
 * Retrieves every key inside hash_table , as an array.
 * @param GHashTable $hashTable  * a GHashTable
 * @param int $length  * the length of the returned array.
 * @return object
 */
function g_hash_table_get_keys_as_array (GHashTable $hashTable, int $length): object{ }
/**
 * Destroys all keys and values in the GHashTable and decrements its ref...
 * @param GHashTable $hashTable  * a GHashTable
 */
function g_hash_table_destroy (GHashTable $hashTable): void{ }
/**
 * Atomically increments the reference count of hash_table by one.
 * @param GHashTable $hashTable  * a valid GHashTable
 * @return GHashTable
 */
function g_hash_table_ref (GHashTable $hashTable): GHashTable{ }
/**
 * Atomically decrements the reference count of hash_table by one.
 * @param GHashTable $hashTable  * a valid GHashTable
 */
function g_hash_table_unref (GHashTable $hashTable): void{ }
/**
 * Initializes a key/value pair iterator and associates it with hash_tab...
 * @param GHashTableIter $iter  * an uninitialized GHashTableIter
 * @param GHashTable $hashTable  * a GHashTable
 */
function g_hash_table_iter_init (GHashTableIter $iter, GHashTable $hashTable): void{ }
/**
 * Advances iter and retrieves the key and/or value that are now pointed...
 * @param GHashTableIter $iter  * an initialized GHashTableIter
 * @param object $key  * a location to store the key.
 * @param object $value  * a location to store the value.
 * @return bool
 */
function g_hash_table_iter_next (GHashTableIter $iter, object $key, object $value): bool{ }
/**
 * Returns the GHashTable associated with iter .
 * @param GHashTableIter $iter  * an initialized GHashTableIter
 * @return GHashTable
 */
function g_hash_table_iter_get_hash_table (GHashTableIter $iter): GHashTable{ }
/**
 * Replaces the value currently pointed to by the iterator from its asso...
 * @param GHashTableIter $iter  * an initialized GHashTableIter
 * @param object $value  * the value to replace with
 */
function g_hash_table_iter_replace (GHashTableIter $iter, object $value): void{ }
/**
 * Removes the key/value pair currently pointed to by the iterator from ...
 * @param GHashTableIter $iter  * an initialized GHashTableIter
 */
function g_hash_table_iter_remove (GHashTableIter $iter): void{ }
/**
 * Removes the key/value pair currently pointed to by the iterator from ...
 * @param GHashTableIter $iter  * an initialized GHashTableIter
 */
function g_hash_table_iter_steal (GHashTableIter $iter): void{ }
/**
 * Compares two gpointer arguments and returns TRUE if they are equal.
 * @param mixed $v1  * a key.
 * @param mixed $v2  * a key to compare with v1 .
 * @return bool
 */
function g_direct_equal ( $v1,  $v2): bool{ }
/**
 * Converts a gpointer to a hash value.
 * @param mixed $v  * a gpointer key.
 * @return int
 */
function g_direct_hash ( $v): int{ }
/**
 * Compares the two gint values being pointed to and returns TRUE if the...
 * @param mixed $v1  * a pointer to a gint key.
 * @param mixed $v2  * a pointer to a gint key to compare with v1 .
 * @return bool
 */
function g_int_equal ( $v1,  $v2): bool{ }
/**
 * Converts a pointer to a gint to a hash value.
 * @param mixed $v  * a pointer to a gint key.
 * @return int
 */
function g_int_hash ( $v): int{ }
/**
 * Compares the two gint64 values being pointed to and returns TRUE if t...
 * @param mixed $v1  * a pointer to a gint64 key.
 * @param mixed $v2  * a pointer to a gint64 key to compare with v1 .
 * @return bool
 */
function g_int64_equal ( $v1,  $v2): bool{ }
/**
 * Converts a pointer to a gint64 to a hash value.
 * @param mixed $v  * a pointer to a gint64 key.
 * @return int
 */
function g_int64_hash ( $v): int{ }
/**
 * Compares the two gdouble values being pointed to and returns TRUE if ...
 * @param mixed $v1  * a pointer to a gdouble key.
 * @param mixed $v2  * a pointer to a gdouble key to compare with v1 .
 * @return bool
 */
function g_double_equal ( $v1,  $v2): bool{ }
/**
 * Converts a pointer to a gdouble to a hash value.
 * @param mixed $v  * a pointer to a gdouble key.
 * @return int
 */
function g_double_hash ( $v): int{ }
/**
 * Compares two strings for byte-by-byte equality and returns TRUE if th...
 * @param mixed $v1  * a key.
 * @param mixed $v2  * a key to compare with v1 .
 * @return bool
 */
function g_str_equal ( $v1,  $v2): bool{ }
/**
 * Converts a string to a hash value.
 * @param mixed $v  * a string key.
 * @return int
 */
function g_str_hash ( $v): int{ }
