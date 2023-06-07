<?php 
function GLIB_CHECK_VERSION(int $major, int $minor, int $micro): bool {}
function G_GINT64_CONSTANT(int $val):int {}
function G_GUINT64_CONSTANT(int $val):int {}
function G_GOFFSET_CONSTANT(int $val):int {}
function G_IS_DIR_SEPARATOR(string $c):bool {}

//function MIN($a, $b) {}
//function MAX($a, $b) {}
//function ABS($a) {}
//function CLAMP($x, $low, $high) {}

//function G_APPROX_VALUE($a, $b, $epsilon) {}
//function G_SIZEOF_MEMBER($struct_type, $member) {}
//function G_STRUCT_MEMBER($member_type, $struct_p, $struct_offset) {}
//function G_STRUCT_MEMBER_P($struct_p, $struct_offset) {}
//function G_STRUCT_OFFSET($struct_type, $member) {}
//function G_ALIGNOF($type) {}

function G_N_ELEMENTS(array $arr):int {}
function GINT_TO_POINTER(int $i):int {}
function GPOINTER_TO_INT(int $p):int {}
function GUINT_TO_POINTER(int $u):int {}
function GPOINTER_TO_UINT(int $p):int {}
function GSIZE_TO_POINTER(int $s):int {}
function GPOINTER_TO_SIZE(int $p):int {}
function g_htonl(int $val):int {}
function g_htons(int $val):int {}
function g_ntohl(int $val):int {}
function g_ntohs(int $val):int {}

function GINT_FROM_BE(int $val):int {}
function GINT_FROM_LE(int $val):int {}
function GINT_TO_BE(int $val):int {}
function GINT_TO_LE(int $val):int {}
function GUINT_FROM_BE(int $val):int {}
function GUINT_FROM_LE(int $val):int {}
function GUINT_TO_BE(int $val):int {}
function GUINT_TO_LE(int $val):int {}
function GLONG_FROM_BE(int $val):int {}
function GLONG_FROM_LE(int $val):int {}
function GLONG_TO_BE(int $val):int {}
function GLONG_TO_LE(int $val):int {}
function GULONG_FROM_BE(int $val):int {}
function GULONG_FROM_LE(int $val):int {}
function GULONG_TO_BE(int $val):int {}
function GULONG_TO_LE(int $val):int {}
function GSIZE_FROM_BE(int $val):int {}
function GSIZE_FROM_LE(int $val):int {}
function GSIZE_TO_BE(int $val):int {}
function GSIZE_TO_LE(int $val):int {}
function GSSIZE_FROM_BE(int $val):int {}
function GSSIZE_FROM_LE(int $val):int {}
function GSSIZE_TO_BE(int $val):int {}
function GSSIZE_TO_LE(int $val):int {}
function GINT16_FROM_BE(int $val):int {}
function GINT16_FROM_LE(int $val):int {}
function GINT16_TO_BE(int $val):int {}
function GINT16_TO_LE(int $val):int {}
function GUINT16_FROM_BE(int $val):int {}
function GUINT16_FROM_LE(int $val):int {}
function GUINT16_TO_BE(int $val):int {}
function GUINT16_TO_LE(int $val):int {}
function GINT32_FROM_BE(int $val):int {}
function GINT32_FROM_LE(int $val):int {}
function GINT32_TO_BE(int $val):int {}
function GINT32_TO_LE(int $val):int {}
function GUINT32_FROM_BE(int $val):int {}
function GUINT32_FROM_LE(int $val):int {}
function GUINT32_TO_BE(int $val):int {}
function GUINT32_TO_LE(int $val):int {}
function GINT64_FROM_BE(int $val):int {}
function GINT64_FROM_LE(int $val):int {}
function GINT64_TO_BE(int $val):int {}
function GINT64_TO_LE(int $val):int {}
function GUINT64_FROM_BE(int $val):int {}
function GUINT64_FROM_LE(int $val):int {}
function GUINT64_TO_BE(int $val):int {}
function GUINT64_TO_LE(int $val):int {}
function GUINT16_SWAP_BE_PDP(int $val):int {}
function GUINT16_SWAP_LE_BE(int $val):int {}
function GUINT16_SWAP_LE_PDP(int $val):int {}
function GUINT32_SWAP_BE_PDP(int $val):int {}
function GUINT32_SWAP_LE_BE(int $val):int {}
function GUINT32_SWAP_LE_PDP(int $val):int {}
function GUINT64_SWAP_LE_BE(int $val):int {}

function g_uint_checked_add(int &$dest=null, int $a, int $b):bool {}
function g_uint_checked_mul(int &$dest=null, int $a, int $b):bool {}
function g_uint64_checked_add(int &$dest=null, int $a, int $b):bool {}
function g_uint64_checked_mul(int &$dest=null, int $a, int $b):bool {}
function g_size_checked_add(int &$dest=null, int $a, int $b):bool {}
function g_size_checked_mul(int &$dest=null, int $a, int $b):bool {}

//function g_auto($TypeName) {}
//function g_autoptr($TypeName) {}
//function g_autolist($TypeName) {}
//function g_autoslist($TypeName) {}
//function g_autoqueue($TypeName) {}
//function G_DEFINE_AUTOPTR_CLEANUP_FUNC($TypeName, $func) {}
//function G_DEFINE_AUTO_CLEANUP_CLEAR_FUNC($TypeName, $func) {}
//function G_DEFINE_AUTO_CLEANUP_FREE_FUNC($TypeName, $func, $none) {}
//function G_VA_COPY($ap1, $ap2) {}
//function G_STRINGIFY($macro_or_string) {}
//function G_PASTE($identifier1, $identifier2) {}
//function G_STATIC_ASSERT($expr) {}
//function G_STATIC_ASSERT_EXPR($expr) {}
function G_GNUC_CHECK_VERSION(int $major, int $minor):bool {}
//function G_GNUC_ALLOC_SIZE($x) {}
//function G_GNUC_ALLOC_SIZE2($x, $y) {}
//function G_GNUC_DEPRECATED_FOR($f) {}
//function G_GNUC_PRINTF($format_idx, $arg_idx) {}
//function G_GNUC_SCANF($format_idx, $arg_idx) {}
//function G_GNUC_STRFTIME($format_idx) {}
//function G_GNUC_FORMAT($arg_idx) {}
//function G_DEPRECATED_FOR($f) {}
//function G_UNAVAILABLE($maj, $min) {}
//function G_LIKELY($expr) {}
//function G_UNLIKELY($expr) {}

function g_main_new(bool $is_running):\GMainLoop {}
function g_main_destroy(\GMainLoop $loop) {}
function g_main_run(\GMainLoop $loop) {}
function g_main_quit(\GMainLoop $loop) {}
function g_main_is_running(\GMainLoop $loop):bool {}
function g_main_iteration(bool $may_block):bool {}
function g_main_pending(\GMainContext $context):bool {}
function g_main_set_poll_func(callable $func) {}
function G_LOCK_DEFINE(string $name) {}
function G_LOCK_DEFINE_STATIC(string $name) {}
function G_LOCK_EXTERN(string $name) {}
function G_LOCK(string $name) {}
function G_TRYLOCK(string $name) {}
function G_UNLOCK(string $name) {}
function G_PRIVATE_INIT(callable $notify):\GPrivate {}
function g_once(\GOnce $once, callable $func, $arg) {}

function G_SOURCE_FUNC($f) {}

function g_new(string $struct_type, int $n_structs):object {}
function g_new0(string $struct_type, int $n_structs):object {}
//function g_renew($struct_type, $mem, $n_structs) {}
function g_try_new(string $struct_type, int $n_structs):object {}
function g_try_new0(string $struct_type, int $n_structs):object {}
//function g_try_renew($struct_type, $mem, $n_structs) {}
function g_alloca(int $size):string {}
function g_alloca0(int $size):string {}
//function g_newa($struct_type, $n_structs) {}
//function g_newa0($struct_type, $n_structs) {}
//function g_memmove($dest, $src, $len) {}
//function g_slice_new($type) {}
//function g_slice_new0($type) {}
//function g_slice_dup($type, $mem) {}
//function g_slice_free($type, $mem) {}
//function g_slice_free_chain($type, $mem_chain, $next) {}
//function G_DEFINE_EXTENDED_ERROR($ErrorType, $error_type) {}
//function g_return_if_fail($expr) {}
//function g_return_val_if_fail($expr, $val) {}
//function g_return_if_reached($) {}
//function g_return_val_if_reached($val) {}
//function g_warn_if_fail($expr) {}
//function g_warn_if_reached($) {}
function G_BREAKPOINT() {}
function G_DEBUG_HERE() {}

function g_ascii_isalnum(string $c):bool {}
function g_ascii_isalpha(string $c):bool {}
function g_ascii_iscntrl(string $c):bool {}
function g_ascii_isdigit(string $c):bool {}
function g_ascii_isgraph(string $c):bool {}
function g_ascii_islower(string $c):bool {}
function g_ascii_isprint(string $c):bool {}
function g_ascii_ispunct(string $c):bool {}
function g_ascii_isspace(string $c):bool {}
function g_ascii_isupper(string $c):bool {}
function g_ascii_isxdigitstring ($c):bool {}

function g_strstrip(string &$string) {}
//function g_utf8_next_char($p) {}

//function _(string $String):string {}
function Q_(string $String):string {}
function C_(string $Context, string $String):string {}
function N_(string $String):string {}
function NC_(string $Context, string $String):string {}

function g_rand_boolean(\GRand $rand_):bool {}
function g_random_boolean():bool {}

function g_hook_append(\GHookList $hook_list, \GHook $hook) {}
function G_HOOK_FLAGS(\GHook $hook):int {}
function G_HOOK(\GHook $hook):\GHook {}
function G_HOOK_IS_VALID(\GHook $hook) {}
function G_HOOK_ACTIVE($hook):bool {}
function G_HOOK_IN_CALL(\GHook $hook):bool {}
function G_HOOK_IS_UNLINKED(\GHook $hook):bool {}

function g_bit_nth_lsf(int $mask, int $nth_bit):int {}
function g_bit_nth_msf(int $mask, int $nth_bit):int {}
function g_bit_storage(int $number):int {}

//function g_abort($) {}

function g_scanner_add_symbol(\GScanner $scanner, string $symbol, &$value) {}
function g_scanner_remove_symbol(\GScanner $scanner, string $symbol) {}

function g_scanner_foreach_symbol(\GScanner $scanner, callable $func, &$data) {}
function g_scanner_freeze_symbol_table(\GScanner $scanner) {}
function g_scanner_thaw_symbol_table(\GScanner $scanner) {}
/*
function g_test_initialized($) {}
function g_test_quick($) {}
function g_test_slow($) {}
function g_test_thorough($) {}
function g_test_perf($) {}
function g_test_verbose($) {}
function g_test_undefined($) {}
function g_test_quiet($) {}
function g_test_add($testpath, $Fixture, $tdata, $fsetup, $ftest, $fteardown) {}
function g_test_queue_unref($gobject) {}
function g_test_assert_expected_messages($) {}
function g_test_trap_assert_passed($) {}
function g_test_trap_assert_failed($) {}
function g_test_trap_assert_stdout($soutpattern) {}
function g_test_trap_assert_stdout_unmatched($soutpattern) {}
function g_test_trap_assert_stderr($serrpattern) {}
function g_test_trap_assert_stderr_unmatched($serrpattern) {}
function g_test_rand_bit($) {}
function g_assert($expr) {}
function g_assert_not_reached($) {}
function g_assert_cmpstr($s1, $cmp, $s2) {}
function g_assert_cmpstrv($strv1, $strv2) {}
function g_assert_cmpint($n1, $cmp, $n2) {}
function g_assert_cmpuint($n1, $cmp, $n2) {}
function g_assert_cmphex($n1, $cmp, $n2) {}
function g_assert_cmpfloat($n1, $cmp, $n2) {}
function g_assert_cmpfloat_with_epsilon($n1, $n2, $epsilon) {}
function g_assert_cmpmem($m1, $l1, $m2, $l2) {}
function g_assert_cmpvariant($v1, $v2) {}
function g_assert_no_error($err) {}
function g_assert_error($err, $dom, $c) {}
function g_assert_true($expr) {}
function g_assert_false($expr) {}
function g_assert_null($expr) {}
function g_assert_nonnull($expr) {}
function g_assert_no_errno($expr) {}
*/
/*
function G_WIN32_DLLMAIN_FOR_DLL_NAME($static, $dll_name) {}
function G_WIN32_HAVE_WIDECHAR_API($) {}
function G_WIN32_IS_NT_BASED($) {}
*/

function g_list_previous(\GList $list):?\GList {}
function g_list_next(\GList $list):? \GList {}
function g_slist_next(\GSList $slist):?\GSList {}
function g_hash_table_freeze(\GHashTable $hash_table) {}
function g_hash_table_thaw(\GHashTable $hash_table) {}
function g_array_append_val(\GArray $a, $v):\GArray  {}
function g_array_prepend_val(\GArray $a, $v):\GArray {}
function g_array_insert_val(\GArray $a, int $i, $v):\GArray {}
////////function g_array_index(\GArray $a, string|array $t, int $i):mixed {}
function g_array_index(\GArray $a, array $t, int $i):mixed {}
function g_ptr_array_index(\GPtrArray $array, int $index_):mixed {}

function g_node_append($parent, $node): void{}
function g_node_insert_data($parent, $position, $data): void{}
function g_node_insert_data_after($parent, $sibling, $data): void{}
function g_node_insert_data_before($parent, $sibling, $data): void{}
function g_node_append_data($parent, $data): void{}
function g_node_prepend_data($parent, $data): void{}
function g_node_first_child($node): void{}
function g_node_next_sibling($node): void{}
function g_node_prev_sibling(\GNode $node): \GNode{}
function G_NODE_IS_LEAF($node): void{}
function G_NODE_IS_ROOT($node): void{}

function G_DEFINE_QUARK(string $QN, string $q_n):\GQuark {}
/*
function g_datalist_id_set_data($dl, $q, $d) {}
function g_datalist_id_remove_data($dl, $q) {}
function g_datalist_set_data($dl, $k, $d) {}
function g_datalist_set_data_full($dl, $k, $d, $f) {}
function g_datalist_remove_data($dl, $k) {}
function g_datalist_remove_no_notify($dl, $k) {}
function g_dataset_id_set_data($l, $k, $d) {}
function g_dataset_id_remove_data($l, $k) {}
function g_dataset_set_data($l, $k, $d) {}
function g_dataset_set_data_full($l, $k, $d, $f) {}
function g_dataset_get_data($l, $k) {}
function g_dataset_remove_data($l, $k) {}
function g_dataset_remove_no_notify($l, $k) {}
function G_VARIANT_TYPE($type_string) {}
function G_VARIANT_BUILDER_INIT($variant_type) {}
function G_VARIANT_DICT_INIT($asv) {}
*/
//function g_rc_box_new($type) {}
//function g_rc_box_new0($type) {}
//function g_atomic_rc_box_new($type) {}
//function g_atomic_rc_box_new0($type) {}

function g_thread_supported():bool {}
function g_static_mutex_lock(\GMutex $mutex) {}
function g_static_mutex_trylock(\GMutex $mutex) {}
function g_static_mutex_unlock(\GMutex $mutex) {}






function g_bookmark_file_load_from_data (\GBookmarkFile $bookmark, string $data, int $length, GError &$error): bool{}


return get_defined_functions(true);
