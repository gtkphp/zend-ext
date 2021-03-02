<?php
/**
 * linked lists that can be iterated over in both directions
 */
class GList {
}

/**
 * Adds a new element on to the end of the list.
 * @param GList $list a pointer to a GList
 * @param mixed $data the data for the new element
 * @return GList
 */
function g_list_append (GList $list, $data): GList{ }
/**
 * Prepends a new element on to the start of the list.
 * @param GList $list a pointer to a GList, this must point to the top of the list
 * @param mixed $data the data for the new element
 * @return GList
 */
function g_list_prepend (GList $list, $data): GList{ }
/**
 * Inserts a new element into the list at the given position.
 * @param GList $list a pointer to a GList, this must point to the top of the list
 * @param mixed $data the data for the new element
 * @param int $position the position to insert the element.
 * @return GList
 */
function g_list_insert (GList $list, $data, int $position): GList{ }
/**
 * Inserts a new element into the list before the given position.
 * @param GList $list a pointer to a GList, this must point to the top of the list
 * @param GList $sibling the list element before which the new element is inserted or NULL to ...
 * @param mixed $data the data for the new element
 * @return GList
 */
function g_list_insert_before (GList $list, GList $sibling, $data): GList{ }
/**
 * Inserts a new element into the list, using the given comparison funct...
 * @param GList $list a pointer to a GList, this must point to the top of the already sorte...
 * @param mixed $data the data for the new element
 * @param callback(mixed, mixed): int $func the function to compare elements in the list.
 * @return GList
 */
function g_list_insert_sorted (GList $list, $data, callback $func): GList{ }
/**
 * Removes an element from a GList.
 * @param GList $list a GList, this must point to the top of the list
 * @param mixed $data the data of the element to remove
 * @return GList
 */
function g_list_remove (GList $list, $data): GList{ }
/**
 * Removes an element from a GList, without freeing the element.
 * @param GList $list a GList, this must point to the top of the list
 * @param GList $llink an element in the GList
 * @return GList
 */
function g_list_remove_link (GList $list, GList $llink): GList{ }
/**
 * Removes the node link_ from the list and frees it.
 * @param GList $list a GList, this must point to the top of the list
 * @param GList $link_ node to delete from list
 * @return GList
 */
function g_list_delete_link (GList $list, GList $link_): GList{ }
/**
 * Removes all list nodes with data equal to data .
 * @param GList $list a GList, this must point to the top of the list
 * @param mixed $data data to remove
 * @return GList
 */
function g_list_remove_all (GList $list, $data): GList{ }
/**
 * Frees all of the memory used by a GList.
 * @param GList $list a GList
 */
function g_list_free (GList $list): void{ }
/**
 * Convenience method, which frees all the memory used by a GList, and c...
 * @param GList $list a pointer to a GList
 * @param callback(mixed): void $freeFunc the function to be called to free each element's data
 */
function g_list_free_full (GList $list, callback $freeFunc): void{ }
/**
 * Allocates space for one GList element.
 * @return GList
 */
function g_list_alloc (): GList{ }
/**
 * Frees one GList element, but does not update links from the next and ...
 * @param GList $list a GList element
 */
function g_list_free_1 (GList $list): void{ }
/**
 * Gets the number of elements in a GList.
 * @param GList $list a GList, this must point to the top of the list
 * @return int
 */
function g_list_length (GList $list): int{ }
/**
 * Copies a GList.
 * @param GList $list a GList, this must point to the top of the list
 * @return GList
 */
function g_list_copy (GList $list): GList{ }
/**
 * Makes a full (deep) copy of a GList.
 * @param GList $list a GList, this must point to the top of the list
 * @param callback(mixed, mixed): mixed $func a copy function used to copy every element in the list
 * @param mixed $userData user data passed to the copy function func , or NULL
 * @return GList
 */
function g_list_copy_deep (GList $list, callback $func, $userData): GList{ }
/**
 * Reverses a GList.
 * @param GList $list a GList, this must point to the top of the list
 * @return GList
 */
function g_list_reverse (GList $list): GList{ }
/**
 * Sorts a GList using the given comparison function.
 * @param GList $list a GList, this must point to the top of the list
 * @param callback(mixed, mixed): int $compareFunc the comparison function used to sort the GList.
 * @return GList
 */
function g_list_sort (GList $list, callback $compareFunc): GList{ }
/**
 * Inserts a new element into the list, using the given comparison funct...
 * @param GList $list a pointer to a GList, this must point to the top of the already sorte...
 * @param mixed $data the data for the new element
 * @param callback(mixed, mixed, mixed): int $func the function to compare elements in the list.
 * @param mixed $userData user data to pass to comparison function
 * @return GList
 */
function g_list_insert_sorted_with_data (GList $list, $data, callback $func, $userData): GList{ }
/**
 * Like g_list_sort(), but the comparison function accepts a user data a...
 * @param GList $list a GList, this must point to the top of the list
 * @param callback(mixed, mixed, mixed): int $compareFunc  * comparison function
 * @param mixed $userData user data to pass to comparison function
 * @return GList
 */
function g_list_sort_with_data (GList $list, callback $compareFunc, $userData): GList{ }
/**
 * Adds the second GList onto the end of the first GList.
 * @param GList $list1 a GList, this must point to the top of the list
 * @param GList $list2 the GList to add to the end of the first GList, this must point to th...
 * @return GList
 */
function g_list_concat (GList $list1, GList $list2): GList{ }
/**
 * Calls a function for each element of a GList.
 * @param GList $list a GList, this must point to the top of the list
 * @param callback(mixed, mixed): void $func the function to call with each element's data
 * @param mixed $userData user data to pass to the function
 */
function g_list_foreach (GList $list, callback $func, $userData): void{ }
/**
 * Gets the first element in a GList.
 * @param GList $list any GList element
 * @return GList
 */
function g_list_first (GList $list): GList{ }
/**
 * Gets the last element in a GList.
 * @param GList $list any GList element
 * @return GList
 */
function g_list_last (GList $list): GList{ }
/**
 * Gets the element at the given position in a GList.
 * @param GList $list a GList, this must point to the top of the list
 * @param int $n the position of the element, counting from 0
 * @return GList
 */
function g_list_nth (GList $list, int $n): GList{ }
/**
 * Gets the data of the element at the given position.
 * @param GList $list a GList, this must point to the top of the list
 * @param int $n the position of the element
 * @return mixed
 */
function g_list_nth_data (GList $list, int $n): mixed{ }
/**
 * Gets the element n places before list .
 * @param GList $list a GList
 * @param int $n the position of the element, counting from 0
 * @return GList
 */
function g_list_nth_prev (GList $list, int $n): GList{ }
/**
 * Finds the element in a GList which contains the given data.
 * @param GList $list a GList, this must point to the top of the list
 * @param mixed $data the element data to find
 * @return GList
 */
function g_list_find (GList $list, $data): GList{ }
/**
 * Finds an element in a GList, using a supplied function to find the de...
 * @param GList $list a GList, this must point to the top of the list
 * @param mixed $data user data passed to the function
 * @param callback(mixed, mixed):int $func the function to call for each element.
 * @return GList
 */
function g_list_find_custom (GList $list, $data, callback $func): GList{ }
/**
 * Gets the position of the given element in the GList (starting from 0).
 * @param GList $list a GList, this must point to the top of the list
 * @param GList $llink an element in the GList
 * @return int
 */
function g_list_position (GList $list, GList $llink): int{ }
/**
 * Gets the position of the element containing the given data (starting ...
 * @param GList $list  a GList, this must point to the top of the list
 * @param mixed $data  the data to find
 * @return int
 */
function g_list_index (GList $list, $data): int{ }

// macros :
//function g_list_previous (GList $list){ }
//function g_list_next (GList $list){ }
