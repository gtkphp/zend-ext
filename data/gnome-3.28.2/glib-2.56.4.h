#define G_SEARCHPATH_SEPARATOR_S ":"
#define G_SEARCHPATH_SEPARATOR ':'
#define G_DIR_SEPARATOR_S "/"
#define G_DIR_SEPARATOR '/'
#define GLIB_SYSDEF_MSG_DONTROUTE 4
#define GLIB_SYSDEF_MSG_PEEK 2
#define GLIB_SYSDEF_MSG_OOB 1
#define GLIB_SYSDEF_AF_INET6 10
#define GLIB_SYSDEF_AF_INET 2
#define GLIB_SYSDEF_AF_UNIX 1
#define G_PID_FORMAT "i"
#define G_MODULE_SUFFIX "so"
#define GLIB_SYSDEF_POLLNVAL =32
#define GLIB_SYSDEF_POLLERR =8
#define GLIB_SYSDEF_POLLHUP =16
#define GLIB_SYSDEF_POLLPRI =2
#define GLIB_SYSDEF_POLLOUT =4
#define GLIB_SYSDEF_POLLIN =1
#define G_BYTE_ORDER G_LITTLE_ENDIAN
#define GSSIZE_TO_BE(val)	((gssize) GINT64_TO_BE (val))
#define GSIZE_TO_BE(val)	((gsize) GUINT64_TO_BE (val))
#define GSSIZE_TO_LE(val)	((gssize) GINT64_TO_LE (val))
#define GSIZE_TO_LE(val)	((gsize) GUINT64_TO_LE (val))
#define GUINT_TO_BE(val)	((guint) GUINT32_TO_BE (val))
#define GINT_TO_BE(val)		((gint) GINT32_TO_BE (val))
#define GUINT_TO_LE(val)	((guint) GUINT32_TO_LE (val))
#define GINT_TO_LE(val)		((gint) GINT32_TO_LE (val))
#define GULONG_TO_BE(val)	((gulong) GUINT64_TO_BE (val))
#define GLONG_TO_BE(val)	((glong) GINT64_TO_BE (val))
#define GULONG_TO_LE(val)	((gulong) GUINT64_TO_LE (val))
#define GLONG_TO_LE(val)	((glong) GINT64_TO_LE (val))
#define GUINT64_TO_BE(val)	(GUINT64_SWAP_LE_BE (val))
#define GINT64_TO_BE(val)	((gint64) GUINT64_SWAP_LE_BE (val))
#define GUINT64_TO_LE(val)	((guint64) (val))
#define GINT64_TO_LE(val)	((gint64) (val))
#define GUINT32_TO_BE(val)	(GUINT32_SWAP_LE_BE (val))
#define GINT32_TO_BE(val)	((gint32) GUINT32_SWAP_LE_BE (val))
#define GUINT32_TO_LE(val)	((guint32) (val))
#define GINT32_TO_LE(val)	((gint32) (val))
#define GUINT16_TO_BE(val)	(GUINT16_SWAP_LE_BE (val))
#define GINT16_TO_BE(val)	((gint16) GUINT16_SWAP_LE_BE (val))
#define GUINT16_TO_LE(val)	((guint16) (val))
#define GINT16_TO_LE(val)	((gint16) (val))
#define G_ATOMIC_LOCK_FREE
#define G_THREADS_IMPL_POSIX
#define G_THREADS_ENABLED
#define G_GNUC_INTERNAL __attribute__((visibility("hidden")))
#define G_HAVE_GNUC_VISIBILITY 1
#define G_HAVE_GROWING_STACK 0
#define G_HAVE_GNUC_VARARGS 1
# define G_HAVE_ISO_VARARGS 1
#define G_VA_COPY_AS_ARRAY 1
#define G_VA_COPY	va_copy
#define G_OS_UNIX
#define GLIB_MICRO_VERSION 4
#define GLIB_MINOR_VERSION 56
#define GLIB_MAJOR_VERSION 2
#define g_memmove(dest,src,len) G_STMT_START { memmove ((dest), (src), (len)); } G_STMT_END
#define g_ATEXIT(proc)	(atexit (proc))
#define G_GUINTPTR_FORMAT       "lu"
#define G_GINTPTR_FORMAT        "li"
#define G_GINTPTR_MODIFIER      "l"
#define GUINT_TO_POINTER(u)	((gpointer) (gulong) (u))
#define GINT_TO_POINTER(i)	((gpointer) (glong) (i))
#define GPOINTER_TO_UINT(p)	((guint) (gulong) (p))
#define GPOINTER_TO_INT(p)	((gint)  (glong) (p))
#define G_POLLFD_FORMAT "%d"
#define G_GOFFSET_CONSTANT(val) G_GINT64_CONSTANT(val)
#define G_GOFFSET_FORMAT        G_GINT64_FORMAT
#define G_GOFFSET_MODIFIER      G_GINT64_MODIFIER
#define G_MAXOFFSET	G_MAXINT64
#define G_MINOFFSET	G_MININT64
#define G_MAXSSIZE	G_MAXLONG
#define G_MINSSIZE	G_MINLONG
#define G_MAXSIZE	G_MAXULONG
#define G_GSSIZE_FORMAT "li"
#define G_GSIZE_FORMAT "lu"
#define G_GSSIZE_MODIFIER "l"
#define G_GSIZE_MODIFIER "l"
#define GLIB_SIZEOF_SSIZE_T 8
#define GLIB_SIZEOF_SIZE_T 8
#define GLIB_SIZEOF_LONG   8
#define GLIB_SIZEOF_VOID_P 8
#define G_GUINT64_FORMAT "lu"
#define G_GINT64_FORMAT "li"
#define G_GINT64_MODIFIER "l"
#define G_GUINT64_CONSTANT(val)	(val##UL)
#define G_GINT64_CONSTANT(val)	(val##L)
#define G_HAVE_GINT64 1          /* deprecated, always true */
#define G_GUINT32_FORMAT "u"
#define G_GINT32_FORMAT "i"
#define G_GINT32_MODIFIER ""
#define G_GUINT16_FORMAT "hu"
#define G_GINT16_FORMAT "hi"
#define G_GINT16_MODIFIER "h"
#define G_MAXULONG	ULONG_MAX
#define G_MAXLONG	LONG_MAX
#define G_MINLONG	LONG_MIN
#define G_MAXUINT	UINT_MAX
#define G_MAXINT	INT_MAX
#define G_MININT	INT_MIN
#define G_MAXUSHORT	USHRT_MAX
#define G_MAXSHORT	SHRT_MAX
#define G_MINSHORT	SHRT_MIN
#define G_MAXDOUBLE	DBL_MAX
#define G_MINDOUBLE	DBL_MIN
#define G_MAXFLOAT	FLT_MAX
#define G_MINFLOAT	FLT_MIN
#define GLIB_USING_SYSTEM_PRINTF
#define GLIB_HAVE_ALLOCA_H
#  define	G_MODULE_EXPORT		__declspec(dllexport)
#define	G_MODULE_IMPORT		extern
#define g_thread_supported()     (1)
#define G_STATIC_PRIVATE_INIT { 0 }
#define G_STATIC_RW_LOCK_INIT { G_STATIC_MUTEX_INIT, NULL, NULL, 0, FALSE, 0, 0 }
#define G_STATIC_REC_MUTEX_INIT { G_STATIC_MUTEX_INIT }
#define g_static_mutex_unlock(mutex) \
    g_mutex_unlock (g_static_mutex_get_mutex (mutex))
#define g_static_mutex_trylock(mutex) \
    g_mutex_trylock (g_static_mutex_get_mutex (mutex))
#define g_static_mutex_lock(mutex) \
    g_mutex_lock (g_static_mutex_get_mutex (mutex))
#define G_STATIC_MUTEX_INIT { NULL }
#define g_static_mutex_get_mutex g_static_mutex_get_mutex_impl
#define g_main_set_poll_func(func)  g_main_context_set_poll_func (NULL, func)
#define g_main_pending()            g_main_context_pending (NULL)
#define g_main_iteration(may_block) g_main_context_iteration (NULL, may_block)
#define g_main_is_running(loop) g_main_loop_is_running(loop)
#define g_main_destroy(loop)    g_main_loop_unref(loop)
#define g_main_quit(loop)       g_main_loop_quit(loop)
#define         g_main_run(loop)        g_main_loop_run(loop)
#define         g_main_new(is_running)  g_main_loop_new (NULL, is_running)
#define G_WIN32_HAVE_WIDECHAR_API() TRUE
#define G_WIN32_IS_NT_BASED() TRUE
#define MAXPATHLEN 1024
# define GLIB_AVAILABLE_IN_2_56                 GLIB_UNAVAILABLE(2, 56)
# define GLIB_DEPRECATED_IN_2_56_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_56                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_54                 GLIB_UNAVAILABLE(2, 54)
# define GLIB_DEPRECATED_IN_2_54_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_54                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_52                 GLIB_UNAVAILABLE(2, 52)
# define GLIB_DEPRECATED_IN_2_52_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_52                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_50                 GLIB_UNAVAILABLE(2, 50)
# define GLIB_DEPRECATED_IN_2_50_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_50                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_48                 GLIB_UNAVAILABLE(2, 48)
# define GLIB_DEPRECATED_IN_2_48_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_48                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_46                 GLIB_UNAVAILABLE(2, 46)
# define GLIB_DEPRECATED_IN_2_46_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_46                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_44                 GLIB_UNAVAILABLE(2, 44)
# define GLIB_DEPRECATED_IN_2_44_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_44                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_42                 GLIB_UNAVAILABLE(2, 42)
# define GLIB_DEPRECATED_IN_2_42_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_42                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_40                 GLIB_UNAVAILABLE(2, 40)
# define GLIB_DEPRECATED_IN_2_40_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_40                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_38                 GLIB_UNAVAILABLE(2, 38)
# define GLIB_DEPRECATED_IN_2_38_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_38                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_36                 GLIB_UNAVAILABLE(2, 36)
# define GLIB_DEPRECATED_IN_2_36_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_36                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_34                 GLIB_UNAVAILABLE(2, 34)
# define GLIB_DEPRECATED_IN_2_34_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_34                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_32                 GLIB_UNAVAILABLE(2, 32)
# define GLIB_DEPRECATED_IN_2_32_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_32                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_30                 GLIB_UNAVAILABLE(2, 30)
# define GLIB_DEPRECATED_IN_2_30_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_30                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_28                 GLIB_UNAVAILABLE(2, 28)
# define GLIB_DEPRECATED_IN_2_28_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_28                GLIB_DEPRECATED
# define GLIB_AVAILABLE_IN_2_26                 GLIB_UNAVAILABLE(2, 26)
# define GLIB_DEPRECATED_IN_2_26_FOR(f)         GLIB_DEPRECATED_FOR(f)
# define GLIB_DEPRECATED_IN_2_26                GLIB_DEPRECATED
#define GLIB_AVAILABLE_IN_ALL                   _GLIB_EXTERN
# define GLIB_VERSION_MAX_ALLOWED      (GLIB_VERSION_CUR_STABLE)
# define GLIB_VERSION_MIN_REQUIRED      (GLIB_VERSION_CUR_STABLE)
#define GLIB_VERSION_PREV_STABLE        (G_ENCODE_VERSION (GLIB_MAJOR_VERSION, GLIB_MINOR_VERSION - 1))
#define GLIB_VERSION_CUR_STABLE         (G_ENCODE_VERSION (GLIB_MAJOR_VERSION, GLIB_MINOR_VERSION + 1))
#define GLIB_VERSION_2_56       (G_ENCODE_VERSION (2, 56))
#define GLIB_VERSION_2_54       (G_ENCODE_VERSION (2, 54))
#define GLIB_VERSION_2_52       (G_ENCODE_VERSION (2, 52))
#define GLIB_VERSION_2_50       (G_ENCODE_VERSION (2, 50))
#define GLIB_VERSION_2_48       (G_ENCODE_VERSION (2, 48))
#define GLIB_VERSION_2_46       (G_ENCODE_VERSION (2, 46))
#define GLIB_VERSION_2_44       (G_ENCODE_VERSION (2, 44))
#define GLIB_VERSION_2_42       (G_ENCODE_VERSION (2, 42))
#define GLIB_VERSION_2_40       (G_ENCODE_VERSION (2, 40))
#define GLIB_VERSION_2_38       (G_ENCODE_VERSION (2, 38))
#define GLIB_VERSION_2_36       (G_ENCODE_VERSION (2, 36))
#define GLIB_VERSION_2_34       (G_ENCODE_VERSION (2, 34))
#define GLIB_VERSION_2_32       (G_ENCODE_VERSION (2, 32))
#define GLIB_VERSION_2_30       (G_ENCODE_VERSION (2, 30))
#define GLIB_VERSION_2_28       (G_ENCODE_VERSION (2, 28))
#define GLIB_VERSION_2_26       (G_ENCODE_VERSION (2, 26))
#define G_ENCODE_VERSION(major,minor)   ((major) << 16 | (minor) << 8)
#define GLIB_CHECK_VERSION(major,minor,micro)    \
    (GLIB_MAJOR_VERSION > (major) || \
     (GLIB_MAJOR_VERSION == (major) && GLIB_MINOR_VERSION > (minor)) || \
     (GLIB_MAJOR_VERSION == (major) && GLIB_MINOR_VERSION == (minor) && \
      GLIB_MICRO_VERSION >= (micro)))
# define G_VARIANT_TYPE(type_string)            (g_variant_type_checked_ ((type_string)))
#define G_VARIANT_TYPE_VARDICT              ((const GVariantType *) "a{sv}")
#define G_VARIANT_TYPE_BYTESTRING_ARRAY     ((const GVariantType *) "aay")
#define G_VARIANT_TYPE_BYTESTRING           ((const GVariantType *) "ay")
#define G_VARIANT_TYPE_OBJECT_PATH_ARRAY    ((const GVariantType *) "ao")
#define G_VARIANT_TYPE_STRING_ARRAY         ((const GVariantType *) "as")
#define G_VARIANT_TYPE_DICTIONARY           ((const GVariantType *) "a{?*}")
#define G_VARIANT_TYPE_DICT_ENTRY           ((const GVariantType *) "{?*}")
#define G_VARIANT_TYPE_TUPLE                ((const GVariantType *) "r")
#define G_VARIANT_TYPE_ARRAY                ((const GVariantType *) "a*")
#define G_VARIANT_TYPE_MAYBE                ((const GVariantType *) "m*")
#define G_VARIANT_TYPE_BASIC                ((const GVariantType *) "?")
#define G_VARIANT_TYPE_ANY                  ((const GVariantType *) "*")
#define G_VARIANT_TYPE_UNIT                 ((const GVariantType *) "()")
#define G_VARIANT_TYPE_HANDLE               ((const GVariantType *) "h")
#define G_VARIANT_TYPE_VARIANT              ((const GVariantType *) "v")
#define G_VARIANT_TYPE_SIGNATURE            ((const GVariantType *) "g")
#define G_VARIANT_TYPE_OBJECT_PATH          ((const GVariantType *) "o")
#define G_VARIANT_TYPE_STRING               ((const GVariantType *) "s")
#define G_VARIANT_TYPE_DOUBLE               ((const GVariantType *) "d")
#define G_VARIANT_TYPE_UINT64               ((const GVariantType *) "t")
#define G_VARIANT_TYPE_INT64                ((const GVariantType *) "x")
#define G_VARIANT_TYPE_UINT32               ((const GVariantType *) "u")
#define G_VARIANT_TYPE_INT32                ((const GVariantType *) "i")
#define G_VARIANT_TYPE_UINT16               ((const GVariantType *) "q")
#define G_VARIANT_TYPE_INT16                ((const GVariantType *) "n")
#define G_VARIANT_TYPE_BYTE                 ((const GVariantType *) "y")
#define G_VARIANT_TYPE_BOOLEAN              ((const GVariantType *) "b")
#define G_VARIANT_DICT_INIT(asv) { { { asv, 3488698669u, { 0, } } } }
#define G_VARIANT_BUILDER_INIT(variant_type) { { { 2942751021u, variant_type, { 0, } } } }
#define G_VARIANT_PARSE_ERROR (g_variant_parse_error_quark ())
# define G_WIN32_DLLMAIN_FOR_DLL_NAME(static, dll_name)
#  define g_abort() abort ()
#define g_bit_storage(number)        g_bit_storage_impl(number)
#define g_bit_nth_msf(mask, nth_bit) g_bit_nth_msf_impl(mask, nth_bit)
#define g_bit_nth_lsf(mask, nth_bit) g_bit_nth_lsf_impl(mask, nth_bit)
#define ATEXIT(proc) g_ATEXIT(proc)
#    define G_VA_COPY(ap1, ap2)	  (*(ap1) = *(ap2))
#define G_URI_RESERVED_CHARS_ALLOWED_IN_USERINFO G_URI_RESERVED_CHARS_SUBCOMPONENT_DELIMITERS ":"
#define G_URI_RESERVED_CHARS_ALLOWED_IN_PATH G_URI_RESERVED_CHARS_ALLOWED_IN_PATH_ELEMENT "/"
#define G_URI_RESERVED_CHARS_ALLOWED_IN_PATH_ELEMENT G_URI_RESERVED_CHARS_SUBCOMPONENT_DELIMITERS ":@"
#define G_URI_RESERVED_CHARS_SUBCOMPONENT_DELIMITERS "!$&'()*+,;="
#define G_URI_RESERVED_CHARS_GENERIC_DELIMITERS ":/?#[]@"
#define g_utf8_next_char(p) (char *)((p) + g_utf8_skip[*(const guchar *)(p)])
#define G_UNICHAR_MAX_DECOMPOSITION_LENGTH 18 /* codepoints */
#define G_UNICODE_COMBINING_MARK G_UNICODE_SPACING_MARK
#      define GLIB_VAR extern
#define G_LOG_2_BASE_10		(0.30102999566398119521)
#define G_IEEE754_DOUBLE_BIAS	(1023)
#define G_IEEE754_FLOAT_BIAS	(127)
#define g_size_checked_mul(dest, a, b) \
    _GLIB_CHECKED_MUL_U64(dest, a, b)
#define g_size_checked_add(dest, a, b) \
    _GLIB_CHECKED_ADD_U64(dest, a, b)
#define g_uint64_checked_mul(dest, a, b) \
    _GLIB_CHECKED_MUL_U64(dest, a, b)
#define g_uint64_checked_add(dest, a, b) \
    _GLIB_CHECKED_ADD_U64(dest, a, b)
#define g_uint_checked_mul(dest, a, b) \
    _GLIB_CHECKED_MUL_U32(dest, a, b)
#define g_uint_checked_add(dest, a, b) \
    _GLIB_CHECKED_ADD_U32(dest, a, b)
#define g_htons(val) (GUINT16_TO_BE (val))
#define g_htonl(val) (GUINT32_TO_BE (val))
#define g_ntohs(val) (GUINT16_FROM_BE (val))
#define g_ntohl(val) (GUINT32_FROM_BE (val))
#define GSSIZE_FROM_BE(val)	(GSSIZE_TO_BE (val))
#define GSIZE_FROM_BE(val)	(GSIZE_TO_BE (val))
#define GSSIZE_FROM_LE(val)	(GSSIZE_TO_LE (val))
#define GSIZE_FROM_LE(val)	(GSIZE_TO_LE (val))
#define GUINT_FROM_BE(val)	(GUINT_TO_BE (val))
#define GINT_FROM_BE(val)	(GINT_TO_BE (val))
#define GUINT_FROM_LE(val)	(GUINT_TO_LE (val))
#define GINT_FROM_LE(val)	(GINT_TO_LE (val))
#define GULONG_FROM_BE(val)	(GULONG_TO_BE (val))
#define GLONG_FROM_BE(val)	(GLONG_TO_BE (val))
#define GULONG_FROM_LE(val)	(GULONG_TO_LE (val))
#define GLONG_FROM_LE(val)	(GLONG_TO_LE (val))
#define GUINT64_FROM_BE(val)	(GUINT64_TO_BE (val))
#define GINT64_FROM_BE(val)	(GINT64_TO_BE (val))
#define GUINT64_FROM_LE(val)	(GUINT64_TO_LE (val))
#define GINT64_FROM_LE(val)	(GINT64_TO_LE (val))
#define GUINT32_FROM_BE(val)	(GUINT32_TO_BE (val))
#define GINT32_FROM_BE(val)	(GINT32_TO_BE (val))
#define GUINT32_FROM_LE(val)	(GUINT32_TO_LE (val))
#define GINT32_FROM_LE(val)	(GINT32_TO_LE (val))
#define GUINT16_FROM_BE(val)	(GUINT16_TO_BE (val))
#define GINT16_FROM_BE(val)	(GINT16_TO_BE (val))
#define GUINT16_FROM_LE(val)	(GUINT16_TO_LE (val))
#define GINT16_FROM_LE(val)	(GINT16_TO_LE (val))
#define GUINT32_SWAP_BE_PDP(val)	((guint32) ( \
    (((guint32) (val) & (guint32) 0x00ff00ffU) << 8) | \
    (((guint32) (val) & (guint32) 0xff00ff00U) >> 8)))
#define GUINT32_SWAP_LE_PDP(val)	((guint32) ( \
    (((guint32) (val) & (guint32) 0x0000ffffU) << 16) | \
    (((guint32) (val) & (guint32) 0xffff0000U) >> 16)))
#define GUINT16_SWAP_BE_PDP(val)	(GUINT16_SWAP_LE_BE (val))
#define GUINT16_SWAP_LE_PDP(val)	((guint16) (val))
#    define GUINT64_SWAP_LE_BE_X86_64(val) \
       (G_GNUC_EXTENSION					\
	({ guint64 __v, __x = ((guint64) (val));		\
	   if (__builtin_constant_p (__x))			\
	     __v = GUINT64_SWAP_LE_BE_CONSTANT (__x);		\
	   else							\
	     __asm__ ("bswapq %0"				\
		      : "=r" (__v)				\
		      : "0" (__x));				\
	   __v; }))
#    define GUINT32_SWAP_LE_BE_X86_64(val) \
       (G_GNUC_EXTENSION					\
	 ({ guint32 __v, __x = ((guint32) (val));		\
	    if (__builtin_constant_p (__x))			\
	      __v = GUINT32_SWAP_LE_BE_CONSTANT (__x);		\
	    else						\
	     __asm__ ("bswapl %0"				\
		      : "=r" (__v)				\
		      : "0" (__x));				\
	    __v; }))
#    define GUINT64_SWAP_LE_BE_IA64(val) \
       (G_GNUC_EXTENSION					\
	({ guint64 __v, __x = ((guint64) (val));		\
	   if (__builtin_constant_p (__x))			\
	     __v = GUINT64_SWAP_LE_BE_CONSTANT (__x);		\
	   else							\
	     __asm__ __volatile__ ("mux1 %0 = %1, @rev ;;"	\
				   : "=r" (__v)			\
				   : "r" (__x));		\
	   __v; }))
#    define GUINT32_SWAP_LE_BE_IA64(val) \
       (G_GNUC_EXTENSION					\
	 ({ guint32 __v, __x = ((guint32) (val));		\
	    if (__builtin_constant_p (__x))			\
	      __v = GUINT32_SWAP_LE_BE_CONSTANT (__x);		\
	    else						\
	     __asm__ __volatile__ ("shl %0 = %1, 32 ;;"		\
				   "mux1 %0 = %0, @rev ;;"	\
				    : "=r" (__v)		\
				    : "r" (__x));		\
	    __v; }))
#    define GUINT16_SWAP_LE_BE_IA64(val) \
       (G_GNUC_EXTENSION					\
	({ guint16 __v, __x = ((guint16) (val));		\
	   if (__builtin_constant_p (__x))			\
	     __v = GUINT16_SWAP_LE_BE_CONSTANT (__x);		\
	   else							\
	     __asm__ __volatile__ ("shl %0 = %1, 48 ;;"		\
				   "mux1 %0 = %0, @rev ;;"	\
				    : "=r" (__v)		\
				    : "r" (__x));		\
	    __v; }))
#    define GUINT16_SWAP_LE_BE(val) (GUINT16_SWAP_LE_BE_IA32 (val))
#    define GUINT64_SWAP_LE_BE_IA32(val) \
       (G_GNUC_EXTENSION						\
	({ union { guint64 __ll;					\
		   guint32 __l[2]; } __w, __r;				\
	   __w.__ll = ((guint64) (val));				\
	   if (__builtin_constant_p (__w.__ll))				\
	     __r.__ll = GUINT64_SWAP_LE_BE_CONSTANT (__w.__ll);		\
	   else								\
	     {								\
	       __r.__l[0] = GUINT32_SWAP_LE_BE (__w.__l[1]);		\
	       __r.__l[1] = GUINT32_SWAP_LE_BE (__w.__l[0]);		\
	     }								\
	   __r.__ll; }))
#       define GUINT32_SWAP_LE_BE_IA32(val) \
	  (G_GNUC_EXTENSION					\
	   ({ guint32 __v, __x = ((guint32) (val));		\
	      if (__builtin_constant_p (__x))			\
		__v = GUINT32_SWAP_LE_BE_CONSTANT (__x);	\
	      else						\
		__asm__ ("rorw $8, %w0\n\t"			\
			 "rorl $16, %0\n\t"			\
			 "rorw $8, %w0"				\
			 : "=r" (__v)				\
			 : "0" (__x)				\
			 : "cc");				\
	      __v; }))
#    define GUINT16_SWAP_LE_BE_IA32(val) \
       (G_GNUC_EXTENSION					\
	({ guint16 __v, __x = ((guint16) (val));		\
	   if (__builtin_constant_p (__x))			\
	     __v = GUINT16_SWAP_LE_BE_CONSTANT (__x);		\
	   else							\
	     __asm__ ("rorw $8, %w0"				\
		      : "=r" (__v)				\
		      : "0" (__x)				\
		      : "cc");					\
	    __v; }))
#    define GUINT64_SWAP_LE_BE(val) ((guint64) __builtin_bswap64 ((guint64) (val)))
#    define GUINT32_SWAP_LE_BE(val) ((guint32) __builtin_bswap32 ((guint32) (val)))
#define GUINT64_SWAP_LE_BE_CONSTANT(val)	((guint64) ( \
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0x00000000000000ffU)) << 56) |	\
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0x000000000000ff00U)) << 40) |	\
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0x0000000000ff0000U)) << 24) |	\
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0x00000000ff000000U)) <<  8) |	\
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0x000000ff00000000U)) >>  8) |	\
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0x0000ff0000000000U)) >> 24) |	\
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0x00ff000000000000U)) >> 40) |	\
      (((guint64) (val) &						\
	(guint64) G_GINT64_CONSTANT (0xff00000000000000U)) >> 56)))
#define GUINT32_SWAP_LE_BE_CONSTANT(val)	((guint32) ( \
    (((guint32) (val) & (guint32) 0x000000ffU) << 24) | \
    (((guint32) (val) & (guint32) 0x0000ff00U) <<  8) | \
    (((guint32) (val) & (guint32) 0x00ff0000U) >>  8) | \
    (((guint32) (val) & (guint32) 0xff000000U) >> 24)))
#define GUINT16_SWAP_LE_BE_CONSTANT(val)	((guint16) ( \
    (guint16) ((guint16) (val) >> 8) |	\
    (guint16) ((guint16) (val) << 8)))
#define G_PDP_ENDIAN    3412		/* unused, need specific PDP check */
#define G_BIG_ENDIAN    4321
#define G_LITTLE_ENDIAN 1234
#define G_SQRT2 1.4142135623730950488016887242096980785696718753769
#define G_PI_4  0.78539816339744830961566084581987572104929234984378
#define G_PI_2  1.5707963267948966192313216916397514420985846996876
#define G_PI    3.1415926535897932384626433832795028841971693993751
#define G_LN10  2.3025850929940456840179914546843642076011014886288
#define G_LN2   0.69314718055994530941723212145817656807550013436026
#define G_E     2.7182818284590452353602874713526624977572470937000
#define G_MAXUINT64	G_GUINT64_CONSTANT(0xffffffffffffffff)
#define G_MAXINT64	G_GINT64_CONSTANT(0x7fffffffffffffff)
#define G_MININT64	((gint64) G_GINT64_CONSTANT(-0x8000000000000000))
#define G_MAXUINT32	((guint32) 0xffffffff)
#define G_MAXINT32	((gint32)  0x7fffffff)
#define G_MININT32	((gint32) -0x80000000)
#define G_MAXUINT16	((guint16) 0xffff)
#define G_MAXINT16	((gint16)  0x7fff)
#define G_MININT16	((gint16) -0x8000)
#define G_MAXUINT8	((guint8) 0xff)
#define G_MAXINT8	((gint8)  0x7f)
#define G_MININT8	((gint8) -0x80)
#define G_USEC_PER_SEC 1000000
# define g_once(once, func, arg) g_once_impl ((once), (func), (arg))
#  define G_TRYLOCK(name)                                       \
      (g_log (G_LOG_DOMAIN, G_LOG_LEVEL_DEBUG,                  \
             "file %s: line %d (%s): try locking: %s ",         \
             __FILE__,        __LINE__, G_STRFUNC,              \
             #name), g_mutex_trylock (&G_LOCK_NAME (name)))
#  define G_UNLOCK(name)              G_STMT_START{             \
      g_log (G_LOG_DOMAIN, G_LOG_LEVEL_DEBUG,                   \
             "file %s: line %d (%s): unlocking: %s ",           \
             __FILE__,        __LINE__, G_STRFUNC,              \
             #name);                                            \
     g_mutex_unlock (&G_LOCK_NAME (name));                      \
   }G_STMT_END
#  define G_LOCK(name)                G_STMT_START{             \
      g_log (G_LOG_DOMAIN, G_LOG_LEVEL_DEBUG,                   \
             "file %s: line %d (%s): locking: %s ",             \
             __FILE__,        __LINE__, G_STRFUNC,              \
             #name);                                            \
      g_mutex_lock (&G_LOCK_NAME (name));                       \
   }G_STMT_END
#define G_LOCK_EXTERN(name)           extern GMutex G_LOCK_NAME (name)
#define G_LOCK_DEFINE(name)           GMutex G_LOCK_NAME (name)
#define G_LOCK_DEFINE_STATIC(name)    static G_LOCK_DEFINE (name)
#define G_LOCK_NAME(name)             g__ ## name ## _lock
#define G_ONCE_INIT { G_ONCE_STATUS_NOTCALLED, NULL }
#define G_PRIVATE_INIT(notify) { NULL, (notify), { NULL, NULL } }
#define G_THREAD_ERROR g_thread_error_quark ()
#define g_test_assert_expected_messages() g_test_assert_expected_messages_internal (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC)
#define  g_test_rand_bit()              (0 != (g_test_rand_int() & (1 << 15)))
#define  g_test_trap_assert_stderr_unmatched(serrpattern) g_test_trap_assertions (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, 5, serrpattern)
#define  g_test_trap_assert_stderr(serrpattern)           g_test_trap_assertions (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, 4, serrpattern)
#define  g_test_trap_assert_stdout_unmatched(soutpattern) g_test_trap_assertions (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, 3, soutpattern)
#define  g_test_trap_assert_stdout(soutpattern)           g_test_trap_assertions (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, 2, soutpattern)
#define  g_test_trap_assert_failed()                      g_test_trap_assertions (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, 1, 0)
#define  g_test_trap_assert_passed()                      g_test_trap_assertions (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, 0, 0)
#define g_test_queue_unref(gobject)     g_test_queue_destroy (g_object_unref, gobject)
#define g_test_add(testpath, Fixture, tdata, fsetup, ftest, fteardown) \
					G_STMT_START {			\
                                         void (*add_vtable) (const char*,       \
                                                    gsize,             \
                                                    gconstpointer,     \
                                                    void (*) (Fixture*, gconstpointer),   \
                                                    void (*) (Fixture*, gconstpointer),   \
                                                    void (*) (Fixture*, gconstpointer)) =  (void (*) (const gchar *, gsize, gconstpointer, void (*) (Fixture*, gconstpointer), void (*) (Fixture*, gconstpointer), void (*) (Fixture*, gconstpointer))) g_test_add_vtable; \
                                         add_vtable \
                                          (testpath, sizeof (Fixture), tdata, fsetup, ftest, fteardown); \
					} G_STMT_END
#define g_test_undefined()              (g_test_config_vars->test_undefined)
#define g_test_quiet()                  (g_test_config_vars->test_quiet)
#define g_test_verbose()                (g_test_config_vars->test_verbose)
#define g_test_perf()                   (g_test_config_vars->test_perf)
#define g_test_thorough()               (!g_test_config_vars->test_quick)
#define g_test_slow()                   (!g_test_config_vars->test_quick)
#define g_test_quick()                  (g_test_config_vars->test_quick)
#define g_test_initialized()            (g_test_config_vars->test_initialized)
#define g_assert(expr)                  G_STMT_START { (void) 0; } G_STMT_END
#define g_assert_not_reached()          G_STMT_START { (void) 0; } G_STMT_END
#define g_assert_nonnull(expr)          G_STMT_START { \
                                             if G_LIKELY ((expr) != NULL) ; else \
                                               g_assertion_message (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                                    "'" #expr "' should not be NULL"); \
                                        } G_STMT_END
#define g_assert_null(expr)             G_STMT_START { if G_LIKELY ((expr) == NULL) ; else \
                                               g_assertion_message (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                                    "'" #expr "' should be NULL"); \
                                        } G_STMT_END
#define g_assert_false(expr)            G_STMT_START { \
                                             if G_LIKELY (!(expr)) ; else \
                                               g_assertion_message (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                                    "'" #expr "' should be FALSE"); \
                                        } G_STMT_END
#define g_assert_true(expr)             G_STMT_START { \
                                             if G_LIKELY (expr) ; else \
                                               g_assertion_message (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                                    "'" #expr "' should be TRUE"); \
                                        } G_STMT_END
#define g_assert_error(err, dom, c)     G_STMT_START { \
                                               if (!err || (err)->domain != dom || (err)->code != c) \
                                               g_assertion_message_error (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                 #err, err, dom, c); \
                                        } G_STMT_END
#define g_assert_no_error(err)          G_STMT_START { \
                                             if (err) \
                                               g_assertion_message_error (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                 #err, err, 0, 0); \
                                        } G_STMT_END
#define g_assert_cmpmem(m1, l1, m2, l2) G_STMT_START {\
                                             gconstpointer __m1 = m1, __m2 = m2; \
                                             int __l1 = l1, __l2 = l2; \
                                             if (__l1 != __l2) \
                                               g_assertion_message_cmpnum (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                                           #l1 " (len(" #m1 ")) == " #l2 " (len(" #m2 "))", \
                                                                           (long double) __l1, "==", (long double) __l2, 'i'); \
                                             else if (__l1 != 0 && memcmp (__m1, __m2, __l1) != 0) \
                                               g_assertion_message (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                                    "assertion failed (" #m1 " == " #m2 ")"); \
                                        } G_STMT_END
#define g_assert_cmpfloat(n1,cmp,n2)    G_STMT_START { \
                                             long double __n1 = (n1), __n2 = (n2); \
                                             if (__n1 cmp __n2) ; else \
                                               g_assertion_message_cmpnum (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                 #n1 " " #cmp " " #n2, (long double) __n1, #cmp, (long double) __n2, 'f'); \
                                        } G_STMT_END
#define g_assert_cmphex(n1, cmp, n2)    G_STMT_START {\
                                             guint64 __n1 = (n1), __n2 = (n2); \
                                             if (__n1 cmp __n2) ; else \
                                               g_assertion_message_cmpnum (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                 #n1 " " #cmp " " #n2, (long double) __n1, #cmp, (long double) __n2, 'x'); \
                                        } G_STMT_END
#define g_assert_cmpuint(n1, cmp, n2)   G_STMT_START { \
                                             guint64 __n1 = (n1), __n2 = (n2); \
                                             if (__n1 cmp __n2) ; else \
                                               g_assertion_message_cmpnum (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                 #n1 " " #cmp " " #n2, (long double) __n1, #cmp, (long double) __n2, 'i'); \
                                        } G_STMT_END
#define g_assert_cmpint(n1, cmp, n2)    G_STMT_START { \
                                             gint64 __n1 = (n1), __n2 = (n2); \
                                             if (__n1 cmp __n2) ; else \
                                               g_assertion_message_cmpnum (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                 #n1 " " #cmp " " #n2, (long double) __n1, #cmp, (long double) __n2, 'i'); \
                                        } G_STMT_END
#define g_assert_cmpstr(s1, cmp, s2)    G_STMT_START { \
                                             const char *__s1 = (s1), *__s2 = (s2); \
                                             if (g_strcmp0 (__s1, __s2) cmp 0) ; else \
                                               g_assertion_message_cmpstr (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, \
                                                 #s1 " " #cmp " " #s2, __s1, #cmp, __s2); \
                                        } G_STMT_END
#define  g_string_sprintfa g_string_append_printf
#define  g_string_sprintf  g_string_printf
#define G_NUMBER_PARSER_ERROR (g_number_parser_error_quark ())
#define g_strstrip( string )	g_strchomp (g_strchug (string))
#define G_ASCII_DTOSTR_BUF_SIZE (29 + 10)
#define	 G_STR_DELIMITERS	"_-|> <."
#define g_ascii_isxdigit(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_XDIGIT) != 0)
#define g_ascii_isupper(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_UPPER) != 0)
#define g_ascii_isspace(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_SPACE) != 0)
#define g_ascii_ispunct(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_PUNCT) != 0)
#define g_ascii_isprint(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_PRINT) != 0)
#define g_ascii_islower(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_LOWER) != 0)
#define g_ascii_isgraph(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_GRAPH) != 0)
#define g_ascii_isdigit(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_DIGIT) != 0)
#define g_ascii_iscntrl(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_CNTRL) != 0)
#define g_ascii_isalpha(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_ALPHA) != 0)
#define g_ascii_isalnum(c) \
  ((g_ascii_table[(guchar) (c)] & G_ASCII_ALNUM) != 0)
#define G_SPAWN_EXIT_ERROR g_spawn_exit_error_quark ()
#define G_SPAWN_ERROR g_spawn_error_quark ()
#define  g_slist_next(slist)	         ((slist) ? (((GSList *)(slist))->next) : NULL)
#define	 g_slist_free1		         g_slist_free_1
#define g_slice_free_chain(type, mem_chain, next)               \
G_STMT_START {                                                  \
  if (1) g_slice_free_chain_with_offset (sizeof (type),		\
                 (mem_chain), G_STRUCT_OFFSET (type, next)); 	\
  else   (void) ((type*) 0 == (mem_chain));			\
} G_STMT_END
#define g_slice_free(type, mem)                                 \
G_STMT_START {                                                  \
  if (1) g_slice_free1 (sizeof (type), (mem));			\
  else   (void) ((type*) 0 == (mem)); 				\
} G_STMT_END
#define g_slice_dup(type, mem)                                  \
  (1 ? (type*) g_slice_copy (sizeof (type), (mem))              \
     : ((void) ((type*) 0 == (mem)), (type*) 0))
#define  g_slice_new0(type)     ((type*) g_slice_alloc0 (sizeof (type)))
#define  g_slice_new(type)      ((type*) g_slice_alloc (sizeof (type)))
#define G_SHELL_ERROR g_shell_error_quark ()
#define g_scanner_thaw_symbol_table(scanner) ((void)0)
#define g_scanner_freeze_symbol_table(scanner) ((void)0)
#define		g_scanner_foreach_symbol( scanner, func, data )	G_STMT_START { \
  g_scanner_scope_foreach_symbol ((scanner), 0, (func), (data)); \
} G_STMT_END
#define		g_scanner_remove_symbol( scanner, symbol )	G_STMT_START { \
  g_scanner_scope_remove_symbol ((scanner), 0, (symbol)); \
} G_STMT_END
#define		g_scanner_add_symbol( scanner, symbol, value )	G_STMT_START { \
  g_scanner_scope_add_symbol ((scanner), 0, (symbol), (value)); \
} G_STMT_END
#define G_CSET_LATINS	"\337\340\341\342\343\344\345\346"\
			"\347\350\351\352\353\354\355\356\357\360"\
			"\361\362\363\364\365\366"\
			"\370\371\372\373\374\375\376\377"
#define G_CSET_LATINC	"\300\301\302\303\304\305\306"\
			"\307\310\311\312\313\314\315\316\317\320"\
			"\321\322\323\324\325\326"\
			"\330\331\332\333\334\335\336"
#define G_CSET_DIGITS	"0123456789"
#define G_CSET_a_2_z	"abcdefghijklmnopqrstuvwxyz"
#define G_CSET_A_2_Z	"ABCDEFGHIJKLMNOPQRSTUVWXYZ"
#define G_REGEX_ERROR g_regex_error_quark ()
#define g_random_boolean() ((g_random_int () & (1 << 15)) != 0)
#define g_rand_boolean(rand_) ((g_rand_int (rand_) & (1 << 15)) != 0)
#define G_QUEUE_INIT { NULL, NULL, 0 }
#define G_DEFINE_QUARK(QN, q_n)                                         \
GQuark                                                                  \
q_n##_quark (void)                                                      \
{                                                                       \
  static GQuark q;                                                      \
                                                                        \
  if G_UNLIKELY (q == 0)                                                \
    q = g_quark_from_static_string (#QN);                               \
                                                                        \
  return q;                                                             \
}
#define G_OPTION_REMAINING ""
#define G_OPTION_ERROR (g_option_error_quark ())
#define	 g_node_first_child(node)	((node) ? \
					 ((GNode*) (node))->children : NULL)
#define	 g_node_next_sibling(node)	((node) ? \
					 ((GNode*) (node))->next : NULL)
#define	 g_node_prev_sibling(node)	((node) ? \
					 ((GNode*) (node))->prev : NULL)
#define	g_node_append_data(parent, data)			\
     g_node_insert_before ((parent), NULL, g_node_new (data))
#define	g_node_prepend_data(parent, data)			\
     g_node_prepend ((parent), g_node_new (data))
#define	g_node_insert_data_before(parent, sibling, data)	\
     g_node_insert_before ((parent), (sibling), g_node_new (data))
#define	g_node_insert_data_after(parent, sibling, data)	\
     g_node_insert_after ((parent), (sibling), g_node_new (data))
#define	g_node_insert_data(parent, position, data)		\
     g_node_insert ((parent), (position), g_node_new (data))
#define g_node_append(parent, node)				\
     g_node_insert_before ((parent), NULL, (node))
#define	 G_NODE_IS_LEAF(node)	(((GNode*) (node))->children == NULL)
#define	 G_NODE_IS_ROOT(node)	(((GNode*) (node))->parent == NULL && \
				 ((GNode*) (node))->prev == NULL && \
				 ((GNode*) (node))->next == NULL)
#define g_return_val_if_reached(val) G_STMT_START{ return (val); }G_STMT_END
#define g_return_if_reached() G_STMT_START{ return; }G_STMT_END
#define g_return_val_if_fail(expr,val) G_STMT_START{ (void)0; }G_STMT_END
#define g_return_if_fail(expr) G_STMT_START{ (void)0; }G_STMT_END
#define g_warn_if_fail(expr) \
  do { \
    if G_LIKELY (expr) ; \
    else g_warn_message (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, #expr); \
  } while (0)
#define g_warn_if_reached() \
  do { \
    g_warn_message (G_LOG_DOMAIN, __FILE__, __LINE__, G_STRFUNC, NULL); \
  } while (0)
#define g_debug(...)    g_log_structured_standard (G_LOG_DOMAIN, G_LOG_LEVEL_DEBUG, \
                                                   __FILE__, G_STRINGIFY (__LINE__), \
                                                   G_STRFUNC, __VA_ARGS__)
#define g_info(...)     g_log_structured_standard (G_LOG_DOMAIN, G_LOG_LEVEL_INFO, \
                                                   __FILE__, G_STRINGIFY (__LINE__), \
                                                   G_STRFUNC, __VA_ARGS__)
#define g_warning(...)  g_log_structured_standard (G_LOG_DOMAIN, G_LOG_LEVEL_WARNING, \
                                                   __FILE__, G_STRINGIFY (__LINE__), \
                                                   G_STRFUNC, __VA_ARGS__)
#define g_critical(...) g_log_structured_standard (G_LOG_DOMAIN, G_LOG_LEVEL_CRITICAL, \
                                                   __FILE__, G_STRINGIFY (__LINE__), \
                                                   G_STRFUNC, __VA_ARGS__)
#define g_message(...)  g_log_structured_standard (G_LOG_DOMAIN, G_LOG_LEVEL_MESSAGE, \
                                                   __FILE__, G_STRINGIFY (__LINE__), \
                                                   G_STRFUNC, __VA_ARGS__)
#define g_error(...)  G_STMT_START {                                            \
                        g_log_structured_standard (G_LOG_DOMAIN, G_LOG_LEVEL_ERROR, \
                                                   __FILE__, G_STRINGIFY (__LINE__), \
                                                   G_STRFUNC, __VA_ARGS__); \
                        for (;;) ;                                              \
                      } G_STMT_END
#define G_LOG_DOMAIN    ((gchar*) 0)
#define G_DEBUG_HERE()                                          \
  g_log_structured (G_LOG_DOMAIN, G_LOG_LEVEL_DEBUG,            \
                    "CODE_FILE", __FILE__,                      \
                    "CODE_LINE", G_STRINGIFY (__LINE__),        \
                    "CODE_FUNC", G_STRFUNC,                      \
                    "MESSAGE", "%" G_GINT64_FORMAT ": %s",      \
                    g_get_monotonic_time (), G_STRLOC)
#define G_LOG_FATAL_MASK        (G_LOG_FLAG_RECURSION | G_LOG_LEVEL_ERROR)
#define G_LOG_LEVEL_USER_SHIFT  (8)
#define g_try_renew(struct_type, mem, n_structs)	_G_RENEW (struct_type, mem, n_structs, try_realloc)
#define g_try_new0(struct_type, n_structs)		_G_NEW (struct_type, n_structs, try_malloc0)
#define g_try_new(struct_type, n_structs)		_G_NEW (struct_type, n_structs, try_malloc)
#define g_renew(struct_type, mem, n_structs)		_G_RENEW (struct_type, mem, n_structs, realloc)
#define g_new0(struct_type, n_structs)			_G_NEW (struct_type, n_structs, malloc0)
#define g_new(struct_type, n_structs)			_G_NEW (struct_type, n_structs, malloc)
#  define G_MEM_ALIGN	GLIB_SIZEOF_VOID_P
#define G_MARKUP_ERROR g_markup_error_quark ()
#define G_SOURCE_CONTINUE       TRUE
#define G_SOURCE_REMOVE         FALSE
#define G_PRIORITY_LOW              300
#define G_PRIORITY_DEFAULT_IDLE     200
#define G_PRIORITY_HIGH_IDLE        100
#define G_PRIORITY_DEFAULT          0
#define G_PRIORITY_HIGH            -100
#define g_autofree _GLIB_CLEANUP(g_autoptr_cleanup_generic_gfree)
#define g_auto(TypeName) _GLIB_CLEANUP(_GLIB_AUTO_FUNC_NAME(TypeName)) TypeName
#define g_autoslist(TypeName) _GLIB_CLEANUP(_GLIB_AUTOPTR_SLIST_FUNC_NAME(TypeName)) _GLIB_AUTOPTR_SLIST_TYPENAME(TypeName)
#define g_autolist(TypeName) _GLIB_CLEANUP(_GLIB_AUTOPTR_LIST_FUNC_NAME(TypeName)) _GLIB_AUTOPTR_LIST_TYPENAME(TypeName)
#define g_autoptr(TypeName) _GLIB_CLEANUP(_GLIB_AUTOPTR_FUNC_NAME(TypeName)) _GLIB_AUTOPTR_TYPENAME(TypeName)
#define G_DEFINE_AUTO_CLEANUP_FREE_FUNC(TypeName, func, none) \
  G_GNUC_BEGIN_IGNORE_DEPRECATIONS                                                                              \
  static inline void _GLIB_AUTO_FUNC_NAME(TypeName) (TypeName *_ptr) { if (*_ptr != none) (func) (*_ptr); }     \
  G_GNUC_END_IGNORE_DEPRECATIONS
#define G_DEFINE_AUTO_CLEANUP_CLEAR_FUNC(TypeName, func) \
  G_GNUC_BEGIN_IGNORE_DEPRECATIONS                                                                              \
  static inline void _GLIB_AUTO_FUNC_NAME(TypeName) (TypeName *_ptr) { (func) (_ptr); }                         \
  G_GNUC_END_IGNORE_DEPRECATIONS
#define G_DEFINE_AUTOPTR_CLEANUP_FUNC(TypeName, func) \
  typedef TypeName *_GLIB_AUTOPTR_TYPENAME(TypeName);                                                           \
  typedef GList *_GLIB_AUTOPTR_LIST_TYPENAME(TypeName);                                                         \
  typedef GSList *_GLIB_AUTOPTR_SLIST_TYPENAME(TypeName);                                                         \
  G_GNUC_BEGIN_IGNORE_DEPRECATIONS                                                                              \
  static inline void _GLIB_AUTOPTR_FUNC_NAME(TypeName) (TypeName **_ptr) { if (*_ptr) (func) (*_ptr); }         \
  static inline void _GLIB_AUTOPTR_LIST_FUNC_NAME(TypeName) (GList **_l) { g_list_free_full (*_l, (GDestroyNotify) func); } \
  static inline void _GLIB_AUTOPTR_SLIST_FUNC_NAME(TypeName) (GSList **_l) { g_slist_free_full (*_l, (GDestroyNotify) func); } \
  G_GNUC_END_IGNORE_DEPRECATIONS
#define GLIB_UNAVAILABLE(maj,min) _GLIB_EXTERN
#define GLIB_DEPRECATED_FOR(f) _GLIB_EXTERN
#define GLIB_DEPRECATED _GLIB_EXTERN
#define G_UNAVAILABLE(maj,min) __attribute__((deprecated("Not available before " #maj "." #min)))
#define G_DEPRECATED_FOR(f) __attribute__((__deprecated__("Use '" #f "' instead")))
#define G_DEPRECATED __attribute__((__deprecated__))
#define G_UNLIKELY(expr) (__builtin_expect (_G_BOOLEAN_EXPR((expr)), 0))
#define G_LIKELY(expr) (__builtin_expect (_G_BOOLEAN_EXPR((expr)), 1))
#define G_CONST_RETURN
#define G_STMT_END \
    __pragma(warning(push)) \
    __pragma(warning(disable:4127)) \
    while(0) \
    __pragma(warning(pop))
#define G_STMT_START  do
#define G_STRUCT_MEMBER(member_type, struct_p, struct_offset)   \
    (*(member_type*) G_STRUCT_MEMBER_P ((struct_p), (struct_offset)))
#define G_STRUCT_MEMBER_P(struct_p, struct_offset)   \
    ((gpointer) ((guint8*) (struct_p) + (glong) (struct_offset)))
#define G_STRUCT_OFFSET(struct_type, member) \
      ((glong) offsetof (struct_type, member))
#define GSIZE_TO_POINTER(s)	((gpointer) (gsize) (s))
#define GPOINTER_TO_SIZE(p)	((gsize) (p))
#define G_N_ELEMENTS(arr)		(sizeof (arr) / sizeof ((arr)[0]))
#define CLAMP(x, low, high)  (((x) > (high)) ? (high) : (((x) < (low)) ? (low) : (x)))
#define ABS(a)	   (((a) < 0) ? -(a) : (a))
#define MIN(a, b)  (((a) < (b)) ? (a) : (b))
#define MAX(a, b)  (((a) > (b)) ? (a) : (b))
#define	TRUE	(!FALSE)
#define	FALSE	(0)
#  define NULL        (0L)
#define G_END_DECLS    }
#define G_BEGIN_DECLS  extern "C" {
#define G_STRFUNC     ((const char*) (__PRETTY_FUNCTION__))
#define G_STRLOC	__FILE__ ":" G_STRINGIFY (__LINE__) ":" __PRETTY_FUNCTION__ "()"
#define G_STATIC_ASSERT_EXPR(expr) ((void) sizeof (char[(expr) ? 1 : -1]))
#define G_STATIC_ASSERT(expr) typedef char G_PASTE (_GStaticAssertCompileTimeAssertion_, __COUNTER__)[(expr) ? 1 : -1] G_GNUC_UNUSED
#define G_PASTE(identifier1,identifier2)      G_PASTE_ARGS (identifier1, identifier2)
#define G_PASTE_ARGS(identifier1,identifier2) identifier1 ## identifier2
#define	G_STRINGIFY_ARG(contents)	#contents
#define G_STRINGIFY(macro_or_string)	G_STRINGIFY_ARG (macro_or_string)
#define G_ANALYZER_NORETURN 
#define G_ANALYZER_ANALYZING 1
#define G_GNUC_PRETTY_FUNCTION  __PRETTY_FUNCTION__
#define G_GNUC_FUNCTION         __FUNCTION__
#define G_GNUC_WARN_UNUSED_RESULT __attribute__((warn_unused_result))
#define G_GNUC_MAY_ALIAS __attribute__((may_alias))
#define G_GNUC_END_IGNORE_DEPRECATIONS			\
  _Pragma ("warning (pop)")
#define G_GNUC_BEGIN_IGNORE_DEPRECATIONS                \
  _Pragma ("warning (push)")                            \
  _Pragma ("warning (disable:1478)")
#define G_GNUC_DEPRECATED_FOR(f)                        \
  __attribute__((deprecated("Use " #f " instead")))
#define G_GNUC_DEPRECATED __attribute__((__deprecated__))
#define G_GNUC_NO_INSTRUMENT			\
  __attribute__((__no_instrument_function__))
#define G_GNUC_UNUSED                           \
  __attribute__((__unused__))
#define G_GNUC_CONST                            \
  __attribute__((__const__))
#define G_GNUC_NORETURN                         \
  __attribute__((__noreturn__))
#define G_GNUC_FORMAT( arg_idx )                \
  __attribute__((__format_arg__ (arg_idx)))
#define G_GNUC_SCANF( format_idx, arg_idx )     \
  __attribute__((__format__ (__scanf__, format_idx, arg_idx)))
#define G_GNUC_PRINTF( format_idx, arg_idx )    \
  __attribute__((__format__ (__printf__, format_idx, arg_idx)))
#define G_GNUC_ALLOC_SIZE2(x,y) __attribute__((__alloc_size__(x,y)))
#define G_GNUC_ALLOC_SIZE(x) __attribute__((__alloc_size__(x)))
#define G_GNUC_NULL_TERMINATED __attribute__((__sentinel__))
#define G_GNUC_MALLOC __attribute__((__malloc__))
#define G_GNUC_PURE __attribute__((__pure__))
#  define G_INLINE_FUNC extern
# define inline __inline
#   define G_INLINE_DEFINE_NEEDED
#define G_CAN_INLINE
#define G_GNUC_EXTENSION __extension__
#define G_GNUC_CHECK_VERSION(major, minor) \
    ((__GNUC__ > (major)) || \
     ((__GNUC__ == (major)) && \
      (__GNUC_MINOR__ >= (minor))))
#define g_list_next(list)	        ((list) ? (((GList *)(list))->next) : NULL)
#define g_list_previous(list)	        ((list) ? (((GList *)(list))->prev) : NULL)
#define  g_list_free1                   g_list_free_1
#define G_UNIX_ERROR (g_unix_error_quark())
#define G_KEY_FILE_DESKTOP_TYPE_DIRECTORY       "Directory"
#define G_KEY_FILE_DESKTOP_TYPE_LINK            "Link"
#define G_KEY_FILE_DESKTOP_TYPE_APPLICATION     "Application"
#define G_KEY_FILE_DESKTOP_KEY_ACTIONS          "Actions"
#define G_KEY_FILE_DESKTOP_KEY_DBUS_ACTIVATABLE "DBusActivatable"
#define G_KEY_FILE_DESKTOP_KEY_URL              "URL"
#define G_KEY_FILE_DESKTOP_KEY_STARTUP_WM_CLASS "StartupWMClass"
#define G_KEY_FILE_DESKTOP_KEY_STARTUP_NOTIFY   "StartupNotify"
#define G_KEY_FILE_DESKTOP_KEY_CATEGORIES       "Categories"
#define G_KEY_FILE_DESKTOP_KEY_MIME_TYPE        "MimeType"
#define G_KEY_FILE_DESKTOP_KEY_TERMINAL         "Terminal"
#define G_KEY_FILE_DESKTOP_KEY_PATH             "Path"
#define G_KEY_FILE_DESKTOP_KEY_EXEC             "Exec"
#define G_KEY_FILE_DESKTOP_KEY_TRY_EXEC         "TryExec"
#define G_KEY_FILE_DESKTOP_KEY_NOT_SHOW_IN      "NotShowIn"
#define G_KEY_FILE_DESKTOP_KEY_ONLY_SHOW_IN     "OnlyShowIn"
#define G_KEY_FILE_DESKTOP_KEY_HIDDEN           "Hidden"
#define G_KEY_FILE_DESKTOP_KEY_ICON             "Icon"
#define G_KEY_FILE_DESKTOP_KEY_COMMENT          "Comment"
#define G_KEY_FILE_DESKTOP_KEY_NO_DISPLAY       "NoDisplay"
#define G_KEY_FILE_DESKTOP_KEY_GENERIC_NAME     "GenericName"
#define G_KEY_FILE_DESKTOP_KEY_NAME             "Name"
#define G_KEY_FILE_DESKTOP_KEY_VERSION          "Version"
#define G_KEY_FILE_DESKTOP_KEY_TYPE             "Type"
#define G_KEY_FILE_DESKTOP_GROUP                "Desktop Entry"
#define G_KEY_FILE_ERROR g_key_file_error_quark()
#define G_WIN32_MSG_HANDLE 19981206
#define G_IO_CHANNEL_ERROR g_io_channel_error_quark()
#define NC_(Context, String) (String)
#define C_(Context,String) g_dpgettext (NULL, Context "\004" String, strlen (Context) + 1)
#define N_(String) (String)
#define Q_(String) g_dpgettext (NULL, String, 0)
#define NC_(Context, String) (String)
#define C_(Context,String) g_dpgettext (GETTEXT_PACKAGE, Context "\004" String, strlen (Context) + 1)
#define N_(String) (String)
#define Q_(String) g_dpgettext (GETTEXT_PACKAGE, String, 0)
#define	 g_hook_append( hook_list, hook )  \
     g_hook_insert_before ((hook_list), NULL, (hook))
#define G_HOOK_IS_UNLINKED(hook)	(G_HOOK (hook)->next == NULL && \
					 G_HOOK (hook)->prev == NULL && \
					 G_HOOK (hook)->hook_id == 0 && \
					 G_HOOK (hook)->ref_count == 0)
#define G_HOOK_IS_VALID(hook)		(G_HOOK (hook)->hook_id != 0 && \
					 (G_HOOK_FLAGS (hook) & \
                                          G_HOOK_FLAG_ACTIVE))
#define	G_HOOK_IN_CALL(hook)		((G_HOOK_FLAGS (hook) & \
					  G_HOOK_FLAG_IN_CALL) != 0)
#define	G_HOOK_ACTIVE(hook)		((G_HOOK_FLAGS (hook) & \
					  G_HOOK_FLAG_ACTIVE) != 0)
#define	G_HOOK_FLAGS(hook)		(G_HOOK (hook)->flags)
#define	G_HOOK(hook)			((GHook*) (hook))
#define G_HOOK_FLAG_USER_SHIFT	(4)
#define g_hash_table_thaw(hash_table) ((void)0)
#define g_hash_table_freeze(hash_table) ((void)0)
#define g_dirname g_path_get_dirname
#define G_IS_DIR_SEPARATOR(c) ((c) == G_DIR_SEPARATOR || (c) == '/')
#define G_FILE_ERROR g_file_error_quark ()
#define G_TIME_SPAN_MILLISECOND         (G_GINT64_CONSTANT (1000))
#define G_TIME_SPAN_SECOND              (G_GINT64_CONSTANT (1000000))
#define G_TIME_SPAN_MINUTE              (G_GINT64_CONSTANT (60000000))
#define G_TIME_SPAN_HOUR                (G_GINT64_CONSTANT (3600000000))
#define G_TIME_SPAN_DAY                 (G_GINT64_CONSTANT (86400000000))
#define g_date_sunday_weeks_in_year	g_date_get_sunday_weeks_in_year
#define g_date_monday_weeks_in_year 	g_date_get_monday_weeks_in_year
#define g_date_days_in_month 		g_date_get_days_in_month
#define g_date_sunday_week_of_year 	g_date_get_sunday_week_of_year
#define g_date_monday_week_of_year 	g_date_get_monday_week_of_year
#define g_date_day_of_year 		g_date_get_day_of_year
#define g_date_julian 			g_date_get_julian
#define g_date_day 			g_date_get_day
#define g_date_year 			g_date_get_year
#define g_date_month 			g_date_get_month
#define g_date_weekday 			g_date_get_weekday
#define G_DATE_BAD_YEAR   0U
#define G_DATE_BAD_DAY    0U
#define G_DATE_BAD_JULIAN 0U
#define   g_dataset_remove_data(l, k)           \
     g_dataset_id_set_data ((l), g_quark_try_string (k), NULL)
#define   g_dataset_set_data(l, k, d)           \
     g_dataset_set_data_full ((l), (k), (d), NULL)
#define   g_dataset_remove_no_notify(l, k)      \
     g_dataset_id_remove_no_notify ((l), g_quark_try_string (k))
#define   g_dataset_set_data_full(l, k, d, f)   \
     g_dataset_id_set_data_full ((l), g_quark_from_string (k), (d), (f))
#define   g_dataset_get_data(l, k)              \
     (g_dataset_id_get_data ((l), g_quark_try_string (k)))
#define   g_dataset_id_remove_data(l, k)        \
     g_dataset_id_set_data ((l), (k), NULL)
#define   g_dataset_id_set_data(l, k, d)        \
     g_dataset_id_set_data_full ((l), (k), (d), NULL)
#define   g_datalist_remove_data(dl, k)         \
     g_datalist_id_set_data ((dl), g_quark_try_string (k), NULL)
#define   g_datalist_set_data(dl, k, d)         \
     g_datalist_set_data_full ((dl), (k), (d), NULL)
#define   g_datalist_remove_no_notify(dl, k)    \
     g_datalist_id_remove_no_notify ((dl), g_quark_try_string (k))
#define   g_datalist_set_data_full(dl, k, d, f) \
     g_datalist_id_set_data_full ((dl), g_quark_from_string (k), (d), (f))
#define   g_datalist_id_remove_data(dl, q)      \
     g_datalist_id_set_data ((dl), (q), NULL)
#define   g_datalist_id_set_data(dl, q, d)      \
     g_datalist_id_set_data_full ((dl), (q), (d), NULL)
#define G_DATALIST_FLAGS_MASK 0x3
#define G_CONVERT_ERROR g_convert_error_quark()
#define G_BOOKMARK_FILE_ERROR	(g_bookmark_file_error_quark ())
#  define G_BREAKPOINT()        G_STMT_START{ __asm__ __volatile__ ("int $03"); }G_STMT_END
#define    g_ptr_array_index(array,index_) ((array)->pdata)[index_]
#define g_array_index(a,t,i)      (((t*) (void *) (a)->data) [(i)])
#define g_array_insert_val(a,i,v) g_array_insert_vals (a, i, &(v), 1)
#define g_array_prepend_val(a,v)  g_array_prepend_vals (a, &(v), 1)
#define g_array_append_val(a,v)	  g_array_append_vals (a, &(v), 1)
#define g_newa(struct_type, n_structs)	((struct_type*) g_alloca (sizeof (struct_type) * (gsize) (n_structs)))
#define g_alloca(size)		 alloca (size)
# define alloca(size)   __builtin_alloca (size)
typedef int GPid;
typedef unsigned long guintptr;
typedef signed long gintptr;
typedef unsigned long gsize;
typedef signed long gssize;
typedef unsigned long guint64;
typedef signed long gint64;
typedef unsigned int guint32;
typedef signed int gint32;
typedef unsigned short guint16;
typedef signed short gint16;
typedef unsigned char guint8;
typedef signed char gint8;
typedef const void *gconstpointer;
typedef void* gpointer;
typedef double  gdouble;
typedef float   gfloat;
typedef unsigned int    guint;
typedef unsigned long   gulong;
typedef unsigned short  gushort;
typedef unsigned char   guchar;
typedef int    gint;
typedef long   glong;
typedef short  gshort;
typedef char   gchar;
typedef void GMutexLocker;
typedef struct GTestSuite GTestSuite;
typedef struct GTestCase  GTestCase;
typedef struct _stat32 GStatBuf;
typedef struct _GSequenceNode  GSequenceIter;
typedef gint64 goffset;
typedef guint16 gunichar2;
typedef guint32 gunichar;
typedef gint   gboolean;
typedef gchar** GStrv;
typedef guint32 GQuark;
typedef gint64 GTimeSpan;
typedef guint8  GDateDay;   /* day of the month */
typedef guint16 GDateYear;
typedef gint32  GTime;
typedef struct _GIConv *GIConv;
typedef union _GDoubleIEEE754 GDoubleIEEE754;
typedef union _GFloatIEEE754 GFloatIEEE754;
typedef union _GMutex GMutex;
typedef union _GTokenValue GTokenValue;
typedef struct __GModule GModule;
typedef struct _GStaticPrivate GStaticPrivate;
typedef struct _GStaticRWLock GStaticRWLock;
typedef struct _GStaticRecMutex GStaticRecMutex;
typedef struct _GThreadFunctions GThreadFunctions;
typedef struct _GThread GThread;
typedef struct __GRelation GRelation;
typedef struct _GTuples GTuples;
typedef struct _GCompletion GCompletion;
typedef struct __GCache GCache;
typedef struct __GVariantType GVariantType;
typedef struct __GVariant GVariant;
typedef struct _GVariantDict GVariantDict;
typedef struct _GVariantBuilder GVariantBuilder;
typedef struct _GVariantIter GVariantIter;
typedef struct _GDebugKey GDebugKey;
typedef struct _GTimeVal GTimeVal;
typedef struct __GTree GTree;
typedef struct _GTrashStack GTrashStack;
typedef struct __GTimeZone GTimeZone;
typedef struct __GTimer GTimer;
typedef struct _GThreadPool GThreadPool;
typedef struct _GOnce GOnce;
typedef struct _GPrivate GPrivate;
typedef struct _GRecMutex GRecMutex;
typedef struct _GCond GCond;
typedef struct _GRWLock GRWLock;
typedef struct __GStringChunk GStringChunk;
typedef struct _GString GString;
typedef struct _GWin32PrivateStat GWin32PrivateStat;
typedef struct utimbuf utimbuf;
typedef struct _GSList GSList;
typedef struct __GSequence GSequence;
typedef struct _GScanner GScanner;
typedef struct _GScannerConfig GScannerConfig;
typedef struct __GRegex GRegex;
typedef struct __GMatchInfo GMatchInfo;
typedef struct __GRand GRand;
typedef struct _GQueue GQueue;
typedef struct _GPollFD GPollFD;
typedef struct __GPatternSpec GPatternSpec;
typedef struct __GOptionGroup GOptionGroup;
typedef struct __GOptionContext GOptionContext;
typedef struct _GOptionEntry GOptionEntry;
typedef struct _GNode GNode;
typedef struct _GLogField GLogField;
typedef struct _GMemVTable GMemVTable;
typedef struct __GMarkupParseContext GMarkupParseContext;
typedef struct _GMarkupParser GMarkupParser;
typedef struct __GMappedFile GMappedFile;
typedef struct __GSourcePrivate GSourcePrivate;
typedef struct __GMainLoop GMainLoop;
typedef struct __GMainContext GMainContext;
typedef struct _GSourceFuncs GSourceFuncs;
typedef struct _GSourceCallbackFuncs GSourceCallbackFuncs;
typedef struct _GSource GSource;
typedef struct _GList GList;
typedef struct __GKeyFile GKeyFile;
typedef struct _GIOFuncs GIOFuncs;
typedef struct _GIOChannel GIOChannel;
typedef struct _GHook GHook;
typedef struct _GHookList GHookList;
typedef struct __GHmac GHmac;
typedef struct __GHashTable GHashTable;
typedef struct _GHashTableIter GHashTableIter;
typedef struct _GError GError;
typedef struct __GDir GDir;
typedef struct __GDateTime GDateTime;
typedef struct _GDate GDate;
typedef struct __GData GData;
typedef struct __GChecksum GChecksum;
typedef struct __GBookmarkFile GBookmarkFile;
typedef struct __GAsyncQueue GAsyncQueue;
typedef struct __GBytes GBytes;
typedef struct _GPtrArray GPtrArray;
typedef struct _GByteArray GByteArray;
typedef struct _GArray GArray;

#define _GLIB_EXTERN extern
typedef __gnuc_va_list va_list;
typedef int FILE;
typedef int time_t;
typedef unsigned long int pthread_t;
typedef struct
{
  GMutex *mutex;
} GStaticMutex;


typedef enum
{
  G_MODULE_BIND_LAZY	= 1 << 0,
  G_MODULE_BIND_LOCAL	= 1 << 1,
  G_MODULE_BIND_MASK	= 0x03
} GModuleFlags;
typedef enum
{
  G_THREAD_PRIORITY_LOW,
  G_THREAD_PRIORITY_NORMAL,
  G_THREAD_PRIORITY_HIGH,
  G_THREAD_PRIORITY_URGENT
} GThreadPriority;
typedef enum
{
  G_WIN32_OS_ANY,
  G_WIN32_OS_WORKSTATION,
  G_WIN32_OS_SERVER,
} GWin32OSType;
typedef enum
{
  G_VARIANT_PARSE_ERROR_FAILED,
  G_VARIANT_PARSE_ERROR_BASIC_TYPE_EXPECTED,
  G_VARIANT_PARSE_ERROR_CANNOT_INFER_TYPE,
  G_VARIANT_PARSE_ERROR_DEFINITE_TYPE_EXPECTED,
  G_VARIANT_PARSE_ERROR_INPUT_NOT_AT_END,
  G_VARIANT_PARSE_ERROR_INVALID_CHARACTER,
  G_VARIANT_PARSE_ERROR_INVALID_FORMAT_STRING,
  G_VARIANT_PARSE_ERROR_INVALID_OBJECT_PATH,
  G_VARIANT_PARSE_ERROR_INVALID_SIGNATURE,
  G_VARIANT_PARSE_ERROR_INVALID_TYPE_STRING,
  G_VARIANT_PARSE_ERROR_NO_COMMON_TYPE,
  G_VARIANT_PARSE_ERROR_NUMBER_OUT_OF_RANGE,
  G_VARIANT_PARSE_ERROR_NUMBER_TOO_BIG,
  G_VARIANT_PARSE_ERROR_TYPE_ERROR,
  G_VARIANT_PARSE_ERROR_UNEXPECTED_TOKEN,
  G_VARIANT_PARSE_ERROR_UNKNOWN_KEYWORD,
  G_VARIANT_PARSE_ERROR_UNTERMINATED_STRING_CONSTANT,
  G_VARIANT_PARSE_ERROR_VALUE_EXPECTED
} GVariantParseError;
typedef enum
{
  G_VARIANT_CLASS_BOOLEAN       = 'b',
  G_VARIANT_CLASS_BYTE          = 'y',
  G_VARIANT_CLASS_INT16         = 'n',
  G_VARIANT_CLASS_UINT16        = 'q',
  G_VARIANT_CLASS_INT32         = 'i',
  G_VARIANT_CLASS_UINT32        = 'u',
  G_VARIANT_CLASS_INT64         = 'x',
  G_VARIANT_CLASS_UINT64        = 't',
  G_VARIANT_CLASS_HANDLE        = 'h',
  G_VARIANT_CLASS_DOUBLE        = 'd',
  G_VARIANT_CLASS_STRING        = 's',
  G_VARIANT_CLASS_OBJECT_PATH   = 'o',
  G_VARIANT_CLASS_SIGNATURE     = 'g',
  G_VARIANT_CLASS_VARIANT       = 'v',
  G_VARIANT_CLASS_MAYBE         = 'm',
  G_VARIANT_CLASS_ARRAY         = 'a',
  G_VARIANT_CLASS_TUPLE         = '(',
  G_VARIANT_CLASS_DICT_ENTRY    = '{'
} GVariantClass;
typedef enum
{
  G_FORMAT_SIZE_DEFAULT     = 0,
  G_FORMAT_SIZE_LONG_FORMAT = 1 << 0,
  G_FORMAT_SIZE_IEC_UNITS   = 1 << 1,
  G_FORMAT_SIZE_BITS        = 1 << 2
} GFormatSizeFlags;
typedef enum {
  G_USER_DIRECTORY_DESKTOP,
  G_USER_DIRECTORY_DOCUMENTS,
  G_USER_DIRECTORY_DOWNLOAD,
  G_USER_DIRECTORY_MUSIC,
  G_USER_DIRECTORY_PICTURES,
  G_USER_DIRECTORY_PUBLIC_SHARE,
  G_USER_DIRECTORY_TEMPLATES,
  G_USER_DIRECTORY_VIDEOS,

  G_USER_N_DIRECTORIES
} GUserDirectory;
typedef enum {
  G_NORMALIZE_DEFAULT,
  G_NORMALIZE_NFD = G_NORMALIZE_DEFAULT,
  G_NORMALIZE_DEFAULT_COMPOSE,
  G_NORMALIZE_NFC = G_NORMALIZE_DEFAULT_COMPOSE,
  G_NORMALIZE_ALL,
  G_NORMALIZE_NFKD = G_NORMALIZE_ALL,
  G_NORMALIZE_ALL_COMPOSE,
  G_NORMALIZE_NFKC = G_NORMALIZE_ALL_COMPOSE
} GNormalizeMode;
typedef enum
{                         /* ISO 15924 code */
  G_UNICODE_SCRIPT_INVALID_CODE = -1,
  G_UNICODE_SCRIPT_COMMON       = 0,   /* Zyyy */
  G_UNICODE_SCRIPT_INHERITED,          /* Zinh (Qaai) */
  G_UNICODE_SCRIPT_ARABIC,             /* Arab */
  G_UNICODE_SCRIPT_ARMENIAN,           /* Armn */
  G_UNICODE_SCRIPT_BENGALI,            /* Beng */
  G_UNICODE_SCRIPT_BOPOMOFO,           /* Bopo */
  G_UNICODE_SCRIPT_CHEROKEE,           /* Cher */
  G_UNICODE_SCRIPT_COPTIC,             /* Copt (Qaac) */
  G_UNICODE_SCRIPT_CYRILLIC,           /* Cyrl (Cyrs) */
  G_UNICODE_SCRIPT_DESERET,            /* Dsrt */
  G_UNICODE_SCRIPT_DEVANAGARI,         /* Deva */
  G_UNICODE_SCRIPT_ETHIOPIC,           /* Ethi */
  G_UNICODE_SCRIPT_GEORGIAN,           /* Geor (Geon, Geoa) */
  G_UNICODE_SCRIPT_GOTHIC,             /* Goth */
  G_UNICODE_SCRIPT_GREEK,              /* Grek */
  G_UNICODE_SCRIPT_GUJARATI,           /* Gujr */
  G_UNICODE_SCRIPT_GURMUKHI,           /* Guru */
  G_UNICODE_SCRIPT_HAN,                /* Hani */
  G_UNICODE_SCRIPT_HANGUL,             /* Hang */
  G_UNICODE_SCRIPT_HEBREW,             /* Hebr */
  G_UNICODE_SCRIPT_HIRAGANA,           /* Hira */
  G_UNICODE_SCRIPT_KANNADA,            /* Knda */
  G_UNICODE_SCRIPT_KATAKANA,           /* Kana */
  G_UNICODE_SCRIPT_KHMER,              /* Khmr */
  G_UNICODE_SCRIPT_LAO,                /* Laoo */
  G_UNICODE_SCRIPT_LATIN,              /* Latn (Latf, Latg) */
  G_UNICODE_SCRIPT_MALAYALAM,          /* Mlym */
  G_UNICODE_SCRIPT_MONGOLIAN,          /* Mong */
  G_UNICODE_SCRIPT_MYANMAR,            /* Mymr */
  G_UNICODE_SCRIPT_OGHAM,              /* Ogam */
  G_UNICODE_SCRIPT_OLD_ITALIC,         /* Ital */
  G_UNICODE_SCRIPT_ORIYA,              /* Orya */
  G_UNICODE_SCRIPT_RUNIC,              /* Runr */
  G_UNICODE_SCRIPT_SINHALA,            /* Sinh */
  G_UNICODE_SCRIPT_SYRIAC,             /* Syrc (Syrj, Syrn, Syre) */
  G_UNICODE_SCRIPT_TAMIL,              /* Taml */
  G_UNICODE_SCRIPT_TELUGU,             /* Telu */
  G_UNICODE_SCRIPT_THAANA,             /* Thaa */
  G_UNICODE_SCRIPT_THAI,               /* Thai */
  G_UNICODE_SCRIPT_TIBETAN,            /* Tibt */
  G_UNICODE_SCRIPT_CANADIAN_ABORIGINAL, /* Cans */
  G_UNICODE_SCRIPT_YI,                 /* Yiii */
  G_UNICODE_SCRIPT_TAGALOG,            /* Tglg */
  G_UNICODE_SCRIPT_HANUNOO,            /* Hano */
  G_UNICODE_SCRIPT_BUHID,              /* Buhd */
  G_UNICODE_SCRIPT_TAGBANWA,           /* Tagb */

  /* Unicode-4.0 additions */
  G_UNICODE_SCRIPT_BRAILLE,            /* Brai */
  G_UNICODE_SCRIPT_CYPRIOT,            /* Cprt */
  G_UNICODE_SCRIPT_LIMBU,              /* Limb */
  G_UNICODE_SCRIPT_OSMANYA,            /* Osma */
  G_UNICODE_SCRIPT_SHAVIAN,            /* Shaw */
  G_UNICODE_SCRIPT_LINEAR_B,           /* Linb */
  G_UNICODE_SCRIPT_TAI_LE,             /* Tale */
  G_UNICODE_SCRIPT_UGARITIC,           /* Ugar */

  /* Unicode-4.1 additions */
  G_UNICODE_SCRIPT_NEW_TAI_LUE,        /* Talu */
  G_UNICODE_SCRIPT_BUGINESE,           /* Bugi */
  G_UNICODE_SCRIPT_GLAGOLITIC,         /* Glag */
  G_UNICODE_SCRIPT_TIFINAGH,           /* Tfng */
  G_UNICODE_SCRIPT_SYLOTI_NAGRI,       /* Sylo */
  G_UNICODE_SCRIPT_OLD_PERSIAN,        /* Xpeo */
  G_UNICODE_SCRIPT_KHAROSHTHI,         /* Khar */

  /* Unicode-5.0 additions */
  G_UNICODE_SCRIPT_UNKNOWN,            /* Zzzz */
  G_UNICODE_SCRIPT_BALINESE,           /* Bali */
  G_UNICODE_SCRIPT_CUNEIFORM,          /* Xsux */
  G_UNICODE_SCRIPT_PHOENICIAN,         /* Phnx */
  G_UNICODE_SCRIPT_PHAGS_PA,           /* Phag */
  G_UNICODE_SCRIPT_NKO,                /* Nkoo */

  /* Unicode-5.1 additions */
  G_UNICODE_SCRIPT_KAYAH_LI,           /* Kali */
  G_UNICODE_SCRIPT_LEPCHA,             /* Lepc */
  G_UNICODE_SCRIPT_REJANG,             /* Rjng */
  G_UNICODE_SCRIPT_SUNDANESE,          /* Sund */
  G_UNICODE_SCRIPT_SAURASHTRA,         /* Saur */
  G_UNICODE_SCRIPT_CHAM,               /* Cham */
  G_UNICODE_SCRIPT_OL_CHIKI,           /* Olck */
  G_UNICODE_SCRIPT_VAI,                /* Vaii */
  G_UNICODE_SCRIPT_CARIAN,             /* Cari */
  G_UNICODE_SCRIPT_LYCIAN,             /* Lyci */
  G_UNICODE_SCRIPT_LYDIAN,             /* Lydi */

  /* Unicode-5.2 additions */
  G_UNICODE_SCRIPT_AVESTAN,                /* Avst */
  G_UNICODE_SCRIPT_BAMUM,                  /* Bamu */
  G_UNICODE_SCRIPT_EGYPTIAN_HIEROGLYPHS,   /* Egyp */
  G_UNICODE_SCRIPT_IMPERIAL_ARAMAIC,       /* Armi */
  G_UNICODE_SCRIPT_INSCRIPTIONAL_PAHLAVI,  /* Phli */
  G_UNICODE_SCRIPT_INSCRIPTIONAL_PARTHIAN, /* Prti */
  G_UNICODE_SCRIPT_JAVANESE,               /* Java */
  G_UNICODE_SCRIPT_KAITHI,                 /* Kthi */
  G_UNICODE_SCRIPT_LISU,                   /* Lisu */
  G_UNICODE_SCRIPT_MEETEI_MAYEK,           /* Mtei */
  G_UNICODE_SCRIPT_OLD_SOUTH_ARABIAN,      /* Sarb */
  G_UNICODE_SCRIPT_OLD_TURKIC,             /* Orkh */
  G_UNICODE_SCRIPT_SAMARITAN,              /* Samr */
  G_UNICODE_SCRIPT_TAI_THAM,               /* Lana */
  G_UNICODE_SCRIPT_TAI_VIET,               /* Tavt */

  /* Unicode-6.0 additions */
  G_UNICODE_SCRIPT_BATAK,                  /* Batk */
  G_UNICODE_SCRIPT_BRAHMI,                 /* Brah */
  G_UNICODE_SCRIPT_MANDAIC,                /* Mand */

  /* Unicode-6.1 additions */
  G_UNICODE_SCRIPT_CHAKMA,                 /* Cakm */
  G_UNICODE_SCRIPT_MEROITIC_CURSIVE,       /* Merc */
  G_UNICODE_SCRIPT_MEROITIC_HIEROGLYPHS,   /* Mero */
  G_UNICODE_SCRIPT_MIAO,                   /* Plrd */
  G_UNICODE_SCRIPT_SHARADA,                /* Shrd */
  G_UNICODE_SCRIPT_SORA_SOMPENG,           /* Sora */
  G_UNICODE_SCRIPT_TAKRI,                  /* Takr */

  /* Unicode 7.0 additions */
  G_UNICODE_SCRIPT_BASSA_VAH,              /* Bass */
  G_UNICODE_SCRIPT_CAUCASIAN_ALBANIAN,     /* Aghb */
  G_UNICODE_SCRIPT_DUPLOYAN,               /* Dupl */
  G_UNICODE_SCRIPT_ELBASAN,                /* Elba */
  G_UNICODE_SCRIPT_GRANTHA,                /* Gran */
  G_UNICODE_SCRIPT_KHOJKI,                 /* Khoj */
  G_UNICODE_SCRIPT_KHUDAWADI,              /* Sind */
  G_UNICODE_SCRIPT_LINEAR_A,               /* Lina */
  G_UNICODE_SCRIPT_MAHAJANI,               /* Mahj */
  G_UNICODE_SCRIPT_MANICHAEAN,             /* Manu */
  G_UNICODE_SCRIPT_MENDE_KIKAKUI,          /* Mend */
  G_UNICODE_SCRIPT_MODI,                   /* Modi */
  G_UNICODE_SCRIPT_MRO,                    /* Mroo */
  G_UNICODE_SCRIPT_NABATAEAN,              /* Nbat */
  G_UNICODE_SCRIPT_OLD_NORTH_ARABIAN,      /* Narb */
  G_UNICODE_SCRIPT_OLD_PERMIC,             /* Perm */
  G_UNICODE_SCRIPT_PAHAWH_HMONG,           /* Hmng */
  G_UNICODE_SCRIPT_PALMYRENE,              /* Palm */
  G_UNICODE_SCRIPT_PAU_CIN_HAU,            /* Pauc */
  G_UNICODE_SCRIPT_PSALTER_PAHLAVI,        /* Phlp */
  G_UNICODE_SCRIPT_SIDDHAM,                /* Sidd */
  G_UNICODE_SCRIPT_TIRHUTA,                /* Tirh */
  G_UNICODE_SCRIPT_WARANG_CITI,            /* Wara */

  /* Unicode 8.0 additions */
  G_UNICODE_SCRIPT_AHOM,                   /* Ahom */
  G_UNICODE_SCRIPT_ANATOLIAN_HIEROGLYPHS,  /* Hluw */
  G_UNICODE_SCRIPT_HATRAN,                 /* Hatr */
  G_UNICODE_SCRIPT_MULTANI,                /* Mult */
  G_UNICODE_SCRIPT_OLD_HUNGARIAN,          /* Hung */
  G_UNICODE_SCRIPT_SIGNWRITING,            /* Sgnw */

  /* Unicode 9.0 additions */
  G_UNICODE_SCRIPT_ADLAM,                  /* Adlm */
  G_UNICODE_SCRIPT_BHAIKSUKI,              /* Bhks */
  G_UNICODE_SCRIPT_MARCHEN,                /* Marc */
  G_UNICODE_SCRIPT_NEWA,                   /* Newa */
  G_UNICODE_SCRIPT_OSAGE,                  /* Osge */
  G_UNICODE_SCRIPT_TANGUT,                 /* Tang */

  /* Unicode 10.0 additions */
  G_UNICODE_SCRIPT_MASARAM_GONDI,          /* Gonm */
  G_UNICODE_SCRIPT_NUSHU,                  /* Nshu */
  G_UNICODE_SCRIPT_SOYOMBO,                /* Soyo */
  G_UNICODE_SCRIPT_ZANABAZAR_SQUARE        /* Zanb */
} GUnicodeScript;
typedef enum
{
  G_UNICODE_BREAK_MANDATORY,
  G_UNICODE_BREAK_CARRIAGE_RETURN,
  G_UNICODE_BREAK_LINE_FEED,
  G_UNICODE_BREAK_COMBINING_MARK,
  G_UNICODE_BREAK_SURROGATE,
  G_UNICODE_BREAK_ZERO_WIDTH_SPACE,
  G_UNICODE_BREAK_INSEPARABLE,
  G_UNICODE_BREAK_NON_BREAKING_GLUE,
  G_UNICODE_BREAK_CONTINGENT,
  G_UNICODE_BREAK_SPACE,
  G_UNICODE_BREAK_AFTER,
  G_UNICODE_BREAK_BEFORE,
  G_UNICODE_BREAK_BEFORE_AND_AFTER,
  G_UNICODE_BREAK_HYPHEN,
  G_UNICODE_BREAK_NON_STARTER,
  G_UNICODE_BREAK_OPEN_PUNCTUATION,
  G_UNICODE_BREAK_CLOSE_PUNCTUATION,
  G_UNICODE_BREAK_QUOTATION,
  G_UNICODE_BREAK_EXCLAMATION,
  G_UNICODE_BREAK_IDEOGRAPHIC,
  G_UNICODE_BREAK_NUMERIC,
  G_UNICODE_BREAK_INFIX_SEPARATOR,
  G_UNICODE_BREAK_SYMBOL,
  G_UNICODE_BREAK_ALPHABETIC,
  G_UNICODE_BREAK_PREFIX,
  G_UNICODE_BREAK_POSTFIX,
  G_UNICODE_BREAK_COMPLEX_CONTEXT,
  G_UNICODE_BREAK_AMBIGUOUS,
  G_UNICODE_BREAK_UNKNOWN,
  G_UNICODE_BREAK_NEXT_LINE,
  G_UNICODE_BREAK_WORD_JOINER,
  G_UNICODE_BREAK_HANGUL_L_JAMO,
  G_UNICODE_BREAK_HANGUL_V_JAMO,
  G_UNICODE_BREAK_HANGUL_T_JAMO,
  G_UNICODE_BREAK_HANGUL_LV_SYLLABLE,
  G_UNICODE_BREAK_HANGUL_LVT_SYLLABLE,
  G_UNICODE_BREAK_CLOSE_PARANTHESIS,
  G_UNICODE_BREAK_CONDITIONAL_JAPANESE_STARTER,
  G_UNICODE_BREAK_HEBREW_LETTER,
  G_UNICODE_BREAK_REGIONAL_INDICATOR,
  G_UNICODE_BREAK_EMOJI_BASE,
  G_UNICODE_BREAK_EMOJI_MODIFIER,
  G_UNICODE_BREAK_ZERO_WIDTH_JOINER
} GUnicodeBreakType;
typedef enum
{
  G_UNICODE_CONTROL,
  G_UNICODE_FORMAT,
  G_UNICODE_UNASSIGNED,
  G_UNICODE_PRIVATE_USE,
  G_UNICODE_SURROGATE,
  G_UNICODE_LOWERCASE_LETTER,
  G_UNICODE_MODIFIER_LETTER,
  G_UNICODE_OTHER_LETTER,
  G_UNICODE_TITLECASE_LETTER,
  G_UNICODE_UPPERCASE_LETTER,
  G_UNICODE_SPACING_MARK,
  G_UNICODE_ENCLOSING_MARK,
  G_UNICODE_NON_SPACING_MARK,
  G_UNICODE_DECIMAL_NUMBER,
  G_UNICODE_LETTER_NUMBER,
  G_UNICODE_OTHER_NUMBER,
  G_UNICODE_CONNECT_PUNCTUATION,
  G_UNICODE_DASH_PUNCTUATION,
  G_UNICODE_CLOSE_PUNCTUATION,
  G_UNICODE_FINAL_PUNCTUATION,
  G_UNICODE_INITIAL_PUNCTUATION,
  G_UNICODE_OTHER_PUNCTUATION,
  G_UNICODE_OPEN_PUNCTUATION,
  G_UNICODE_CURRENCY_SYMBOL,
  G_UNICODE_MODIFIER_SYMBOL,
  G_UNICODE_MATH_SYMBOL,
  G_UNICODE_OTHER_SYMBOL,
  G_UNICODE_LINE_SEPARATOR,
  G_UNICODE_PARAGRAPH_SEPARATOR,
  G_UNICODE_SPACE_SEPARATOR
} GUnicodeType;
typedef enum
{
  G_TIME_TYPE_STANDARD,
  G_TIME_TYPE_DAYLIGHT,
  G_TIME_TYPE_UNIVERSAL
} GTimeType;
typedef enum
{
  G_ONCE_STATUS_NOTCALLED,
  G_ONCE_STATUS_PROGRESS,
  G_ONCE_STATUS_READY
} GOnceStatus;
typedef enum
{
  G_THREAD_ERROR_AGAIN /* Resource temporarily unavailable */
} GThreadError;
typedef enum
{
  G_TEST_DIST,
  G_TEST_BUILT
} GTestFileType;
typedef enum {
  G_TEST_LOG_NONE,
  G_TEST_LOG_ERROR,             /* s:msg */
  G_TEST_LOG_START_BINARY,      /* s:binaryname s:seed */
  G_TEST_LOG_LIST_CASE,         /* s:testpath */
  G_TEST_LOG_SKIP_CASE,         /* s:testpath */
  G_TEST_LOG_START_CASE,        /* s:testpath */
  G_TEST_LOG_STOP_CASE,         /* d:status d:nforks d:elapsed */
  G_TEST_LOG_MIN_RESULT,        /* s:blurb d:result */
  G_TEST_LOG_MAX_RESULT,        /* s:blurb d:result */
  G_TEST_LOG_MESSAGE,           /* s:blurb */
  G_TEST_LOG_START_SUITE,
  G_TEST_LOG_STOP_SUITE
} GTestLogType;
typedef enum {
  G_TEST_RUN_SUCCESS,
  G_TEST_RUN_SKIPPED,
  G_TEST_RUN_FAILURE,
  G_TEST_RUN_INCOMPLETE
} GTestResult;
typedef enum {
  G_TEST_SUBPROCESS_INHERIT_STDIN  = 1 << 0,
  G_TEST_SUBPROCESS_INHERIT_STDOUT = 1 << 1,
  G_TEST_SUBPROCESS_INHERIT_STDERR = 1 << 2
} GTestSubprocessFlags;
typedef enum {
  G_TEST_TRAP_SILENCE_STDOUT    = 1 << 7,
  G_TEST_TRAP_SILENCE_STDERR    = 1 << 8,
  G_TEST_TRAP_INHERIT_STDIN     = 1 << 9
} GTestTrapFlags;
typedef enum
  {
    G_NUMBER_PARSER_ERROR_INVALID,
    G_NUMBER_PARSER_ERROR_OUT_OF_BOUNDS,
  } GNumberParserError;
typedef enum {
  G_ASCII_ALNUM  = 1 << 0,
  G_ASCII_ALPHA  = 1 << 1,
  G_ASCII_CNTRL  = 1 << 2,
  G_ASCII_DIGIT  = 1 << 3,
  G_ASCII_GRAPH  = 1 << 4,
  G_ASCII_LOWER  = 1 << 5,
  G_ASCII_PRINT  = 1 << 6,
  G_ASCII_PUNCT  = 1 << 7,
  G_ASCII_SPACE  = 1 << 8,
  G_ASCII_UPPER  = 1 << 9,
  G_ASCII_XDIGIT = 1 << 10
} GAsciiType;
typedef enum
{
  G_SPAWN_DEFAULT                = 0,
  G_SPAWN_LEAVE_DESCRIPTORS_OPEN = 1 << 0,
  G_SPAWN_DO_NOT_REAP_CHILD      = 1 << 1,
  /* look for argv[0] in the path i.e. use execvp() */
  G_SPAWN_SEARCH_PATH            = 1 << 2,
  /* Dump output to /dev/null */
  G_SPAWN_STDOUT_TO_DEV_NULL     = 1 << 3,
  G_SPAWN_STDERR_TO_DEV_NULL     = 1 << 4,
  G_SPAWN_CHILD_INHERITS_STDIN   = 1 << 5,
  G_SPAWN_FILE_AND_ARGV_ZERO     = 1 << 6,
  G_SPAWN_SEARCH_PATH_FROM_ENVP  = 1 << 7,
  G_SPAWN_CLOEXEC_PIPES          = 1 << 8
} GSpawnFlags;
typedef enum
{
  G_SPAWN_ERROR_FORK,   /* fork failed due to lack of memory */
  G_SPAWN_ERROR_READ,   /* read or select on pipes failed */
  G_SPAWN_ERROR_CHDIR,  /* changing to working dir failed */
  G_SPAWN_ERROR_ACCES,  /* execv() returned EACCES */
  G_SPAWN_ERROR_PERM,   /* execv() returned EPERM */
  G_SPAWN_ERROR_TOO_BIG,/* execv() returned E2BIG */
#ifndef G_DISABLE_DEPRECATED
  G_SPAWN_ERROR_2BIG = G_SPAWN_ERROR_TOO_BIG,
#endif
  G_SPAWN_ERROR_NOEXEC, /* execv() returned ENOEXEC */
  G_SPAWN_ERROR_NAMETOOLONG, /* ""  "" ENAMETOOLONG */
  G_SPAWN_ERROR_NOENT,       /* ""  "" ENOENT */
  G_SPAWN_ERROR_NOMEM,       /* ""  "" ENOMEM */
  G_SPAWN_ERROR_NOTDIR,      /* ""  "" ENOTDIR */
  G_SPAWN_ERROR_LOOP,        /* ""  "" ELOOP   */
  G_SPAWN_ERROR_TXTBUSY,     /* ""  "" ETXTBUSY */
  G_SPAWN_ERROR_IO,          /* ""  "" EIO */
  G_SPAWN_ERROR_NFILE,       /* ""  "" ENFILE */
  G_SPAWN_ERROR_MFILE,       /* ""  "" EMFLE */
  G_SPAWN_ERROR_INVAL,       /* ""  "" EINVAL */
  G_SPAWN_ERROR_ISDIR,       /* ""  "" EISDIR */
  G_SPAWN_ERROR_LIBBAD,      /* ""  "" ELIBBAD */
  G_SPAWN_ERROR_FAILED       /* other fatal failure, error->message
                              * should explain
                              */
} GSpawnError;
typedef enum {
  G_SLICE_CONFIG_ALWAYS_MALLOC = 1,
  G_SLICE_CONFIG_BYPASS_MAGAZINES,
  G_SLICE_CONFIG_WORKING_SET_MSECS,
  G_SLICE_CONFIG_COLOR_INCREMENT,
  G_SLICE_CONFIG_CHUNK_SIZES,
  G_SLICE_CONFIG_CONTENTION_COUNTER
} GSliceConfig;
typedef enum
{
  /* mismatched or otherwise mangled quoting */
  G_SHELL_ERROR_BAD_QUOTING,
  /* string to be parsed was empty */
  G_SHELL_ERROR_EMPTY_STRING,
  G_SHELL_ERROR_FAILED
} GShellError;
typedef enum
{
  G_TOKEN_EOF			=   0,
  
  G_TOKEN_LEFT_PAREN		= '(',
  G_TOKEN_RIGHT_PAREN		= ')',
  G_TOKEN_LEFT_CURLY		= '{',
  G_TOKEN_RIGHT_CURLY		= '}',
  G_TOKEN_LEFT_BRACE		= '[',
  G_TOKEN_RIGHT_BRACE		= ']',
  G_TOKEN_EQUAL_SIGN		= '=',
  G_TOKEN_COMMA			= ',',
  
  G_TOKEN_NONE			= 256,
  
  G_TOKEN_ERROR,
  
  G_TOKEN_CHAR,
  G_TOKEN_BINARY,
  G_TOKEN_OCTAL,
  G_TOKEN_INT,
  G_TOKEN_HEX,
  G_TOKEN_FLOAT,
  G_TOKEN_STRING,
  
  G_TOKEN_SYMBOL,
  G_TOKEN_IDENTIFIER,
  G_TOKEN_IDENTIFIER_NULL,
  
  G_TOKEN_COMMENT_SINGLE,
  G_TOKEN_COMMENT_MULTI,

  /*< private >*/
  G_TOKEN_LAST
} GTokenType;
typedef enum
{
  G_ERR_UNKNOWN,
  G_ERR_UNEXP_EOF,
  G_ERR_UNEXP_EOF_IN_STRING,
  G_ERR_UNEXP_EOF_IN_COMMENT,
  G_ERR_NON_DIGIT_IN_CONST,
  G_ERR_DIGIT_RADIX,
  G_ERR_FLOAT_RADIX,
  G_ERR_FLOAT_MALFORMED
} GErrorType;
typedef enum
{
  G_REGEX_MATCH_ANCHORED         = 1 << 4,
  G_REGEX_MATCH_NOTBOL           = 1 << 7,
  G_REGEX_MATCH_NOTEOL           = 1 << 8,
  G_REGEX_MATCH_NOTEMPTY         = 1 << 10,
  G_REGEX_MATCH_PARTIAL          = 1 << 15,
  G_REGEX_MATCH_NEWLINE_CR       = 1 << 20,
  G_REGEX_MATCH_NEWLINE_LF       = 1 << 21,
  G_REGEX_MATCH_NEWLINE_CRLF     = G_REGEX_MATCH_NEWLINE_CR | G_REGEX_MATCH_NEWLINE_LF,
  G_REGEX_MATCH_NEWLINE_ANY      = 1 << 22,
  G_REGEX_MATCH_NEWLINE_ANYCRLF  = G_REGEX_MATCH_NEWLINE_CR | G_REGEX_MATCH_NEWLINE_ANY,
  G_REGEX_MATCH_BSR_ANYCRLF      = 1 << 23,
  G_REGEX_MATCH_BSR_ANY          = 1 << 24,
  G_REGEX_MATCH_PARTIAL_SOFT     = G_REGEX_MATCH_PARTIAL,
  G_REGEX_MATCH_PARTIAL_HARD     = 1 << 27,
  G_REGEX_MATCH_NOTEMPTY_ATSTART = 1 << 28
} GRegexMatchFlags;
typedef enum
{
  G_REGEX_CASELESS          = 1 << 0,
  G_REGEX_MULTILINE         = 1 << 1,
  G_REGEX_DOTALL            = 1 << 2,
  G_REGEX_EXTENDED          = 1 << 3,
  G_REGEX_ANCHORED          = 1 << 4,
  G_REGEX_DOLLAR_ENDONLY    = 1 << 5,
  G_REGEX_UNGREEDY          = 1 << 9,
  G_REGEX_RAW               = 1 << 11,
  G_REGEX_NO_AUTO_CAPTURE   = 1 << 12,
  G_REGEX_OPTIMIZE          = 1 << 13,
  G_REGEX_FIRSTLINE         = 1 << 18,
  G_REGEX_DUPNAMES          = 1 << 19,
  G_REGEX_NEWLINE_CR        = 1 << 20,
  G_REGEX_NEWLINE_LF        = 1 << 21,
  G_REGEX_NEWLINE_CRLF      = G_REGEX_NEWLINE_CR | G_REGEX_NEWLINE_LF,
  G_REGEX_NEWLINE_ANYCRLF   = G_REGEX_NEWLINE_CR | 1 << 22,
  G_REGEX_BSR_ANYCRLF       = 1 << 23,
  G_REGEX_JAVASCRIPT_COMPAT = 1 << 25
} GRegexCompileFlags;
typedef enum
{
  G_REGEX_ERROR_COMPILE,
  G_REGEX_ERROR_OPTIMIZE,
  G_REGEX_ERROR_REPLACE,
  G_REGEX_ERROR_MATCH,
  G_REGEX_ERROR_INTERNAL,

  /* These are the error codes from PCRE + 100 */
  G_REGEX_ERROR_STRAY_BACKSLASH = 101,
  G_REGEX_ERROR_MISSING_CONTROL_CHAR = 102,
  G_REGEX_ERROR_UNRECOGNIZED_ESCAPE = 103,
  G_REGEX_ERROR_QUANTIFIERS_OUT_OF_ORDER = 104,
  G_REGEX_ERROR_QUANTIFIER_TOO_BIG = 105,
  G_REGEX_ERROR_UNTERMINATED_CHARACTER_CLASS = 106,
  G_REGEX_ERROR_INVALID_ESCAPE_IN_CHARACTER_CLASS = 107,
  G_REGEX_ERROR_RANGE_OUT_OF_ORDER = 108,
  G_REGEX_ERROR_NOTHING_TO_REPEAT = 109,
  G_REGEX_ERROR_UNRECOGNIZED_CHARACTER = 112,
  G_REGEX_ERROR_POSIX_NAMED_CLASS_OUTSIDE_CLASS = 113,
  G_REGEX_ERROR_UNMATCHED_PARENTHESIS = 114,
  G_REGEX_ERROR_INEXISTENT_SUBPATTERN_REFERENCE = 115,
  G_REGEX_ERROR_UNTERMINATED_COMMENT = 118,
  G_REGEX_ERROR_EXPRESSION_TOO_LARGE = 120,
  G_REGEX_ERROR_MEMORY_ERROR = 121,
  G_REGEX_ERROR_VARIABLE_LENGTH_LOOKBEHIND = 125,
  G_REGEX_ERROR_MALFORMED_CONDITION = 126,
  G_REGEX_ERROR_TOO_MANY_CONDITIONAL_BRANCHES = 127,
  G_REGEX_ERROR_ASSERTION_EXPECTED = 128,
  G_REGEX_ERROR_UNKNOWN_POSIX_CLASS_NAME = 130,
  G_REGEX_ERROR_POSIX_COLLATING_ELEMENTS_NOT_SUPPORTED = 131,
  G_REGEX_ERROR_HEX_CODE_TOO_LARGE = 134,
  G_REGEX_ERROR_INVALID_CONDITION = 135,
  G_REGEX_ERROR_SINGLE_BYTE_MATCH_IN_LOOKBEHIND = 136,
  G_REGEX_ERROR_INFINITE_LOOP = 140,
  G_REGEX_ERROR_MISSING_SUBPATTERN_NAME_TERMINATOR = 142,
  G_REGEX_ERROR_DUPLICATE_SUBPATTERN_NAME = 143,
  G_REGEX_ERROR_MALFORMED_PROPERTY = 146,
  G_REGEX_ERROR_UNKNOWN_PROPERTY = 147,
  G_REGEX_ERROR_SUBPATTERN_NAME_TOO_LONG = 148,
  G_REGEX_ERROR_TOO_MANY_SUBPATTERNS = 149,
  G_REGEX_ERROR_INVALID_OCTAL_VALUE = 151,
  G_REGEX_ERROR_TOO_MANY_BRANCHES_IN_DEFINE = 154,
  G_REGEX_ERROR_DEFINE_REPETION = 155,
  G_REGEX_ERROR_INCONSISTENT_NEWLINE_OPTIONS = 156,
  G_REGEX_ERROR_MISSING_BACK_REFERENCE = 157,
  G_REGEX_ERROR_INVALID_RELATIVE_REFERENCE = 158,
  G_REGEX_ERROR_BACKTRACKING_CONTROL_VERB_ARGUMENT_FORBIDDEN = 159,
  G_REGEX_ERROR_UNKNOWN_BACKTRACKING_CONTROL_VERB  = 160,
  G_REGEX_ERROR_NUMBER_TOO_BIG = 161,
  G_REGEX_ERROR_MISSING_SUBPATTERN_NAME = 162,
  G_REGEX_ERROR_MISSING_DIGIT = 163,
  G_REGEX_ERROR_INVALID_DATA_CHARACTER = 164,
  G_REGEX_ERROR_EXTRA_SUBPATTERN_NAME = 165,
  G_REGEX_ERROR_BACKTRACKING_CONTROL_VERB_ARGUMENT_REQUIRED = 166,
  G_REGEX_ERROR_INVALID_CONTROL_CHAR = 168,
  G_REGEX_ERROR_MISSING_NAME = 169,
  G_REGEX_ERROR_NOT_SUPPORTED_IN_CLASS = 171,
  G_REGEX_ERROR_TOO_MANY_FORWARD_REFERENCES = 172,
  G_REGEX_ERROR_NAME_TOO_LONG = 175,
  G_REGEX_ERROR_CHARACTER_VALUE_TOO_LARGE = 176
} GRegexError;
typedef enum
{
  G_OPTION_ERROR_UNKNOWN_OPTION,
  G_OPTION_ERROR_BAD_VALUE,
  G_OPTION_ERROR_FAILED
} GOptionError;
typedef enum
{
  G_OPTION_ARG_NONE,
  G_OPTION_ARG_STRING,
  G_OPTION_ARG_INT,
  G_OPTION_ARG_CALLBACK,
  G_OPTION_ARG_FILENAME,
  G_OPTION_ARG_STRING_ARRAY,
  G_OPTION_ARG_FILENAME_ARRAY,
  G_OPTION_ARG_DOUBLE,
  G_OPTION_ARG_INT64
} GOptionArg;
typedef enum
{
  G_OPTION_FLAG_NONE            = 0,
  G_OPTION_FLAG_HIDDEN		= 1 << 0,
  G_OPTION_FLAG_IN_MAIN		= 1 << 1,
  G_OPTION_FLAG_REVERSE		= 1 << 2,
  G_OPTION_FLAG_NO_ARG		= 1 << 3,
  G_OPTION_FLAG_FILENAME	= 1 << 4,
  G_OPTION_FLAG_OPTIONAL_ARG    = 1 << 5,
  G_OPTION_FLAG_NOALIAS	        = 1 << 6
} GOptionFlags;
typedef enum
{
  G_IN_ORDER,
  G_PRE_ORDER,
  G_POST_ORDER,
  G_LEVEL_ORDER
} GTraverseType;
typedef enum
{
  G_TRAVERSE_LEAVES     = 1 << 0,
  G_TRAVERSE_NON_LEAVES = 1 << 1,
  G_TRAVERSE_ALL        = G_TRAVERSE_LEAVES | G_TRAVERSE_NON_LEAVES,
  G_TRAVERSE_MASK       = 0x03,
  G_TRAVERSE_LEAFS      = G_TRAVERSE_LEAVES,
  G_TRAVERSE_NON_LEAFS  = G_TRAVERSE_NON_LEAVES
} GTraverseFlags;
typedef enum
{
  G_LOG_WRITER_HANDLED = 1,
  G_LOG_WRITER_UNHANDLED = 0,
} GLogWriterOutput;
typedef enum
{
  /* log flags */
  G_LOG_FLAG_RECURSION          = 1 << 0,
  G_LOG_FLAG_FATAL              = 1 << 1,

  /* GLib log levels */
  G_LOG_LEVEL_ERROR             = 1 << 2,       /* always fatal */
  G_LOG_LEVEL_CRITICAL          = 1 << 3,
  G_LOG_LEVEL_WARNING           = 1 << 4,
  G_LOG_LEVEL_MESSAGE           = 1 << 5,
  G_LOG_LEVEL_INFO              = 1 << 6,
  G_LOG_LEVEL_DEBUG             = 1 << 7,

  G_LOG_LEVEL_MASK              = ~(G_LOG_FLAG_RECURSION | G_LOG_FLAG_FATAL)
} GLogLevelFlags;
typedef enum
{
  G_MARKUP_COLLECT_INVALID,
  G_MARKUP_COLLECT_STRING,
  G_MARKUP_COLLECT_STRDUP,
  G_MARKUP_COLLECT_BOOLEAN,
  G_MARKUP_COLLECT_TRISTATE,

  G_MARKUP_COLLECT_OPTIONAL = (1 << 16)
} GMarkupCollectType;
typedef enum
{
  G_MARKUP_DO_NOT_USE_THIS_UNSUPPORTED_FLAG = 1 << 0,
  G_MARKUP_TREAT_CDATA_AS_TEXT              = 1 << 1,
  G_MARKUP_PREFIX_ERROR_POSITION            = 1 << 2,
  G_MARKUP_IGNORE_QUALIFIED                 = 1 << 3
} GMarkupParseFlags;
typedef enum
{
  G_MARKUP_ERROR_BAD_UTF8,
  G_MARKUP_ERROR_EMPTY,
  G_MARKUP_ERROR_PARSE,
  /* The following are primarily intended for specific GMarkupParser
   * implementations to set.
   */
  G_MARKUP_ERROR_UNKNOWN_ELEMENT,
  G_MARKUP_ERROR_UNKNOWN_ATTRIBUTE,
  G_MARKUP_ERROR_INVALID_CONTENT,
  G_MARKUP_ERROR_MISSING_ATTRIBUTE
} GMarkupError;
typedef enum /*< flags >*/
{
  G_IO_IN	GLIB_SYSDEF_POLLIN,
  G_IO_OUT	GLIB_SYSDEF_POLLOUT,
  G_IO_PRI	GLIB_SYSDEF_POLLPRI,
  G_IO_ERR	GLIB_SYSDEF_POLLERR,
  G_IO_HUP	GLIB_SYSDEF_POLLHUP,
  G_IO_NVAL	GLIB_SYSDEF_POLLNVAL
} GIOCondition;
typedef enum
{
  G_KEY_FILE_NONE              = 0,
  G_KEY_FILE_KEEP_COMMENTS     = 1 << 0,
  G_KEY_FILE_KEEP_TRANSLATIONS = 1 << 1
} GKeyFileFlags;
typedef enum
{
  G_KEY_FILE_ERROR_UNKNOWN_ENCODING,
  G_KEY_FILE_ERROR_PARSE,
  G_KEY_FILE_ERROR_NOT_FOUND,
  G_KEY_FILE_ERROR_KEY_NOT_FOUND,
  G_KEY_FILE_ERROR_GROUP_NOT_FOUND,
  G_KEY_FILE_ERROR_INVALID_VALUE
} GKeyFileError;
typedef enum
{
  G_IO_FLAG_APPEND = 1 << 0,
  G_IO_FLAG_NONBLOCK = 1 << 1,
  G_IO_FLAG_IS_READABLE = 1 << 2,	/* Read only flag */
  G_IO_FLAG_IS_WRITABLE = 1 << 3,	/* Read only flag */
  G_IO_FLAG_IS_WRITEABLE = 1 << 3,      /* Misspelling in 2.29.10 and earlier */
  G_IO_FLAG_IS_SEEKABLE = 1 << 4,	/* Read only flag */
  G_IO_FLAG_MASK = (1 << 5) - 1,
  G_IO_FLAG_GET_MASK = G_IO_FLAG_MASK,
  G_IO_FLAG_SET_MASK = G_IO_FLAG_APPEND | G_IO_FLAG_NONBLOCK
} GIOFlags;
typedef enum
{
  G_SEEK_CUR,
  G_SEEK_SET,
  G_SEEK_END
} GSeekType;
typedef enum
{
  G_IO_STATUS_ERROR,
  G_IO_STATUS_NORMAL,
  G_IO_STATUS_EOF,
  G_IO_STATUS_AGAIN
} GIOStatus;
typedef enum
{
  /* Derived from errno */
  G_IO_CHANNEL_ERROR_FBIG,
  G_IO_CHANNEL_ERROR_INVAL,
  G_IO_CHANNEL_ERROR_IO,
  G_IO_CHANNEL_ERROR_ISDIR,
  G_IO_CHANNEL_ERROR_NOSPC,
  G_IO_CHANNEL_ERROR_NXIO,
  G_IO_CHANNEL_ERROR_OVERFLOW,
  G_IO_CHANNEL_ERROR_PIPE,
  /* Other */
  G_IO_CHANNEL_ERROR_FAILED
} GIOChannelError;
typedef enum
{
  G_IO_ERROR_NONE,
  G_IO_ERROR_AGAIN,
  G_IO_ERROR_INVAL,
  G_IO_ERROR_UNKNOWN
} GIOError;
typedef enum
{
  G_HOOK_FLAG_ACTIVE	    = 1 << 0,
  G_HOOK_FLAG_IN_CALL	    = 1 << 1,
  G_HOOK_FLAG_MASK	    = 0x0f
} GHookFlagMask;
typedef enum
{
  G_FILE_TEST_IS_REGULAR    = 1 << 0,
  G_FILE_TEST_IS_SYMLINK    = 1 << 1,
  G_FILE_TEST_IS_DIR        = 1 << 2,
  G_FILE_TEST_IS_EXECUTABLE = 1 << 3,
  G_FILE_TEST_EXISTS        = 1 << 4
} GFileTest;
typedef enum
{
  G_FILE_ERROR_EXIST,
  G_FILE_ERROR_ISDIR,
  G_FILE_ERROR_ACCES,
  G_FILE_ERROR_NAMETOOLONG,
  G_FILE_ERROR_NOENT,
  G_FILE_ERROR_NOTDIR,
  G_FILE_ERROR_NXIO,
  G_FILE_ERROR_NODEV,
  G_FILE_ERROR_ROFS,
  G_FILE_ERROR_TXTBSY,
  G_FILE_ERROR_FAULT,
  G_FILE_ERROR_LOOP,
  G_FILE_ERROR_NOSPC,
  G_FILE_ERROR_NOMEM,
  G_FILE_ERROR_MFILE,
  G_FILE_ERROR_NFILE,
  G_FILE_ERROR_BADF,
  G_FILE_ERROR_INVAL,
  G_FILE_ERROR_PIPE,
  G_FILE_ERROR_AGAIN,
  G_FILE_ERROR_INTR,
  G_FILE_ERROR_IO,
  G_FILE_ERROR_PERM,
  G_FILE_ERROR_NOSYS,
  G_FILE_ERROR_FAILED
} GFileError;
typedef enum
{
  G_DATE_BAD_MONTH = 0,
  G_DATE_JANUARY   = 1,
  G_DATE_FEBRUARY  = 2,
  G_DATE_MARCH     = 3,
  G_DATE_APRIL     = 4,
  G_DATE_MAY       = 5,
  G_DATE_JUNE      = 6,
  G_DATE_JULY      = 7,
  G_DATE_AUGUST    = 8,
  G_DATE_SEPTEMBER = 9,
  G_DATE_OCTOBER   = 10,
  G_DATE_NOVEMBER  = 11,
  G_DATE_DECEMBER  = 12
} GDateMonth;
typedef enum
{
  G_DATE_BAD_WEEKDAY  = 0,
  G_DATE_MONDAY       = 1,
  G_DATE_TUESDAY      = 2,
  G_DATE_WEDNESDAY    = 3,
  G_DATE_THURSDAY     = 4,
  G_DATE_FRIDAY       = 5,
  G_DATE_SATURDAY     = 6,
  G_DATE_SUNDAY       = 7
} GDateWeekday;
typedef enum
{
  G_DATE_DAY   = 0,
  G_DATE_MONTH = 1,
  G_DATE_YEAR  = 2
} GDateDMY;
typedef enum
{
  G_CONVERT_ERROR_NO_CONVERSION,
  G_CONVERT_ERROR_ILLEGAL_SEQUENCE,
  G_CONVERT_ERROR_FAILED,
  G_CONVERT_ERROR_PARTIAL_INPUT,
  G_CONVERT_ERROR_BAD_URI,
  G_CONVERT_ERROR_NOT_ABSOLUTE_PATH,
  G_CONVERT_ERROR_NO_MEMORY,
  G_CONVERT_ERROR_EMBEDDED_NUL
} GConvertError;
typedef enum {
  G_CHECKSUM_MD5,
  G_CHECKSUM_SHA1,
  G_CHECKSUM_SHA256,
  G_CHECKSUM_SHA512,
  G_CHECKSUM_SHA384
} GChecksumType;
typedef enum
{
  G_BOOKMARK_FILE_ERROR_INVALID_URI,
  G_BOOKMARK_FILE_ERROR_INVALID_VALUE,
  G_BOOKMARK_FILE_ERROR_APP_NOT_REGISTERED,
  G_BOOKMARK_FILE_ERROR_URI_NOT_FOUND,
  G_BOOKMARK_FILE_ERROR_READ,
  G_BOOKMARK_FILE_ERROR_UNKNOWN_ENCODING,
  G_BOOKMARK_FILE_ERROR_WRITE,
  G_BOOKMARK_FILE_ERROR_FILE_NOT_FOUND
} GBookmarkFileError;
union _GFloatIEEE754
{
  gfloat v_float;
  struct {
    guint mantissa : 23;
    guint biased_exponent : 8;
    guint sign : 1;
  } mpn;
};
union _GDoubleIEEE754
{
  gdouble v_double;
  struct {
    guint mantissa_low : 32;
    guint mantissa_high : 20;
    guint biased_exponent : 11;
    guint sign : 1;
  } mpn;
};
union _GMutex
{
  /*< private >*/
  gpointer p;
  guint i[2];
};
union	_GTokenValue
{
  gpointer	v_symbol;
  gchar		*v_identifier;
  gulong	v_binary;
  gulong	v_octal;
  gulong	v_int;
  guint64       v_int64;
  gdouble	v_float;
  gulong	v_hex;
  gchar		*v_string;
  gchar		*v_comment;
  guchar	v_char;
  guint		v_error;
};
typedef void (*GModuleUnload) (GModule	*module);
typedef const gchar * (*GModuleCheckInit) (GModule	*module);
typedef guint64 (*g_thread_gettime) (void);
typedef gint (*GCompletionStrncmpFunc) (const gchar *s1,
                                        const gchar *s2,
                                        gsize        n);
typedef gchar * (*GCompletionFunc) (gpointer);
typedef void (*GCacheDestroyFunc) (gpointer       value);
typedef gpointer (*GCacheDupFunc) (gpointer       value);
typedef gpointer (*GCacheNewFunc) (gpointer       key);
typedef void (*GVoidFunc) (void);
typedef const gchar * (*GTranslateFunc) (const gchar   *str,
						 gpointer       data);
typedef void (*GFreeFunc) (gpointer       data);
typedef void (*GHFunc) (gpointer       key,
                                                 gpointer       value,
                                                 gpointer       user_data);
typedef guint (*GHashFunc) (gconstpointer  key);
typedef void (*GFunc) (gpointer       data,
                                                 gpointer       user_data);
typedef void (*GDestroyNotify) (gpointer       data);
typedef gboolean (*GEqualFunc) (gconstpointer  a,
                                                 gconstpointer  b);
typedef gint (*GCompareDataFunc) (gconstpointer  a,
                                                 gconstpointer  b,
						 gpointer       user_data);
typedef gint (*GCompareFunc) (gconstpointer  a,
                                                 gconstpointer  b);
typedef gboolean (*GTraverseFunc) (gpointer  key,
                                   gpointer  value,
                                   gpointer  data);
typedef gpointer (*GThreadFunc) (gpointer data);
typedef gboolean (*GTestLogFatalFunc) (const gchar    *log_domain,
                                                 GLogLevelFlags  log_level,
                                                 const gchar    *message,
                                                 gpointer        user_data);
typedef void (*GTestFixtureFunc) (gpointer      fixture,
                                  gconstpointer user_data);
typedef void (*GTestDataFunc) (gconstpointer user_data);
typedef void (*GTestFunc) (void);
typedef void (*GSpawnChildSetupFunc) (gpointer user_data);
typedef gint (*GSequenceIterCompareFunc) (GSequenceIter *a,
                                           GSequenceIter *b,
                                           gpointer       data);
typedef void (*GScannerMsgFunc) (GScanner      *scanner,
						 gchar	       *message,
						 gboolean	error);
typedef gboolean (*GRegexEvalCallback) (const GMatchInfo *match_info,
						 GString          *result,
						 gpointer          user_data);
typedef gint (*GPollFunc) (GPollFD *ufds,
                                 guint    nfsd,
                                 gint     timeout_);
typedef void (*GOptionErrorFunc) (GOptionContext *context,
				  GOptionGroup   *group,
				  gpointer        data,
				  GError        **error);
typedef gboolean (*GOptionParseFunc) (GOptionContext *context,
				      GOptionGroup   *group,
				      gpointer	      data,
				      GError        **error);
typedef gboolean (*GOptionArgFunc) (const gchar    *option_name,
				    const gchar    *value,
				    gpointer        data,
				    GError        **error);
typedef gpointer (*GCopyFunc) (gconstpointer  src,
                                                 gpointer       data);
typedef void (*GNodeForeachFunc) (GNode	       *node,
						 gpointer	data);
typedef gboolean (*GNodeTraverseFunc) (GNode	       *node,
						 gpointer	data);
typedef void (*GPrintFunc) (const gchar    *string);
typedef GLogWriterOutput (*GLogWriterFunc) (GLogLevelFlags   log_level,
                                                const GLogField *fields,
                                                gsize            n_fields,
                                                gpointer         user_data);
typedef void (*GLogFunc) (const gchar   *log_domain,
                                                 GLogLevelFlags log_level,
                                                 const gchar   *message,
                                                 gpointer       user_data);
typedef void (*GClearHandleFunc) (guint handle_id);
typedef void (*GSourceDummyMarshal) (void);
typedef void (*GChildWatchFunc) (GPid     pid,
                                       gint     status,
                                       gpointer user_data);
typedef gboolean (*GSourceFunc) (gpointer user_data);
typedef gboolean (*GUnixFDSourceFunc) (gint         fd,
                                       GIOCondition condition,
                                       gpointer     user_data);
typedef gboolean (*GIOFunc) (GIOChannel   *source,
			     GIOCondition  condition,
			     gpointer      data);
typedef void (*GHookFinalizeFunc) (GHookList      *hook_list,
						 GHook          *hook);
typedef gboolean (*GHookCheckFunc) (gpointer	 data);
typedef void (*GHookFunc) (gpointer	 data);
typedef gboolean (*GHookCheckMarshaller) (GHook		*hook,
						 gpointer	 marshal_data);
typedef void (*GHookMarshaller) (GHook		*hook,
						 gpointer	 marshal_data);
typedef gboolean (*GHookFindFunc) (GHook		*hook,
						 gpointer	 data);
typedef gint (*GHookCompareFunc) (GHook		*new_hook,
						 GHook		*sibling);
typedef gboolean (*GHRFunc) (gpointer  key,
                               gpointer  value,
                               gpointer  user_data);
typedef gpointer (*GDuplicateFunc) (gpointer data, gpointer user_data);
typedef void (*GDataForeachFunc) (GQuark         key_id,
                                                 gpointer       data,
                                                 gpointer       user_data);

struct _GStaticPrivate
{
  /*< private >*/
  guint index;
};
struct _GStaticRWLock
{
  /*< private >*/
  GStaticMutex mutex;
  GCond *read_cond;
  GCond *write_cond;
  guint read_counter;
  gboolean have_writer;
  guint want_to_read;
  guint want_to_write;
};
struct _GStaticRecMutex
{
  /*< private >*/
  GStaticMutex mutex;
  guint depth;

  /* ABI compat only */
  union {
#ifdef G_OS_WIN32
    void *owner;
#else
    pthread_t owner;
#endif
    gdouble dummy;
  } unused;
};
struct _GThreadFunctions
{
  GMutex*  (*mutex_new)           (void);
  void     (*mutex_lock)          (GMutex               *mutex);
  gboolean (*mutex_trylock)       (GMutex               *mutex);
  void     (*mutex_unlock)        (GMutex               *mutex);
  void     (*mutex_free)          (GMutex               *mutex);
  GCond*   (*cond_new)            (void);
  void     (*cond_signal)         (GCond                *cond);
  void     (*cond_broadcast)      (GCond                *cond);
  void     (*cond_wait)           (GCond                *cond,
                                   GMutex               *mutex);
  gboolean (*cond_timed_wait)     (GCond                *cond,
                                   GMutex               *mutex,
                                   GTimeVal             *end_time);
  void      (*cond_free)          (GCond                *cond);
  GPrivate* (*private_new)        (GDestroyNotify        destructor);
  gpointer  (*private_get)        (GPrivate             *private_key);
  void      (*private_set)        (GPrivate             *private_key,
                                   gpointer              data);
  void      (*thread_create)      (GThreadFunc           func,
                                   gpointer              data,
                                   gulong                stack_size,
                                   gboolean              joinable,
                                   gboolean              bound,
                                   GThreadPriority       priority,
                                   gpointer              thread,
                                   GError              **error);
  void      (*thread_yield)       (void);
  void      (*thread_join)        (gpointer              thread);
  void      (*thread_exit)        (void);
  void      (*thread_set_priority)(gpointer              thread,
                                   GThreadPriority       priority);
  void      (*thread_self)        (gpointer              thread);
  gboolean  (*thread_equal)       (gpointer              thread1,
                                   gpointer              thread2);
};
struct  _GThread
{
  /*< private >*/
  GThreadFunc func;
  gpointer data;
  gboolean joinable;
  GThreadPriority priority;
};

struct _GTuples
{
  guint len;
};
struct _GCompletion
{
  GList* items;
  GCompletionFunc func;
 
  gchar* prefix;
  GList* cache;
  GCompletionStrncmpFunc strncmp_func;
};



struct _GVariantDict {
  /*< private >*/
  union
  {
    struct {
      GVariant *asv;
      gsize partial_magic;
      gsize y[14];
    } s;
    gsize x[16];
  } u;
};
struct _GVariantBuilder {
  /*< private >*/
  union
  {
    struct {
      gsize partial_magic;
      const GVariantType *type;
      gsize y[14];
    } s;
    gsize x[16];
  } u;
};
struct _GVariantIter {
  /*< private >*/
  gsize x[16];
};
struct _GDebugKey
{
  const gchar *key;
  guint	       value;
};
struct _GTimeVal
{
  glong tv_sec;
  glong tv_usec;
};

struct _GTrashStack
{
  GTrashStack *next;
};


struct _GThreadPool
{
  GFunc func;
  gpointer user_data;
  gboolean exclusive;
};
struct _GOnce
{
  volatile GOnceStatus status;
  volatile gpointer retval;
};
struct _GPrivate
{
  /*< private >*/
  gpointer       p;
  GDestroyNotify notify;
  gpointer future[2];
};
struct _GRecMutex
{
  /*< private >*/
  gpointer p;
  guint i[2];
};
struct _GCond
{
  /*< private >*/
  gpointer p;
  guint i[2];
};
struct _GRWLock
{
  /*< private >*/
  gpointer p;
  guint i[2];
};
typedef struct {
  /*< private >*/
  GString     *data;
  GSList      *msgs;
} GTestLogBuffer;
typedef struct {
  GTestLogType  log_type;
  guint         n_strings;
  gchar       **strings; /* NULL terminated */
  guint         n_nums;
  long double  *nums;
} GTestLogMsg;
typedef struct {
  gboolean      test_initialized;
  gboolean      test_quick;     /* disable thorough tests */
  gboolean      test_perf;      /* run performance tests */
  gboolean      test_verbose;   /* extra info */
  gboolean      test_quiet;     /* reduce output */
  gboolean      test_undefined; /* run tests that are meant to assert */
} GTestConfig;

struct _GString
{
  gchar  *str;
  gsize len;
  gsize allocated_len;
};
struct _GWin32PrivateStat
{
  guint32 volume_serial;
  guint64 file_index;
  guint64 attributes;
  guint64 allocated_size;
  guint32 reparse_tag;

  guint32 st_dev;
  guint32 st_ino;
  guint16 st_mode;
  guint16 st_uid;
  guint16 st_gid;
  guint32 st_nlink;
  guint64 st_size;
  guint64 st_ctime;
  guint64 st_atime;
  guint64 st_mtime;
};
struct utimbuf;			/* Don't need the real definition of struct utimbuf when just*/
struct _GSList
{
  gpointer data;
  GSList *next;
};

struct	_GScanner
{
  /* unused fields */
  gpointer		user_data;
  guint			max_parse_errors;
  
  /* g_scanner_error() increments this field */
  guint			parse_errors;
  
  /* name of input stream, featured by the default message handler */
  const gchar		*input_name;
  
  /* quarked data */
  GData			*qdata;
  
  /* link into the scanner configuration */
  GScannerConfig	*config;
  
  /* fields filled in after g_scanner_get_next_token() */
  GTokenType		token;
  GTokenValue		value;
  guint			line;
  guint			position;
  
  /* fields filled in after g_scanner_peek_next_token() */
  GTokenType		next_token;
  GTokenValue		next_value;
  guint			next_line;
  guint			next_position;

  /*< private >*/
  /* to be considered private */
  GHashTable		*symbol_table;
  gint			input_fd;
  const gchar		*text;
  const gchar		*text_end;
  gchar			*buffer;
  guint			scope_id;

  /*< public >*/
  /* handler function for _warn and _error */
  GScannerMsgFunc	msg_handler;
};
struct	_GScannerConfig
{
  /* Character sets
   */
  gchar		*cset_skip_characters;		/* default: " \t\n" */
  gchar		*cset_identifier_first;
  gchar		*cset_identifier_nth;
  gchar		*cpair_comment_single;		/* default: "#\n" */
  
  /* Should symbol lookup work case sensitive?
   */
  guint		case_sensitive : 1;
  
  /* Boolean values to be adjusted "on the fly"
   * to configure scanning behaviour.
   */
  guint		skip_comment_multi : 1;		/* C like comment */
  guint		skip_comment_single : 1;	/* single line comment */
  guint		scan_comment_multi : 1;		/* scan multi line comments? */
  guint		scan_identifier : 1;
  guint		scan_identifier_1char : 1;
  guint		scan_identifier_NULL : 1;
  guint		scan_symbols : 1;
  guint		scan_binary : 1;
  guint		scan_octal : 1;
  guint		scan_float : 1;
  guint		scan_hex : 1;			/* '0x0ff0' */
  guint		scan_hex_dollar : 1;		/* '$0ff0' */
  guint		scan_string_sq : 1;		/* string: 'anything' */
  guint		scan_string_dq : 1;		/* string: "\\-escapes!\n" */
  guint		numbers_2_int : 1;		/* bin, octal, hex => int */
  guint		int_2_float : 1;		/* int => G_TOKEN_FLOAT? */
  guint		identifier_2_string : 1;
  guint		char_2_token : 1;		/* return G_TOKEN_CHAR? */
  guint		symbol_2_token : 1;
  guint		scope_0_fallback : 1;		/* try scope 0 on lookups? */
  guint		store_int64 : 1; 		/* use value.v_int64 rather than v_int */

  /*< private >*/
  guint		padding_dummy;
};



struct _GQueue
{
  GList *head;
  GList *tail;
  guint  length;
};
struct _GPollFD
{
#if defined (G_OS_WIN32) && GLIB_SIZEOF_VOID_P == 8
#endif
#else
  gint		fd;
#endif
  gushort 	events;
  gushort 	revents;
};



struct _GOptionEntry
{
  const gchar *long_name;
  gchar        short_name;
  gint         flags;

  GOptionArg   arg;
  gpointer     arg_data;
  
  const gchar *description;
  const gchar *arg_description;
};
struct _GNode
{
  gpointer data;
  GNode	  *next;
  GNode	  *prev;
  GNode	  *parent;
  GNode	  *children;
};
struct _GLogField
{
  const gchar *key;
  gconstpointer value;
  gssize length;
};
struct _GMemVTable {
  gpointer (*malloc)      (gsize    n_bytes);
  gpointer (*realloc)     (gpointer mem,
			   gsize    n_bytes);
  void     (*free)        (gpointer mem);
  /* optional; set to NULL if not used ! */
  gpointer (*calloc)      (gsize    n_blocks,
			   gsize    n_block_bytes);
  gpointer (*try_malloc)  (gsize    n_bytes);
  gpointer (*try_realloc) (gpointer mem,
			   gsize    n_bytes);
};

struct _GMarkupParser
{
  /* Called for open tags <foo bar="baz"> */
  void (*start_element)  (GMarkupParseContext *context,
                          const gchar         *element_name,
                          const gchar        **attribute_names,
                          const gchar        **attribute_values,
                          gpointer             user_data,
                          GError             **error);

  /* Called for close tags </foo> */
  void (*end_element)    (GMarkupParseContext *context,
                          const gchar         *element_name,
                          gpointer             user_data,
                          GError             **error);

  /* Called for character data */
  /* text is not nul-terminated */
  void (*text)           (GMarkupParseContext *context,
                          const gchar         *text,
                          gsize                text_len,
                          gpointer             user_data,
                          GError             **error);

  /* Called for strings that should be re-saved verbatim in this same
   * position, but are not otherwise interpretable.  At the moment
   * this includes comments and processing instructions.
   */
  /* text is not nul-terminated. */
  void (*passthrough)    (GMarkupParseContext *context,
                          const gchar         *passthrough_text,
                          gsize                text_len,
                          gpointer             user_data,
                          GError             **error);

  /* Called on error, including one set by other
   * methods in the vtable. The GError should not be freed.
   */
  void (*error)          (GMarkupParseContext *context,
                          GError              *error,
                          gpointer             user_data);
};




struct _GSourceFuncs
{
  gboolean (*prepare)  (GSource    *source,
                        gint       *timeout_);
  gboolean (*check)    (GSource    *source);
  gboolean (*dispatch) (GSource    *source,
                        GSourceFunc callback,
                        gpointer    user_data);
  void     (*finalize) (GSource    *source); /* Can be NULL */

  /*< private >*/
  /* For use by g_source_set_closure */
  GSourceFunc     closure_callback;        
  GSourceDummyMarshal closure_marshal; /* Really is of type GClosureMarshal */
};
struct _GSourceCallbackFuncs
{
  void (*ref)   (gpointer     cb_data);
  void (*unref) (gpointer     cb_data);
  void (*get)   (gpointer     cb_data,
                 GSource     *source, 
                 GSourceFunc *func,
                 gpointer    *data);
};
struct _GSource
{
  /*< private >*/
  gpointer callback_data;
  GSourceCallbackFuncs *callback_funcs;

  const GSourceFuncs *source_funcs;
  guint ref_count;

  GMainContext *context;

  gint priority;
  guint flags;
  guint source_id;

  GSList *poll_fds;
  
  GSource *prev;
  GSource *next;

  char    *name;

  GSourcePrivate *priv;
};
struct _GList
{
  gpointer data;
  GList *next;
  GList *prev;
};

struct _GIOFuncs
{
  GIOStatus (*io_read)           (GIOChannel   *channel, 
			          gchar        *buf, 
				  gsize         count,
				  gsize        *bytes_read,
				  GError      **err);
  GIOStatus (*io_write)          (GIOChannel   *channel, 
				  const gchar  *buf, 
				  gsize         count,
				  gsize        *bytes_written,
				  GError      **err);
  GIOStatus (*io_seek)           (GIOChannel   *channel, 
				  gint64        offset, 
				  GSeekType     type,
				  GError      **err);
  GIOStatus  (*io_close)         (GIOChannel   *channel,
				  GError      **err);
  GSource*   (*io_create_watch)  (GIOChannel   *channel,
				  GIOCondition  condition);
  void       (*io_free)          (GIOChannel   *channel);
  GIOStatus  (*io_set_flags)     (GIOChannel   *channel,
                                  GIOFlags      flags,
				  GError      **err);
  GIOFlags   (*io_get_flags)     (GIOChannel   *channel);
};
struct _GIOChannel
{
  /*< private >*/
  gint ref_count;
  GIOFuncs *funcs;

  gchar *encoding;
  GIConv read_cd;
  GIConv write_cd;
  gchar *line_term;		/* String which indicates the end of a line of text */
  guint line_term_len;		/* So we can have null in the line term */

  gsize buf_size;
  GString *read_buf;		/* Raw data from the channel */
  GString *encoded_read_buf;    /* Channel data converted to UTF-8 */
  GString *write_buf;		/* Data ready to be written to the file */
  gchar partial_write_buf[6];	/* UTF-8 partial characters, null terminated */

  /* Group the flags together, immediately after partial_write_buf, to save memory */

  guint use_buffer     : 1;	/* The encoding uses the buffers */
  guint do_encode      : 1;	/* The encoding uses the GIConv coverters */
  guint close_on_unref : 1;	/* Close the channel on final unref */
  guint is_readable    : 1;	/* Cached GIOFlag */
  guint is_writeable   : 1;	/* ditto */
  guint is_seekable    : 1;	/* ditto */

  gpointer reserved1;	
  gpointer reserved2;	
};
struct _GHook
{
  gpointer	 data;
  GHook		*next;
  GHook		*prev;
  guint		 ref_count;
  gulong	 hook_id;
  guint		 flags;
  gpointer	 func;
  GDestroyNotify destroy;
};
struct _GHookList
{
  gulong	    seq_id;
  guint		    hook_size : 16;
  guint		    is_setup : 1;
  GHook		   *hooks;
  gpointer	    dummy3;
  GHookFinalizeFunc finalize_hook;
  gpointer	    dummy[2];
};


struct _GHashTableIter
{
  /*< private >*/
  gpointer      dummy1;
  gpointer      dummy2;
  gpointer      dummy3;
  int           dummy4;
  gboolean      dummy5;
  gpointer      dummy6;
};
struct _GError
{
  GQuark       domain;
  gint         code;
  gchar       *message;
};


struct _GDate
{
  guint julian_days : 32; /* julian days representation - we use a
                           *  bitfield hoping that 64 bit platforms
                           *  will pack this whole struct in one big
                           *  int
                           */

  guint julian : 1;    /* julian is valid */
  guint dmy    : 1;    /* dmy is valid */

  /* DMY representation */
  guint day    : 6;
  guint month  : 4;
  guint year   : 16;
};





struct _GPtrArray
{
  gpointer *pdata;
  guint	    len;
};
struct _GByteArray
{
  guint8 *data;
  guint	  len;
};
struct _GArray
{
  gchar *data;
  guint len;
};
gchar * g_module_build_path(const gchar  *directory, const gchar  *module_name);
const gchar  * g_module_name(GModule      *module);
gboolean g_module_symbol(GModule      *module, const gchar  *symbol_name, gpointer     *symbol);
const gchar  * g_module_error(void);
void g_module_make_resident(GModule      *module);
gboolean g_module_close(GModule      *module);
GModule * g_module_open(const gchar  *file_name, GModuleFlags  flags);
gboolean g_module_supported(void);
gboolean g_cond_timed_wait(GCond          *cond, GMutex         *mutex, GTimeVal       *timeval);
void g_cond_free(GCond  *cond);
GCond  * g_cond_new(void);
void g_mutex_free(GMutex *mutex);
GMutex  * g_mutex_new(void);
gboolean g_thread_get_initialized(void);
void g_thread_init_with_errorcheck_mutexes(gpointer vtable);
void g_thread_init(gpointer vtable);
gboolean g_once_init_enter_impl(volatile gsize *location);
void g_static_private_free(GStaticPrivate *private_key);
void g_static_private_set(GStaticPrivate *private_key, gpointer        data, GDestroyNotify  notify);
gpointer g_static_private_get(GStaticPrivate *private_key);
void g_static_private_init(GStaticPrivate *private_key);
GPrivate  * g_private_new(GDestroyNotify notify);
void g_static_rw_lock_free(GStaticRWLock *lock);
void g_static_rw_lock_writer_unlock(GStaticRWLock *lock);
gboolean g_static_rw_lock_writer_trylock(GStaticRWLock *lock);
void g_static_rw_lock_writer_lock(GStaticRWLock *lock);
void g_static_rw_lock_reader_unlock(GStaticRWLock *lock);
gboolean g_static_rw_lock_reader_trylock(GStaticRWLock *lock);
void g_static_rw_lock_reader_lock(GStaticRWLock *lock);
void g_static_rw_lock_init(GStaticRWLock *lock);
void g_static_rec_mutex_free(GStaticRecMutex *mutex);
guint g_static_rec_mutex_unlock_full(GStaticRecMutex *mutex);
void g_static_rec_mutex_lock_full(GStaticRecMutex *mutex, guint            depth);
void g_static_rec_mutex_unlock(GStaticRecMutex *mutex);
gboolean g_static_rec_mutex_trylock(GStaticRecMutex *mutex);
void g_static_rec_mutex_lock(GStaticRecMutex *mutex);
void g_static_rec_mutex_init(GStaticRecMutex *mutex);
GMutex  * g_static_mutex_get_mutex_impl(GStaticMutex *mutex);
void g_static_mutex_free(GStaticMutex *mutex);
void g_static_mutex_init(GStaticMutex *mutex);
void g_thread_foreach(GFunc             thread_func, gpointer          user_data);
void g_thread_set_priority(GThread          *thread, GThreadPriority   priority);
GThread  * g_thread_create_full(GThreadFunc       func, gpointer          data, gulong            stack_size, gboolean          joinable, gboolean          bound, GThreadPriority   priority, GError          **error);
GThread  * g_thread_create(GThreadFunc       func, gpointer          data, gboolean          joinable, GError          **error);
gpointer g_tuples_index(GTuples     *tuples, gint         index_, gint         field);
void g_tuples_destroy(GTuples     *tuples);
void g_relation_print(GRelation   *relation);
gboolean g_relation_exists(GRelation   *relation, ...);
gint g_relation_count(GRelation   *relation, gconstpointer  key, gint         field);
GTuples * g_relation_select(GRelation   *relation, gconstpointer  key, gint         field);
gint g_relation_delete(GRelation   *relation, gconstpointer  key, gint         field);
void g_relation_insert(GRelation   *relation, ...);
void g_relation_index(GRelation   *relation, gint         field, GHashFunc    hash_func, GEqualFunc   key_equal_func);
void g_relation_destroy(GRelation   *relation);
GRelation * g_relation_new(gint         fields);
void g_completion_free(GCompletion*    cmp);
void g_completion_set_compare(GCompletion *cmp, GCompletionStrncmpFunc strncmp_func);
GList * g_completion_complete_utf8(GCompletion  *cmp, const gchar*    prefix, gchar**         new_prefix);
GList * g_completion_complete(GCompletion*    cmp, const gchar*    prefix, gchar**         new_prefix);
void g_completion_clear_items(GCompletion*    cmp);
void g_completion_remove_items(GCompletion*    cmp, GList*          items);
void g_completion_add_items(GCompletion*    cmp, GList*          items);
GCompletion * g_completion_new(GCompletionFunc func);
void g_cache_value_foreach(GCache            *cache, GHFunc             func, gpointer           user_data);
void g_cache_key_foreach(GCache            *cache, GHFunc             func, gpointer           user_data);
void g_cache_remove(GCache            *cache, gconstpointer      value);
gpointer g_cache_insert(GCache            *cache, gpointer           key);
void g_cache_destroy(GCache            *cache);
GCache * g_cache_new(GCacheNewFunc      value_new_func, GCacheDestroyFunc  value_destroy_func, GCacheDupFunc      key_dup_func, GCacheDestroyFunc  key_destroy_func, GHashFunc          hash_key_func, GHashFunc          hash_value_func, GEqualFunc         key_equal_func);
gboolean g_win32_check_windows_version(const gint major, const gint minor, const gint spver, const GWin32OSType os_type);
gchar  ** g_win32_get_command_line(void);
gchar * g_win32_locale_filename_from_utf8(const gchar *utf8filename);
guint g_win32_get_windows_version(void);
gchar * g_win32_get_package_installation_directory_of_module(gpointer hmodule);
gchar * g_win32_get_package_installation_subdirectory(const gchar *package, const gchar *dll_name, const gchar *subdir);
gchar * g_win32_get_package_installation_directory(const gchar *package, const gchar *dll_name);
gchar * g_win32_error_message(gint error);
gchar * g_win32_getlocale(void);
gint g_win32_ftruncate(gint		 f, guint		 size);
const gchar  * glib_check_version(guint required_major, guint required_minor, guint required_micro);
gsize g_variant_type_string_get_depth_(const gchar *type_string);
const GVariantType  * g_variant_type_checked_(const gchar *);
GVariantType  * g_variant_type_new_dict_entry(const GVariantType  *key, const GVariantType  *value);
GVariantType  * g_variant_type_new_tuple(const GVariantType * const *items, gint                 length);
GVariantType  * g_variant_type_new_maybe(const GVariantType  *element);
GVariantType  * g_variant_type_new_array(const GVariantType  *element);
const GVariantType  * g_variant_type_value(const GVariantType  *type);
const GVariantType  * g_variant_type_key(const GVariantType  *type);
gsize g_variant_type_n_items(const GVariantType  *type);
const GVariantType  * g_variant_type_next(const GVariantType  *type);
const GVariantType  * g_variant_type_first(const GVariantType  *type);
const GVariantType  * g_variant_type_element(const GVariantType  *type);
gboolean g_variant_type_is_subtype_of(const GVariantType  *type, const GVariantType  *supertype);
gboolean g_variant_type_equal(gconstpointer        type1, gconstpointer        type2);
guint g_variant_type_hash(gconstpointer        type);
gboolean g_variant_type_is_variant(const GVariantType  *type);
gboolean g_variant_type_is_dict_entry(const GVariantType  *type);
gboolean g_variant_type_is_tuple(const GVariantType  *type);
gboolean g_variant_type_is_array(const GVariantType  *type);
gboolean g_variant_type_is_maybe(const GVariantType  *type);
gboolean g_variant_type_is_basic(const GVariantType  *type);
gboolean g_variant_type_is_container(const GVariantType  *type);
gboolean g_variant_type_is_definite(const GVariantType  *type);
gchar  * g_variant_type_dup_string(const GVariantType  *type);
const gchar  * g_variant_type_peek_string(const GVariantType  *type);
gsize g_variant_type_get_string_length(const GVariantType  *type);
GVariantType  * g_variant_type_new(const gchar         *type_string);
GVariantType  * g_variant_type_copy(const GVariantType  *type);
void g_variant_type_free(GVariantType        *type);
gboolean g_variant_type_string_scan(const gchar         *string, const gchar         *limit, const gchar        **endptr);
gboolean g_variant_type_string_is_valid(const gchar         *type_string);
void g_variant_dict_unref(GVariantDict         *dict);
GVariantDict  * g_variant_dict_ref(GVariantDict         *dict);
GVariant  * g_variant_dict_end(GVariantDict         *dict);
void g_variant_dict_clear(GVariantDict         *dict);
gboolean g_variant_dict_remove(GVariantDict         *dict, const gchar          *key);
void g_variant_dict_insert_value(GVariantDict         *dict, const gchar          *key, GVariant             *value);
void g_variant_dict_insert(GVariantDict         *dict, const gchar          *key, const gchar          *format_string, ...);
gboolean g_variant_dict_contains(GVariantDict         *dict, const gchar          *key);
GVariant  * g_variant_dict_lookup_value(GVariantDict         *dict, const gchar          *key, const GVariantType   *expected_type);
gboolean g_variant_dict_lookup(GVariantDict         *dict, const gchar          *key, const gchar          *format_string, ...);
void g_variant_dict_init(GVariantDict         *dict, GVariant             *from_asv);
GVariantDict  * g_variant_dict_new(GVariant             *from_asv);
gint g_variant_compare(gconstpointer one, gconstpointer two);
gchar  * g_variant_parse_error_print_context(GError               *error, const gchar          *source_str);
GVariant  * g_variant_new_parsed_va(const gchar          *format, va_list              *app);
GVariant  * g_variant_new_parsed(const gchar          *format, ...);
GVariant  * g_variant_parse(const GVariantType   *type, const gchar          *text, const gchar          *limit, const gchar         **endptr, GError              **error);
gboolean g_variant_check_format_string(GVariant             *value, const gchar          *format_string, gboolean              copy_only);
void g_variant_get_va(GVariant             *value, const gchar          *format_string, const gchar         **endptr, va_list              *app);
GVariant  * g_variant_new_va(const gchar          *format_string, const gchar         **endptr, va_list              *app);
void g_variant_get(GVariant             *value, const gchar          *format_string, ...);
GVariant  * g_variant_new(const gchar          *format_string, ...);
void g_variant_builder_add_parsed(GVariantBuilder      *builder, const gchar          *format, ...);
void g_variant_builder_add(GVariantBuilder      *builder, const gchar          *format_string, ...);
void g_variant_builder_add_value(GVariantBuilder      *builder, GVariant             *value);
void g_variant_builder_close(GVariantBuilder      *builder);
void g_variant_builder_open(GVariantBuilder      *builder, const GVariantType   *type);
void g_variant_builder_clear(GVariantBuilder      *builder);
GVariant  * g_variant_builder_end(GVariantBuilder      *builder);
void g_variant_builder_init(GVariantBuilder      *builder, const GVariantType   *type);
GVariantBuilder  * g_variant_builder_ref(GVariantBuilder      *builder);
void g_variant_builder_unref(GVariantBuilder      *builder);
GVariantBuilder  * g_variant_builder_new(const GVariantType   *type);
GQuark g_variant_parse_error_quark(void);
GQuark g_variant_parser_get_error_quark(void);
gboolean g_variant_iter_loop(GVariantIter         *iter, const gchar          *format_string, ...);
gboolean g_variant_iter_next(GVariantIter         *iter, const gchar          *format_string, ...);
GVariant  * g_variant_iter_next_value(GVariantIter         *iter);
void g_variant_iter_free(GVariantIter         *iter);
gsize g_variant_iter_n_children(GVariantIter         *iter);
GVariantIter  * g_variant_iter_copy(GVariantIter         *iter);
gsize g_variant_iter_init(GVariantIter         *iter, GVariant             *value);
GVariantIter  * g_variant_iter_new(GVariant             *value);
GVariant  * g_variant_new_from_data(const GVariantType   *type, gconstpointer         data, gsize                 size, gboolean              trusted, GDestroyNotify        notify, gpointer              user_data);
GVariant  * g_variant_new_from_bytes(const GVariantType   *type, GBytes               *bytes, gboolean              trusted);
GVariant  * g_variant_byteswap(GVariant             *value);
gboolean g_variant_is_normal_form(GVariant             *value);
GVariant  * g_variant_get_normal_form(GVariant             *value);
gboolean g_variant_equal(gconstpointer         one, gconstpointer         two);
guint g_variant_hash(gconstpointer         value);
GString  * g_variant_print_string(GVariant             *value, GString              *string, gboolean              type_annotate);
gchar  * g_variant_print(GVariant             *value, gboolean              type_annotate);
void g_variant_store(GVariant             *value, gpointer              data);
GBytes  * g_variant_get_data_as_bytes(GVariant             *value);
gconstpointer g_variant_get_data(GVariant             *value);
gsize g_variant_get_size(GVariant             *value);
gconstpointer g_variant_get_fixed_array(GVariant             *value, gsize                *n_elements, gsize                 element_size);
GVariant  * g_variant_lookup_value(GVariant             *dictionary, const gchar          *key, const GVariantType   *expected_type);
gboolean g_variant_lookup(GVariant             *dictionary, const gchar          *key, const gchar          *format_string, ...);
GVariant  * g_variant_get_child_value(GVariant             *value, gsize                 index_);
void g_variant_get_child(GVariant             *value, gsize                 index_, const gchar          *format_string, ...);
gsize g_variant_n_children(GVariant             *value);
GVariant  * g_variant_get_maybe(GVariant             *value);
GVariant  * g_variant_new_dict_entry(GVariant             *key, GVariant             *value);
GVariant  * g_variant_new_tuple(GVariant * const     *children, gsize                 n_children);
GVariant  * g_variant_new_array(const GVariantType   *child_type, GVariant * const     *children, gsize                 n_children);
GVariant  * g_variant_new_maybe(const GVariantType   *child_type, GVariant             *child);
gchar  ** g_variant_dup_bytestring_array(GVariant             *value, gsize                *length);
const gchar  ** g_variant_get_bytestring_array(GVariant             *value, gsize                *length);
gchar  * g_variant_dup_bytestring(GVariant             *value, gsize                *length);
const gchar  * g_variant_get_bytestring(GVariant             *value);
gchar  ** g_variant_dup_objv(GVariant             *value, gsize                *length);
const gchar  ** g_variant_get_objv(GVariant             *value, gsize                *length);
gchar  ** g_variant_dup_strv(GVariant             *value, gsize                *length);
const gchar  ** g_variant_get_strv(GVariant             *value, gsize                *length);
gchar  * g_variant_dup_string(GVariant             *value, gsize                *length);
const gchar  * g_variant_get_string(GVariant             *value, gsize                *length);
GVariant  * g_variant_get_variant(GVariant             *value);
gdouble g_variant_get_double(GVariant             *value);
gint32 g_variant_get_handle(GVariant             *value);
guint64 g_variant_get_uint64(GVariant             *value);
gint64 g_variant_get_int64(GVariant             *value);
guint32 g_variant_get_uint32(GVariant             *value);
gint32 g_variant_get_int32(GVariant             *value);
guint16 g_variant_get_uint16(GVariant             *value);
gint16 g_variant_get_int16(GVariant             *value);
guchar g_variant_get_byte(GVariant             *value);
gboolean g_variant_get_boolean(GVariant             *value);
GVariant  * g_variant_new_fixed_array(const GVariantType   *element_type, gconstpointer         elements, gsize                 n_elements, gsize                 element_size);
GVariant  * g_variant_new_bytestring_array(const gchar * const  *strv, gssize                length);
GVariant  * g_variant_new_bytestring(const gchar          *string);
GVariant  * g_variant_new_objv(const gchar * const  *strv, gssize                length);
GVariant  * g_variant_new_strv(const gchar * const  *strv, gssize                length);
GVariant  * g_variant_new_variant(GVariant             *value);
gboolean g_variant_is_signature(const gchar          *string);
GVariant  * g_variant_new_signature(const gchar          *signature);
gboolean g_variant_is_object_path(const gchar          *string);
GVariant  * g_variant_new_object_path(const gchar          *object_path);
GVariant  * g_variant_new_printf(const gchar          *format_string, ...);
GVariant  * g_variant_new_take_string(gchar                *string);
GVariant  * g_variant_new_string(const gchar          *string);
GVariant  * g_variant_new_double(gdouble               value);
GVariant  * g_variant_new_handle(gint32                value);
GVariant  * g_variant_new_uint64(guint64               value);
GVariant  * g_variant_new_int64(gint64                value);
GVariant  * g_variant_new_uint32(guint32               value);
GVariant  * g_variant_new_int32(gint32                value);
GVariant  * g_variant_new_uint16(guint16               value);
GVariant  * g_variant_new_int16(gint16                value);
GVariant  * g_variant_new_byte(guchar                value);
GVariant  * g_variant_new_boolean(gboolean              value);
GVariantClass g_variant_classify(GVariant             *value);
gboolean g_variant_is_container(GVariant             *value);
gboolean g_variant_is_of_type(GVariant             *value, const GVariantType   *type);
const gchar  * g_variant_get_type_string(GVariant             *value);
const GVariantType  * g_variant_get_type(GVariant             *value);
GVariant  * g_variant_take_ref(GVariant             *value);
gboolean g_variant_is_floating(GVariant             *value);
GVariant  * g_variant_ref_sink(GVariant             *value);
GVariant  * g_variant_ref(GVariant             *value);
void g_variant_unref(GVariant             *value);
gchar  * g_uuid_string_random(void);
gboolean g_uuid_string_is_valid(const gchar   *str);
guint g_bit_storage_impl(gulong number);
gint g_bit_nth_msf_impl(gulong mask, gint   nth_bit);
gint g_bit_nth_lsf_impl(gulong mask, gint   nth_bit);
//GLIB_AVAILABLE_IN_ALL guint(g_bit_storage)         (gulong number);
//GLIB_AVAILABLE_IN_ALL gint(g_bit_nth_lsf)         (gulong mask, gint   nth_bit);
gchar * g_find_program_in_path(const gchar *program);
int atexit(void (*callback)(void));
void g_atexit(GVoidFunc    func);
gchar  * g_format_size_for_display(goffset size);
gchar  * g_format_size(guint64          size);
gchar  * g_format_size_full(guint64          size, GFormatSizeFlags flags);
void g_nullify_pointer(gpointer    *nullify_location);
gint g_vsnprintf(gchar       *string, gulong       n, gchar const *format, va_list      args);
gint g_snprintf(gchar       *string, gulong       n, gchar const *format, ...);
guint g_parse_debug_string(const gchar     *string, const GDebugKey *keys, guint            nkeys);
const gchar  * g_get_user_special_dir(GUserDirectory directory);
const gchar  * g_get_user_runtime_dir(void);
const gchar  * const * g_get_system_config_dirs(void);
const gchar  * const * g_win32_get_system_data_dirs_for_module(void (*address_of_function)(void));
const gchar  * const * g_get_system_data_dirs(void);
const gchar  * g_get_user_cache_dir(void);
const gchar  * g_get_user_config_dir(void);
const gchar  * g_get_user_data_dir(void);
void g_reload_user_special_dirs_cache(void);
void g_set_application_name(const gchar *application_name);
const gchar  * g_get_application_name(void);
void g_set_prgname(const gchar *prgname);
const gchar  * g_get_prgname(void);
const gchar  * g_get_host_name(void);
const gchar  * g_get_tmp_dir(void);
const gchar  * g_get_home_dir(void);
const gchar  * g_get_real_name(void);
const gchar  * g_get_user_name(void);
char  * g_uri_escape_string(const char *unescaped, const char *reserved_chars_allowed, gboolean    allow_utf8);
char  * g_uri_parse_scheme(const char *uri);
char  * g_uri_unescape_segment(const char *escaped_string, const char *escaped_string_end, const char *illegal_characters);
char  * g_uri_unescape_string(const char *escaped_string, const char *illegal_characters);
gchar  * g_utf8_make_valid(const gchar *str, gssize       len);
gchar  * g_utf8_collate_key_for_filename(const gchar *str, gssize       len);
gchar  * g_utf8_collate_key(const gchar *str, gssize       len);
gint g_utf8_collate(const gchar *str1, const gchar *str2);
gchar  * g_utf8_normalize(const gchar   *str, gssize         len, GNormalizeMode mode);
gchar  * g_utf8_casefold(const gchar *str, gssize       len);
gchar  * g_utf8_strdown(const gchar *str, gssize       len);
gchar  * g_utf8_strup(const gchar *str, gssize       len);
gboolean g_utf8_validate(const gchar  *str, gssize        max_len, const gchar **end);
gint g_unichar_to_utf8(gunichar    c, gchar      *outbuf);
gchar * g_ucs4_to_utf8(const gunichar   *str, glong             len, glong            *items_read, glong            *items_written, GError          **error);
gunichar2  * g_ucs4_to_utf16(const gunichar   *str, glong             len, glong            *items_read, glong            *items_written, GError          **error);
gchar * g_utf16_to_utf8(const gunichar2  *str, glong             len, glong            *items_read, glong            *items_written, GError          **error);
gunichar  * g_utf16_to_ucs4(const gunichar2  *str, glong             len, glong            *items_read, glong            *items_written, GError          **error);
gunichar  * g_utf8_to_ucs4_fast(const gchar      *str, glong             len, glong            *items_written);
gunichar  * g_utf8_to_ucs4(const gchar      *str, glong             len, glong            *items_read, glong            *items_written, GError          **error);
gunichar2  * g_utf8_to_utf16(const gchar      *str, glong             len, glong            *items_read, glong            *items_written, GError          **error);
gchar * g_utf8_strreverse(const gchar *str, gssize len);
gchar * g_utf8_strrchr(const gchar *p, gssize       len, gunichar     c);
gchar * g_utf8_strchr(const gchar *p, gssize       len, gunichar     c);
gchar    * g_utf8_strncpy(gchar       *dest, const gchar *src, gsize        n);
gchar    * g_utf8_substring(const gchar *str, glong        start_pos, glong        end_pos);
glong g_utf8_strlen(const gchar *p, gssize       max);
gchar * g_utf8_find_prev_char(const gchar *str, const gchar *p);
gchar * g_utf8_find_next_char(const gchar *p, const gchar *end);
gchar * g_utf8_prev_char(const gchar *p);
glong g_utf8_pointer_to_offset(const gchar *str, const gchar *pos);
gchar * g_utf8_offset_to_pointer(const gchar *str, glong        offset);
gunichar g_utf8_get_char_validated(const  gchar *p, gssize        max_len);
gunichar g_utf8_get_char(const gchar  *p);
gunichar  * g_unicode_canonical_decomposition(gunichar  ch, gsize    *result_len);
void g_unicode_canonical_ordering(gunichar *string, gsize     len);
gsize g_unichar_fully_decompose(gunichar  ch, gboolean  compat, gunichar *result, gsize     result_len);
gboolean g_unichar_decompose(gunichar  ch, gunichar *a, gunichar *b);
gboolean g_unichar_compose(gunichar  a, gunichar  b, gunichar *ch);
gboolean g_unichar_validate(gunichar ch);
GUnicodeScript g_unichar_get_script(gunichar ch);
gboolean g_unichar_get_mirror_char(gunichar ch, gunichar *mirrored_ch);
gint g_unichar_combining_class(gunichar uc);
GUnicodeBreakType g_unichar_break_type(gunichar c);
GUnicodeType g_unichar_type(gunichar c);
gint g_unichar_xdigit_value(gunichar c);
gint g_unichar_digit_value(gunichar c);
gunichar g_unichar_totitle(gunichar c);
gunichar g_unichar_tolower(gunichar c);
gunichar g_unichar_toupper(gunichar c);
gboolean g_unichar_ismark(gunichar c);
gboolean g_unichar_iszerowidth(gunichar c);
gboolean g_unichar_iswide_cjk(gunichar c);
gboolean g_unichar_iswide(gunichar c);
gboolean g_unichar_isdefined(gunichar c);
gboolean g_unichar_istitle(gunichar c);
gboolean g_unichar_isxdigit(gunichar c);
gboolean g_unichar_isupper(gunichar c);
gboolean g_unichar_isspace(gunichar c);
gboolean g_unichar_ispunct(gunichar c);
gboolean g_unichar_isprint(gunichar c);
gboolean g_unichar_islower(gunichar c);
gboolean g_unichar_isgraph(gunichar c);
gboolean g_unichar_isdigit(gunichar c);
gboolean g_unichar_iscntrl(gunichar c);
gboolean g_unichar_isalpha(gunichar c);
gboolean g_unichar_isalnum(gunichar c);
GUnicodeScript g_unicode_script_from_iso15924(guint32        iso15924);
guint32 g_unicode_script_to_iso15924(GUnicodeScript script);
gint g_tree_nnodes(GTree            *tree);
gint g_tree_height(GTree            *tree);
gpointer g_tree_search(GTree            *tree, GCompareFunc      search_func, gconstpointer     user_data);
void g_tree_traverse(GTree            *tree, GTraverseFunc     traverse_func, GTraverseType     traverse_type, gpointer          user_data);
void g_tree_foreach(GTree            *tree, GTraverseFunc	   func, gpointer	   user_data);
gboolean g_tree_lookup_extended(GTree            *tree, gconstpointer     lookup_key, gpointer         *orig_key, gpointer         *value);
gpointer g_tree_lookup(GTree            *tree, gconstpointer     key);
gboolean g_tree_steal(GTree            *tree, gconstpointer     key);
gboolean g_tree_remove(GTree            *tree, gconstpointer     key);
void g_tree_replace(GTree            *tree, gpointer          key, gpointer          value);
void g_tree_insert(GTree            *tree, gpointer          key, gpointer          value);
void g_tree_destroy(GTree            *tree);
void g_tree_unref(GTree            *tree);
GTree * g_tree_ref(GTree            *tree);
GTree * g_tree_new_full(GCompareDataFunc  key_compare_func, gpointer          key_compare_data, GDestroyNotify    key_destroy_func, GDestroyNotify    value_destroy_func);
GTree * g_tree_new_with_data(GCompareDataFunc  key_compare_func, gpointer          key_compare_data);
GTree * g_tree_new(GCompareFunc      key_compare_func);
guint g_trash_stack_height(GTrashStack **stack_p);
gpointer g_trash_stack_peek(GTrashStack **stack_p);
gpointer g_trash_stack_pop(GTrashStack **stack_p);
void g_trash_stack_push(GTrashStack **stack_p, gpointer      data_p);
gboolean g_time_zone_is_dst(GTimeZone   *tz, gint         interval);
gint32 g_time_zone_get_offset(GTimeZone   *tz, gint         interval);
const gchar  * g_time_zone_get_abbreviation(GTimeZone   *tz, gint         interval);
gint g_time_zone_adjust_time(GTimeZone   *tz, GTimeType    type, gint64      *time_);
gint g_time_zone_find_interval(GTimeZone   *tz, GTimeType    type, gint64       time_);
void g_time_zone_unref(GTimeZone   *tz);
GTimeZone  * g_time_zone_ref(GTimeZone   *tz);
GTimeZone  * g_time_zone_new_local(void);
GTimeZone  * g_time_zone_new_utc(void);
GTimeZone  * g_time_zone_new(const gchar *identifier);
gchar * g_time_val_to_iso8601(GTimeVal    *time_);
gboolean g_time_val_from_iso8601(const gchar *iso_date, GTimeVal    *time_);
void g_time_val_add(GTimeVal    *time_, glong        microseconds);
void g_usleep(gulong       microseconds);
gdouble g_timer_elapsed(GTimer      *timer, gulong      *microseconds);
void g_timer_continue(GTimer      *timer);
void g_timer_reset(GTimer      *timer);
void g_timer_stop(GTimer      *timer);
void g_timer_start(GTimer      *timer);
void g_timer_destroy(GTimer      *timer);
GTimer * g_timer_new(void);
guint g_thread_pool_get_max_idle_time(void);
void g_thread_pool_set_max_idle_time(guint interval);
void g_thread_pool_stop_unused_threads(void);
guint g_thread_pool_get_num_unused_threads(void);
gint g_thread_pool_get_max_unused_threads(void);
void g_thread_pool_set_max_unused_threads(gint  max_threads);
guint g_thread_pool_get_num_threads(GThreadPool     *pool);
gint g_thread_pool_get_max_threads(GThreadPool     *pool);
gboolean g_thread_pool_set_max_threads(GThreadPool     *pool, gint             max_threads, GError         **error);
gboolean g_thread_pool_move_to_front(GThreadPool      *pool, gpointer          data);
void g_thread_pool_set_sort_function(GThreadPool      *pool, GCompareDataFunc  func, gpointer          user_data);
guint g_thread_pool_unprocessed(GThreadPool     *pool);
gboolean g_thread_pool_push(GThreadPool     *pool, gpointer         data, GError         **error);
void g_thread_pool_free(GThreadPool     *pool, gboolean         immediate, gboolean         wait_);
GThreadPool  * g_thread_pool_new(GFunc            func, gpointer         user_data, gint             max_threads, gboolean         exclusive, GError         **error);
void g_mutex_locker_free(GMutexLocker *locker);
GMutexLocker  * g_mutex_locker_new(GMutex *mutex);
guint g_get_num_processors(void);
void g_once_init_leave(volatile void  *location, gsize           result);
gboolean g_once_init_enter(volatile void  *location);
gpointer g_once_impl(GOnce          *once, GThreadFunc     func, gpointer        arg);
void g_private_replace(GPrivate       *key, gpointer        value);
void g_private_set(GPrivate       *key, gpointer        value);
gpointer g_private_get(GPrivate       *key);
gboolean g_cond_wait_until(GCond          *cond, GMutex         *mutex, gint64          end_time);
void g_cond_broadcast(GCond          *cond);
void g_cond_signal(GCond          *cond);
void g_cond_wait(GCond          *cond, GMutex         *mutex);
void g_cond_clear(GCond          *cond);
void g_cond_init(GCond          *cond);
void g_rec_mutex_unlock(GRecMutex      *rec_mutex);
gboolean g_rec_mutex_trylock(GRecMutex      *rec_mutex);
void g_rec_mutex_lock(GRecMutex      *rec_mutex);
void g_rec_mutex_clear(GRecMutex      *rec_mutex);
void g_rec_mutex_init(GRecMutex      *rec_mutex);
void g_rw_lock_reader_unlock(GRWLock        *rw_lock);
gboolean g_rw_lock_reader_trylock(GRWLock        *rw_lock);
void g_rw_lock_reader_lock(GRWLock        *rw_lock);
void g_rw_lock_writer_unlock(GRWLock        *rw_lock);
gboolean g_rw_lock_writer_trylock(GRWLock        *rw_lock);
void g_rw_lock_writer_lock(GRWLock        *rw_lock);
void g_rw_lock_clear(GRWLock        *rw_lock);
void g_rw_lock_init(GRWLock        *rw_lock);
void g_mutex_unlock(GMutex         *mutex);
gboolean g_mutex_trylock(GMutex         *mutex);
void g_mutex_lock(GMutex         *mutex);
void g_mutex_clear(GMutex         *mutex);
void g_mutex_init(GMutex         *mutex);
void g_thread_yield(void);
gpointer g_thread_join(GThread        *thread);
void g_thread_exit(gpointer        retval);
GThread  * g_thread_self(void);
GThread  * g_thread_try_new(const gchar    *name, GThreadFunc     func, gpointer        data, GError        **error);
GThread  * g_thread_new(const gchar    *name, GThreadFunc     func, gpointer        data);
void g_thread_unref(GThread        *thread);
GThread  * g_thread_ref(GThread        *thread);
GQuark g_thread_error_quark(void);
const gchar  * g_test_get_filename(GTestFileType   file_type, const gchar    *first_path, ...);
const gchar  * g_test_get_dir(GTestFileType   file_type);
gchar  * g_test_build_filename(GTestFileType   file_type, const gchar    *first_path, ...);
void g_test_assert_expected_messages_internal(const char     *domain, const char     *file, int             line, const char     *func);
void g_test_expect_message(const gchar    *log_domain, GLogLevelFlags  log_level, const gchar    *pattern);
void g_test_log_set_fatal_handler(GTestLogFatalFunc log_func, gpointer          user_data);
void g_test_log_msg_free(GTestLogMsg    *tmsg);
GTestLogMsg * g_test_log_buffer_pop(GTestLogBuffer *tbuffer);
void g_test_log_buffer_push(GTestLogBuffer *tbuffer, guint           n_bytes, const guint8   *bytes);
void g_test_log_buffer_free(GTestLogBuffer *tbuffer);
GTestLogBuffer * g_test_log_buffer_new(void);
const char * g_test_log_type_name(GTestLogType    log_type);
void g_test_add_vtable(const char     *testpath, gsize           data_size, gconstpointer   test_data, GTestFixtureFunc  data_setup, GTestFixtureFunc  data_test, GTestFixtureFunc  data_teardown);
void g_assertion_message_error(const char     *domain, const char     *file, int             line, const char     *func, const char     *expr, const GError   *error, GQuark          error_domain, int             error_code);
void g_assertion_message_cmpnum(const char     *domain, const char     *file, int             line, const char     *func, const char     *expr, long double     arg1, const char     *cmp, long double     arg2, char            numtype);
void g_assertion_message_cmpstr(const char     *domain, const char     *file, int             line, const char     *func, const char     *expr, const char     *arg1, const char     *cmp, const char     *arg2);
void g_assertion_message_expr(const char     *domain, const char     *file, int             line, const char     *func, const char     *expr);
void g_assertion_message(const char     *domain, const char     *file, int             line, const char     *func, const char     *message);
void g_test_trap_assertions(const char     *domain, const char     *file, int             line, const char     *func, guint64         assertion_flags, const char     *pattern);
int g_test_run_suite(GTestSuite     *suite);
void g_test_suite_add_suite(GTestSuite     *suite, GTestSuite     *nestedsuite);
void g_test_suite_add(GTestSuite     *suite, GTestCase      *test_case);
GTestSuite * g_test_get_root(void);
GTestSuite * g_test_create_suite(const char       *suite_name);
GTestCase * g_test_create_case(const char       *test_name, gsize             data_size, gconstpointer     test_data, GTestFixtureFunc  data_setup, GTestFixtureFunc  data_test, GTestFixtureFunc  data_teardown);
double g_test_rand_double_range(double          range_start, double          range_end);
double g_test_rand_double(void);
gint32 g_test_rand_int_range(gint32          begin, gint32          end);
gint32 g_test_rand_int(void);
gboolean g_test_trap_reached_timeout(void);
gboolean g_test_trap_has_passed(void);
void g_test_trap_subprocess(const char           *test_path, guint64               usec_timeout, GTestSubprocessFlags  test_flags);
gboolean g_test_trap_fork(guint64              usec_timeout, GTestTrapFlags       test_trap_flags);
void g_test_queue_destroy(GDestroyNotify destroy_func, gpointer       destroy_data);
void g_test_queue_free(gpointer gfree_pointer);
double g_test_timer_last(void);
double g_test_timer_elapsed(void);
void g_test_timer_start(void);
void g_test_bug(const char *bug_uri_snippet);
void g_test_bug_base(const char *uri_pattern);
void g_test_message(const char *format, ...);
void g_test_set_nonfatal_assertions(void);
gboolean g_test_failed(void);
void g_test_skip(const gchar *msg);
void g_test_incomplete(const gchar *msg);
void g_test_fail(void);
void g_test_add_data_func_full(const char     *testpath, gpointer        test_data, GTestDataFunc   test_func, GDestroyNotify  data_free_func);
void g_test_add_data_func(const char     *testpath, gconstpointer   test_data, GTestDataFunc   test_func);
void g_test_add_func(const char     *testpath, GTestFunc       test_func);
int g_test_run(void);
gboolean g_test_subprocess(void);
void g_test_init(int            *argc, char         ***argv, ...);
void g_test_maximized_result(double          maximized_quantity, const char     *format, ...);
void g_test_minimized_result(double          minimized_quantity, const char     *format, ...);
int g_strcmp0(const char     *str1, const char     *str2);
gchar * g_string_chunk_insert_const(GStringChunk *chunk, const gchar  *string);
gchar * g_string_chunk_insert_len(GStringChunk *chunk, const gchar  *string, gssize        len);
gchar * g_string_chunk_insert(GStringChunk *chunk, const gchar  *string);
void g_string_chunk_clear(GStringChunk *chunk);
void g_string_chunk_free(GStringChunk *chunk);
GStringChunk * g_string_chunk_new(gsize size);
GString  * g_string_up(GString *string);
GString  * g_string_down(GString *string);
GString * g_string_append_c_inline(GString *gstring, gchar    c);
GString * g_string_append_uri_escaped(GString         *string, const gchar     *unescaped, const gchar     *reserved_chars_allowed, gboolean         allow_utf8);
void g_string_append_printf(GString         *string, const gchar     *format, ...);
void g_string_append_vprintf(GString         *string, const gchar     *format, va_list          args);
void g_string_printf(GString         *string, const gchar     *format, ...);
void g_string_vprintf(GString         *string, const gchar     *format, va_list          args);
GString * g_string_ascii_up(GString         *string);
GString * g_string_ascii_down(GString         *string);
GString * g_string_erase(GString         *string, gssize           pos, gssize           len);
GString * g_string_overwrite_len(GString         *string, gsize            pos, const gchar     *val, gssize           len);
GString * g_string_overwrite(GString         *string, gsize            pos, const gchar     *val);
GString * g_string_insert_unichar(GString         *string, gssize           pos, gunichar         wc);
GString * g_string_insert_c(GString         *string, gssize           pos, gchar            c);
GString * g_string_insert(GString         *string, gssize           pos, const gchar     *val);
GString * g_string_prepend_len(GString         *string, const gchar     *val, gssize           len);
GString * g_string_prepend_unichar(GString         *string, gunichar         wc);
GString * g_string_prepend_c(GString         *string, gchar            c);
GString * g_string_prepend(GString         *string, const gchar     *val);
GString * g_string_append_unichar(GString         *string, gunichar         wc);
GString * g_string_append_c(GString         *string, gchar            c);
GString * g_string_append_len(GString         *string, const gchar     *val, gssize           len);
GString * g_string_append(GString         *string, const gchar     *val);
GString * g_string_insert_len(GString         *string, gssize           pos, const gchar     *val, gssize           len);
GString * g_string_set_size(GString         *string, gsize            len);
GString * g_string_truncate(GString         *string, gsize            len);
GString * g_string_assign(GString         *string, const gchar     *rval);
guint g_string_hash(const GString   *str);
gboolean g_string_equal(const GString   *v, const GString   *v2);
GBytes * g_string_free_to_bytes(GString         *string);
gchar * g_string_free(GString         *string, gboolean         free_segment);
GString * g_string_sized_new(gsize            dfl_size);
GString * g_string_new_len(const gchar     *init, gssize           len);
GString * g_string_new(const gchar     *init);
gboolean g_ascii_string_to_unsigned(const gchar  *str, guint         base, guint64       min, guint64       max, guint64      *out_num, GError      **error);
gboolean g_ascii_string_to_signed(const gchar  *str, guint         base, gint64        min, gint64        max, gint64       *out_num, GError      **error);
GQuark g_number_parser_error_quark(void);
gboolean g_strv_contains(const gchar * const *strv, const gchar         *str);
gboolean g_str_match_string(const gchar   *search_term, const gchar   *potential_hit, gboolean       accept_alternates);
gchar  ** g_str_tokenize_and_fold(const gchar   *string, const gchar   *translit_locale, gchar       ***ascii_alternates);
gchar  * g_str_to_ascii(const gchar   *str, const gchar   *from_locale);
gchar * g_stpcpy(gchar        *dest, const char   *src);
guint g_strv_length(gchar       **str_array);
gchar ** g_strdupv(gchar       **str_array);
void g_strfreev(gchar       **str_array);
gchar * g_strjoinv(const gchar  *separator, gchar       **str_array);
gchar  ** g_strsplit_set(const gchar *string, const gchar *delimiters, gint         max_tokens);
gchar ** g_strsplit(const gchar  *string, const gchar  *delimiter, gint          max_tokens);
gpointer g_memdup(gconstpointer mem, guint	       byte_size);
gchar * g_strescape(const gchar *source, const gchar *exceptions);
gchar * g_strcompress(const gchar *source);
gchar * g_strjoin(const gchar  *separator, ...);
gchar * g_strconcat(const gchar *string1, ...);
gchar * g_strnfill(gsize        length, gchar        fill_char);
gchar * g_strndup(const gchar *str, gsize        n);
gchar * g_strdup_vprintf(const gchar *format, va_list      args);
gchar * g_strdup_printf(const gchar *format, ...);
gchar * g_strdup(const gchar *str);
gchar * g_strup(gchar       *string);
gchar * g_strdown(gchar       *string);
gint g_strncasecmp(const gchar *s1, const gchar *s2, guint        n);
gint g_strcasecmp(const gchar *s1, const gchar *s2);
gboolean g_str_is_ascii(const gchar *str);
gchar * g_ascii_strup(const gchar *str, gssize       len);
gchar * g_ascii_strdown(const gchar *str, gssize       len);
gint g_ascii_strncasecmp(const gchar *s1, const gchar *s2, gsize        n);
gint g_ascii_strcasecmp(const gchar *s1, const gchar *s2);
gchar * g_strchomp(gchar        *string);
gchar * g_strchug(gchar        *string);
gchar  * g_ascii_formatd(gchar        *buffer, gint          buf_len, const gchar  *format, gdouble       d);
gchar  * g_ascii_dtostr(gchar        *buffer, gint          buf_len, gdouble       d);
gint64 g_ascii_strtoll(const gchar *nptr, gchar      **endptr, guint        base);
guint64 g_ascii_strtoull(const gchar *nptr, gchar      **endptr, guint        base);
gdouble g_ascii_strtod(const gchar  *nptr, gchar	    **endptr);
gdouble g_strtod(const gchar  *nptr, gchar	    **endptr);
gboolean g_str_has_prefix(const gchar  *str, const gchar  *prefix);
gboolean g_str_has_suffix(const gchar  *str, const gchar  *suffix);
gchar  * g_strrstr_len(const gchar  *haystack, gssize        haystack_len, const gchar  *needle);
gchar  * g_strrstr(const gchar  *haystack, const gchar  *needle);
gchar  * g_strstr_len(const gchar  *haystack, gssize        haystack_len, const gchar  *needle);
gsize g_strlcat(gchar	     *dest, const gchar  *src, gsize         dest_size);
gsize g_strlcpy(gchar	     *dest, const gchar  *src, gsize         dest_size);
gchar  * g_strreverse(gchar	     *string);
const gchar  * g_strsignal(gint	      signum);
const gchar  * g_strerror(gint	      errnum);
gchar * g_strcanon(gchar        *string, const gchar  *valid_chars, gchar         substitutor);
gchar * g_strdelimit(gchar	     *string, const gchar  *delimiters, gchar	      new_delimiter);
gint g_ascii_xdigit_value(gchar    c);
gint g_ascii_digit_value(gchar    c);
gchar g_ascii_toupper(gchar        c);
gchar g_ascii_tolower(gchar        c);
int g_win32_fstat(int                fd, GWin32PrivateStat *buf);
int g_win32_readlink_utf8(const gchar *filename, gchar       *buf, gsize        buf_size);
int g_win32_lstat_utf8(const gchar       *filename, GWin32PrivateStat *buf);
int g_win32_stat_utf8(const gchar       *filename, GWin32PrivateStat *buf);
gboolean g_close(gint       fd, GError   **error);
int g_utime(const gchar    *filename, struct utimbuf *utb);
FILE  * g_freopen(const gchar *filename, const gchar *mode, FILE        *stream);
FILE  * g_fopen(const gchar *filename, const gchar *mode);
int g_remove(const gchar *filename);
int g_lstat(const gchar *filename, GStatBuf    *buf);
int g_stat(const gchar *filename, GStatBuf    *buf);
int g_mkdir(const gchar *filename, int          mode);
int g_rename(const gchar *oldfilename, const gchar *newfilename);
int g_creat(const gchar *filename, int          mode);
int g_open(const gchar *filename, int          flags, int          mode);
int g_chmod(const gchar *filename, int          mode);
int g_rmdir(const gchar *filename);
int g_unlink(const gchar *filename);
int g_chdir(const gchar *path);
int g_access(const gchar *filename, int          mode);
void g_spawn_close_pid(GPid pid);
gboolean g_spawn_check_exit_status(gint      exit_status, GError  **error);
gboolean g_spawn_command_line_async(const gchar          *command_line, GError              **error);
gboolean g_spawn_command_line_sync(const gchar          *command_line, gchar               **standard_output, gchar               **standard_error, gint                 *exit_status, GError              **error);
gboolean g_spawn_sync(const gchar          *working_directory, gchar               **argv, gchar               **envp, GSpawnFlags           flags, GSpawnChildSetupFunc  child_setup, gpointer              user_data, gchar               **standard_output, gchar               **standard_error, gint                 *exit_status, GError              **error);
gboolean g_spawn_async_with_pipes(const gchar          *working_directory, gchar               **argv, gchar               **envp, GSpawnFlags           flags, GSpawnChildSetupFunc  child_setup, gpointer              user_data, GPid                 *child_pid, gint                 *standard_input, gint                 *standard_output, gint                 *standard_error, GError              **error);
gboolean g_spawn_async(const gchar           *working_directory, gchar                **argv, gchar                **envp, GSpawnFlags            flags, GSpawnChildSetupFunc   child_setup, gpointer               user_data, GPid                  *child_pid, GError               **error);
GQuark g_spawn_exit_error_quark(void);
GQuark g_spawn_error_quark(void);
gpointer g_slist_nth_data(GSList           *list, guint             n);
GSList * g_slist_sort_with_data(GSList           *list, GCompareDataFunc  compare_func, gpointer          user_data);
GSList * g_slist_sort(GSList           *list, GCompareFunc      compare_func);
void g_slist_foreach(GSList           *list, GFunc             func, gpointer          user_data);
guint g_slist_length(GSList           *list);
GSList * g_slist_last(GSList           *list);
gint g_slist_index(GSList           *list, gconstpointer     data);
gint g_slist_position(GSList           *list, GSList           *llink);
GSList * g_slist_find_custom(GSList           *list, gconstpointer     data, GCompareFunc      func);
GSList * g_slist_find(GSList           *list, gconstpointer     data);
GSList * g_slist_nth(GSList           *list, guint             n);
GSList * g_slist_copy_deep(GSList            *list, GCopyFunc         func, gpointer          user_data);
GSList * g_slist_copy(GSList           *list);
GSList * g_slist_reverse(GSList           *list);
GSList * g_slist_delete_link(GSList           *list, GSList           *link_);
GSList * g_slist_remove_link(GSList           *list, GSList           *link_);
GSList * g_slist_remove_all(GSList           *list, gconstpointer     data);
GSList * g_slist_remove(GSList           *list, gconstpointer     data);
GSList * g_slist_concat(GSList           *list1, GSList           *list2);
GSList * g_slist_insert_before(GSList           *slist, GSList           *sibling, gpointer          data);
GSList * g_slist_insert_sorted_with_data(GSList           *list, gpointer          data, GCompareDataFunc  func, gpointer          user_data);
GSList * g_slist_insert_sorted(GSList           *list, gpointer          data, GCompareFunc      func);
GSList * g_slist_insert(GSList           *list, gpointer          data, gint              position);
GSList * g_slist_prepend(GSList           *list, gpointer          data);
GSList * g_slist_append(GSList           *list, gpointer          data);
void g_slist_free_full(GSList           *list, GDestroyNotify    free_func);
void g_slist_free_1(GSList           *list);
void g_slist_free(GSList           *list);
GSList * g_slist_alloc(void);
void g_slice_debug_tree_statistics(void);
gint64 * g_slice_get_config_state(GSliceConfig ckey, gint64 address, guint *n_values);
gint64 g_slice_get_config(GSliceConfig ckey);
void g_slice_set_config(GSliceConfig ckey, gint64 value);
void g_slice_free_chain_with_offset(gsize         block_size, gpointer      mem_chain, gsize         next_offset);
void g_slice_free1(gsize         block_size, gpointer      mem_block);
gpointer g_slice_copy(gsize         block_size, gconstpointer mem_block);
gpointer g_slice_alloc0(gsize         block_size);
gpointer g_slice_alloc(gsize	       block_size);
gboolean g_shell_parse_argv(const gchar   *command_line, gint          *argcp, gchar       ***argvp, GError       **error);
gchar * g_shell_unquote(const gchar   *quoted_string, GError       **error);
gchar * g_shell_quote(const gchar   *unquoted_string);
GQuark g_shell_error_quark(void);
GSequenceIter  * g_sequence_range_get_midpoint(GSequenceIter            *begin, GSequenceIter            *end);
gint g_sequence_iter_compare(GSequenceIter            *a, GSequenceIter            *b);
GSequence  * g_sequence_iter_get_sequence(GSequenceIter            *iter);
GSequenceIter  * g_sequence_iter_move(GSequenceIter            *iter, gint                      delta);
gint g_sequence_iter_get_position(GSequenceIter            *iter);
GSequenceIter  * g_sequence_iter_prev(GSequenceIter            *iter);
GSequenceIter  * g_sequence_iter_next(GSequenceIter            *iter);
gboolean g_sequence_iter_is_end(GSequenceIter            *iter);
gboolean g_sequence_iter_is_begin(GSequenceIter            *iter);
void g_sequence_set(GSequenceIter            *iter, gpointer                  data);
gpointer g_sequence_get(GSequenceIter            *iter);
GSequenceIter  * g_sequence_lookup_iter(GSequence                *seq, gpointer                  data, GSequenceIterCompareFunc  iter_cmp, gpointer                  cmp_data);
GSequenceIter  * g_sequence_lookup(GSequence                *seq, gpointer                  data, GCompareDataFunc          cmp_func, gpointer                  cmp_data);
GSequenceIter  * g_sequence_search_iter(GSequence                *seq, gpointer                  data, GSequenceIterCompareFunc  iter_cmp, gpointer                  cmp_data);
GSequenceIter  * g_sequence_search(GSequence                *seq, gpointer                  data, GCompareDataFunc          cmp_func, gpointer                  cmp_data);
void g_sequence_move_range(GSequenceIter            *dest, GSequenceIter            *begin, GSequenceIter            *end);
void g_sequence_remove_range(GSequenceIter            *begin, GSequenceIter            *end);
void g_sequence_remove(GSequenceIter            *iter);
void g_sequence_sort_changed_iter(GSequenceIter            *iter, GSequenceIterCompareFunc  iter_cmp, gpointer                  cmp_data);
void g_sequence_sort_changed(GSequenceIter            *iter, GCompareDataFunc          cmp_func, gpointer                  cmp_data);
GSequenceIter  * g_sequence_insert_sorted_iter(GSequence                *seq, gpointer                  data, GSequenceIterCompareFunc  iter_cmp, gpointer                  cmp_data);
GSequenceIter  * g_sequence_insert_sorted(GSequence                *seq, gpointer                  data, GCompareDataFunc          cmp_func, gpointer                  cmp_data);
void g_sequence_swap(GSequenceIter            *a, GSequenceIter            *b);
void g_sequence_move(GSequenceIter            *src, GSequenceIter            *dest);
GSequenceIter  * g_sequence_insert_before(GSequenceIter            *iter, gpointer                  data);
GSequenceIter  * g_sequence_prepend(GSequence                *seq, gpointer                  data);
GSequenceIter  * g_sequence_append(GSequence                *seq, gpointer                  data);
GSequenceIter  * g_sequence_get_iter_at_pos(GSequence                *seq, gint                      pos);
GSequenceIter  * g_sequence_get_end_iter(GSequence                *seq);
GSequenceIter  * g_sequence_get_begin_iter(GSequence                *seq);
gboolean g_sequence_is_empty(GSequence                *seq);
void g_sequence_sort_iter(GSequence                *seq, GSequenceIterCompareFunc  cmp_func, gpointer                  cmp_data);
void g_sequence_sort(GSequence                *seq, GCompareDataFunc          cmp_func, gpointer                  cmp_data);
void g_sequence_foreach_range(GSequenceIter            *begin, GSequenceIter            *end, GFunc                     func, gpointer                  user_data);
void g_sequence_foreach(GSequence                *seq, GFunc                     func, gpointer                  user_data);
gint g_sequence_get_length(GSequence                *seq);
void g_sequence_free(GSequence                *seq);
GSequence  * g_sequence_new(GDestroyNotify            data_destroy);
void g_scanner_warn(GScanner	*scanner, const gchar	*format, ...);
void g_scanner_error(GScanner	*scanner, const gchar	*format, ...);
void g_scanner_unexp_token(GScanner	*scanner, GTokenType	expected_token, const gchar	*identifier_spec, const gchar	*symbol_spec, const gchar	*symbol_name, const gchar	*message, gint		 is_error);
gpointer g_scanner_lookup_symbol(GScanner	*scanner, const gchar	*symbol);
void g_scanner_scope_foreach_symbol(GScanner	*scanner, guint		 scope_id, GHFunc		 func, gpointer	 user_data);
gpointer g_scanner_scope_lookup_symbol(GScanner	*scanner, guint		 scope_id, const gchar	*symbol);
void g_scanner_scope_remove_symbol(GScanner	*scanner, guint		 scope_id, const gchar	*symbol);
void g_scanner_scope_add_symbol(GScanner	*scanner, guint		 scope_id, const gchar	*symbol, gpointer	value);
guint g_scanner_set_scope(GScanner	*scanner, guint		 scope_id);
gboolean g_scanner_eof(GScanner	*scanner);
guint g_scanner_cur_position(GScanner	*scanner);
guint g_scanner_cur_line(GScanner	*scanner);
GTokenValue g_scanner_cur_value(GScanner	*scanner);
GTokenType g_scanner_cur_token(GScanner	*scanner);
GTokenType g_scanner_peek_next_token(GScanner	*scanner);
GTokenType g_scanner_get_next_token(GScanner	*scanner);
void g_scanner_input_text(GScanner	*scanner, const	gchar	*text, guint		text_len);
void g_scanner_sync_file_offset(GScanner	*scanner);
void g_scanner_input_file(GScanner	*scanner, gint		input_fd);
void g_scanner_destroy(GScanner	*scanner);
GScanner * g_scanner_new(const GScannerConfig *config_templ);
gchar 		** g_match_info_fetch_all(const GMatchInfo    *match_info);
gboolean g_match_info_fetch_named_pos(const GMatchInfo    *match_info, const gchar         *name, gint                *start_pos, gint                *end_pos);
gchar 		 * g_match_info_fetch_named(const GMatchInfo    *match_info, const gchar         *name);
gboolean g_match_info_fetch_pos(const GMatchInfo    *match_info, gint                 match_num, gint                *start_pos, gint                *end_pos);
gchar 		 * g_match_info_fetch(const GMatchInfo    *match_info, gint                 match_num);
gchar 		 * g_match_info_expand_references(const GMatchInfo    *match_info, const gchar         *string_to_expand, GError             **error);
gboolean g_match_info_is_partial_match(const GMatchInfo    *match_info);
gint g_match_info_get_match_count(const GMatchInfo    *match_info);
gboolean g_match_info_matches(const GMatchInfo    *match_info);
gboolean g_match_info_next(GMatchInfo          *match_info, GError             **error);
void g_match_info_free(GMatchInfo          *match_info);
void g_match_info_unref(GMatchInfo          *match_info);
GMatchInfo        * g_match_info_ref(GMatchInfo          *match_info);
const gchar       * g_match_info_get_string(const GMatchInfo    *match_info);
GRegex 		 * g_match_info_get_regex(const GMatchInfo    *match_info);
gboolean g_regex_check_replacement(const gchar         *replacement, gboolean            *has_references, GError             **error);
gchar 		 * g_regex_replace_eval(const GRegex        *regex, const gchar         *string, gssize               string_len, gint                 start_position, GRegexMatchFlags     match_options, GRegexEvalCallback   eval, gpointer             user_data, GError             **error);
gchar 		 * g_regex_replace_literal(const GRegex        *regex, const gchar         *string, gssize               string_len, gint                 start_position, const gchar         *replacement, GRegexMatchFlags     match_options, GError             **error);
gchar 		 * g_regex_replace(const GRegex        *regex, const gchar         *string, gssize               string_len, gint                 start_position, const gchar         *replacement, GRegexMatchFlags     match_options, GError             **error);
gchar 		** g_regex_split_full(const GRegex        *regex, const gchar         *string, gssize               string_len, gint                 start_position, GRegexMatchFlags     match_options, gint                 max_tokens, GError             **error);
gchar 		** g_regex_split(const GRegex        *regex, const gchar         *string, GRegexMatchFlags     match_options);
gchar 		** g_regex_split_simple(const gchar         *pattern, const gchar         *string, GRegexCompileFlags   compile_options, GRegexMatchFlags     match_options);
gboolean g_regex_match_all_full(const GRegex        *regex, const gchar         *string, gssize               string_len, gint                 start_position, GRegexMatchFlags     match_options, GMatchInfo         **match_info, GError             **error);
gboolean g_regex_match_all(const GRegex        *regex, const gchar         *string, GRegexMatchFlags     match_options, GMatchInfo         **match_info);
gboolean g_regex_match_full(const GRegex        *regex, const gchar         *string, gssize               string_len, gint                 start_position, GRegexMatchFlags     match_options, GMatchInfo         **match_info, GError             **error);
gboolean g_regex_match(const GRegex        *regex, const gchar         *string, GRegexMatchFlags     match_options, GMatchInfo         **match_info);
gboolean g_regex_match_simple(const gchar         *pattern, const gchar         *string, GRegexCompileFlags   compile_options, GRegexMatchFlags     match_options);
GRegexMatchFlags g_regex_get_match_flags(const GRegex        *regex);
GRegexCompileFlags g_regex_get_compile_flags(const GRegex        *regex);
gchar 		 * g_regex_escape_nul(const gchar         *string, gint                 length);
gchar 		 * g_regex_escape_string(const gchar         *string, gint                 length);
gint g_regex_get_string_number(const GRegex        *regex, const gchar         *name);
gint g_regex_get_max_lookbehind(const GRegex        *regex);
gboolean g_regex_get_has_cr_or_lf(const GRegex        *regex);
gint g_regex_get_capture_count(const GRegex        *regex);
gint g_regex_get_max_backref(const GRegex        *regex);
const gchar 	 * g_regex_get_pattern(const GRegex        *regex);
void g_regex_unref(GRegex              *regex);
GRegex            * g_regex_ref(GRegex              *regex);
GRegex 		 * g_regex_new(const gchar         *pattern, GRegexCompileFlags   compile_options, GRegexMatchFlags     match_options, GError             **error);
GQuark g_regex_error_quark(void);
gdouble g_random_double_range(gdouble  begin, gdouble  end);
gdouble g_random_double(void);
gint32 g_random_int_range(gint32   begin, gint32   end);
guint32 g_random_int(void);
void g_random_set_seed(guint32  seed);
gdouble g_rand_double_range(GRand   *rand_, gdouble  begin, gdouble  end);
gdouble g_rand_double(GRand   *rand_);
gint32 g_rand_int_range(GRand   *rand_, gint32   begin, gint32   end);
guint32 g_rand_int(GRand   *rand_);
void g_rand_set_seed_array(GRand   *rand_, const guint32 *seed, guint    seed_length);
void g_rand_set_seed(GRand   *rand_, guint32  seed);
GRand * g_rand_copy(GRand   *rand_);
void g_rand_free(GRand   *rand_);
GRand * g_rand_new(void);
GRand * g_rand_new_with_seed_array(const guint32 *seed, guint seed_length);
GRand * g_rand_new_with_seed(guint32  seed);
void g_queue_delete_link(GQueue           *queue, GList            *link_);
void g_queue_unlink(GQueue           *queue, GList            *link_);
gint g_queue_link_index(GQueue           *queue, GList            *link_);
GList * g_queue_peek_nth_link(GQueue           *queue, guint             n);
GList * g_queue_peek_tail_link(GQueue           *queue);
GList * g_queue_peek_head_link(GQueue           *queue);
GList * g_queue_pop_nth_link(GQueue           *queue, guint             n);
GList * g_queue_pop_tail_link(GQueue           *queue);
GList * g_queue_pop_head_link(GQueue           *queue);
void g_queue_push_nth_link(GQueue           *queue, gint              n, GList            *link_);
void g_queue_push_tail_link(GQueue           *queue, GList            *link_);
void g_queue_push_head_link(GQueue           *queue, GList            *link_);
void g_queue_insert_sorted(GQueue           *queue, gpointer          data, GCompareDataFunc  func, gpointer          user_data);
void g_queue_insert_after(GQueue           *queue, GList            *sibling, gpointer          data);
void g_queue_insert_before(GQueue           *queue, GList            *sibling, gpointer          data);
guint g_queue_remove_all(GQueue           *queue, gconstpointer     data);
gboolean g_queue_remove(GQueue           *queue, gconstpointer     data);
gint g_queue_index(GQueue           *queue, gconstpointer     data);
gpointer g_queue_peek_nth(GQueue           *queue, guint             n);
gpointer g_queue_peek_tail(GQueue           *queue);
gpointer g_queue_peek_head(GQueue           *queue);
gpointer g_queue_pop_nth(GQueue           *queue, guint             n);
gpointer g_queue_pop_tail(GQueue           *queue);
gpointer g_queue_pop_head(GQueue           *queue);
void g_queue_push_nth(GQueue           *queue, gpointer          data, gint              n);
void g_queue_push_tail(GQueue           *queue, gpointer          data);
void g_queue_push_head(GQueue           *queue, gpointer          data);
void g_queue_sort(GQueue           *queue, GCompareDataFunc  compare_func, gpointer          user_data);
GList  * g_queue_find_custom(GQueue           *queue, gconstpointer     data, GCompareFunc      func);
GList  * g_queue_find(GQueue           *queue, gconstpointer     data);
void g_queue_foreach(GQueue           *queue, GFunc             func, gpointer          user_data);
GQueue  * g_queue_copy(GQueue           *queue);
void g_queue_reverse(GQueue           *queue);
guint g_queue_get_length(GQueue           *queue);
gboolean g_queue_is_empty(GQueue           *queue);
void g_queue_clear(GQueue           *queue);
void g_queue_init(GQueue           *queue);
void g_queue_free_full(GQueue           *queue, GDestroyNotify    free_func);
void g_queue_free(GQueue           *queue);
GQueue * g_queue_new(void);
const gchar  * g_intern_static_string(const gchar *string);
const gchar  * g_intern_string(const gchar *string);
const gchar  * g_quark_to_string(GQuark       quark);
GQuark g_quark_from_string(const gchar *string);
GQuark g_quark_from_static_string(const gchar *string);
GQuark g_quark_try_string(const gchar *string);
void g_qsort_with_data(gconstpointer    pbase, gint             total_elems, gsize            size, GCompareDataFunc compare_func, gpointer         user_data);
gint g_vasprintf(gchar      **string, gchar const *format, va_list      args);
gint g_vsprintf(gchar       *string, gchar const *format, va_list      args);
gint g_vfprintf(FILE        *file, gchar const *format, va_list      args);
gint g_vprintf(gchar const *format, va_list      args);
gint g_sprintf(gchar       *string, gchar const *format, ...);
gint g_fprintf(FILE        *file, gchar const *format, ...);
gint g_printf(gchar const *format, ...);
guint g_spaced_primes_closest(guint num);
gint g_poll(GPollFD *fds, guint    nfds, gint     timeout);
gboolean g_pattern_match_simple(const gchar  *pattern, const gchar  *string);
gboolean g_pattern_match_string(GPatternSpec *pspec, const gchar  *string);
gboolean g_pattern_match(GPatternSpec *pspec, guint         string_length, const gchar  *string, const gchar  *string_reversed);
gboolean g_pattern_spec_equal(GPatternSpec *pspec1, GPatternSpec *pspec2);
void g_pattern_spec_free(GPatternSpec *pspec);
GPatternSpec * g_pattern_spec_new(const gchar  *pattern);
void g_option_group_set_translation_domain(GOptionGroup       *group, const gchar        *domain);
void g_option_group_set_translate_func(GOptionGroup       *group, GTranslateFunc      func, gpointer            data, GDestroyNotify      destroy_notify);
void g_option_group_add_entries(GOptionGroup       *group, const GOptionEntry *entries);
void g_option_group_unref(GOptionGroup       *group);
GOptionGroup  * g_option_group_ref(GOptionGroup       *group);
void g_option_group_free(GOptionGroup       *group);
void g_option_group_set_error_hook(GOptionGroup       *group, GOptionErrorFunc	 error_func);
void g_option_group_set_parse_hooks(GOptionGroup       *group, GOptionParseFunc    pre_parse_func, GOptionParseFunc	 post_parse_func);
GOptionGroup  * g_option_group_new(const gchar        *name, const gchar        *description, const gchar        *help_description, gpointer            user_data, GDestroyNotify      destroy);
gchar         * g_option_context_get_help(GOptionContext *context, gboolean        main_help, GOptionGroup   *group);
GOptionGroup  * g_option_context_get_main_group(GOptionContext *context);
void g_option_context_set_main_group(GOptionContext *context, GOptionGroup   *group);
void g_option_context_add_group(GOptionContext *context, GOptionGroup   *group);
void g_option_context_set_translation_domain(GOptionContext  *context, const gchar     *domain);
void g_option_context_set_translate_func(GOptionContext     *context, GTranslateFunc      func, gpointer            data, GDestroyNotify      destroy_notify);
gboolean g_option_context_parse_strv(GOptionContext      *context, gchar             ***arguments, GError             **error);
gboolean g_option_context_parse(GOptionContext      *context, gint                *argc, gchar             ***argv, GError             **error);
void g_option_context_add_main_entries(GOptionContext      *context, const GOptionEntry  *entries, const gchar         *translation_domain);
gboolean g_option_context_get_strict_posix(GOptionContext *context);
void g_option_context_set_strict_posix(GOptionContext *context, gboolean        strict_posix);
gboolean g_option_context_get_ignore_unknown_options(GOptionContext *context);
void g_option_context_set_ignore_unknown_options(GOptionContext *context, gboolean	     ignore_unknown);
gboolean g_option_context_get_help_enabled(GOptionContext      *context);
void g_option_context_set_help_enabled(GOptionContext      *context, gboolean		help_enabled);
void g_option_context_free(GOptionContext      *context);
const gchar  * g_option_context_get_description(GOptionContext     *context);
void g_option_context_set_description(GOptionContext      *context, const gchar         *description);
const gchar  * g_option_context_get_summary(GOptionContext     *context);
void g_option_context_set_summary(GOptionContext      *context, const gchar         *summary);
GOptionContext  * g_option_context_new(const gchar         *parameter_string);
GQuark g_option_error_quark(void);
GNode * g_node_last_sibling(GNode		  *node);
GNode * g_node_first_sibling(GNode		  *node);
gint g_node_child_index(GNode		  *node, gpointer	   data);
gint g_node_child_position(GNode		  *node, GNode		  *child);
GNode * g_node_find_child(GNode		  *node, GTraverseFlags   flags, gpointer	   data);
GNode * g_node_last_child(GNode		  *node);
GNode * g_node_nth_child(GNode		  *node, guint		   n);
guint g_node_n_children(GNode		  *node);
void g_node_reverse_children(GNode		  *node);
void g_node_children_foreach(GNode		  *node, GTraverseFlags   flags, GNodeForeachFunc func, gpointer	   data);
guint g_node_max_height(GNode *root);
void g_node_traverse(GNode		  *root, GTraverseType	   order, GTraverseFlags	   flags, gint		   max_depth, GNodeTraverseFunc func, gpointer	   data);
GNode * g_node_find(GNode		  *root, GTraverseType	   order, GTraverseFlags	   flags, gpointer	   data);
guint g_node_depth(GNode		  *node);
gboolean g_node_is_ancestor(GNode		  *node, GNode		  *descendant);
GNode * g_node_get_root(GNode		  *node);
guint g_node_n_nodes(GNode		  *root, GTraverseFlags	   flags);
GNode * g_node_prepend(GNode		  *parent, GNode		  *node);
GNode * g_node_insert_after(GNode            *parent, GNode            *sibling, GNode            *node);
GNode * g_node_insert_before(GNode		  *parent, GNode		  *sibling, GNode		  *node);
GNode * g_node_insert(GNode		  *parent, gint		   position, GNode		  *node);
GNode * g_node_copy(GNode            *node);
GNode * g_node_copy_deep(GNode            *node, GCopyFunc         copy_func, gpointer          data);
void g_node_unlink(GNode		  *node);
void g_node_destroy(GNode		  *root);
GNode * g_node_new(gpointer	   data);
GPrintFunc g_set_printerr_handler(GPrintFunc      func);
void g_printerr(const gchar    *format, ...);
GPrintFunc g_set_print_handler(GPrintFunc      func);
void g_print(const gchar    *format, ...);
void g_log_structured_standard(const gchar    *log_domain, GLogLevelFlags  log_level, const gchar    *file, const gchar    *line, const gchar    *func, const gchar    *message_format, ...);
void g_return_if_fail_warning(const char *log_domain, const char *pretty_function, const char *expression) G_ANALYZER_NORETURN; GLIB_AVAILABLE_IN_ALL void g_warn_message           (const char     *domain, const char     *file, int             line, const char     *func, const char     *warnexpr) G_ANALYZER_NORETURN; GLIB_DEPRECATED void g_assert_warning         (const char *log_domain, const char *file, const int   line, const char *pretty_function, const char *expression);
GLogWriterOutput g_log_writer_default(GLogLevelFlags   log_level, const GLogField *fields, gsize            n_fields, gpointer         user_data);
GLogWriterOutput g_log_writer_standard_streams(GLogLevelFlags   log_level, const GLogField *fields, gsize            n_fields, gpointer         user_data);
GLogWriterOutput g_log_writer_journald(GLogLevelFlags   log_level, const GLogField *fields, gsize            n_fields, gpointer         user_data);
gchar            * g_log_writer_format_fields(GLogLevelFlags   log_level, const GLogField *fields, gsize            n_fields, gboolean         use_color);
gboolean g_log_writer_is_journald(gint             output_fd);
gboolean g_log_writer_supports_color(gint             output_fd);
void g_log_set_writer_func(GLogWriterFunc   func, gpointer         user_data, GDestroyNotify   user_data_free);
void g_log_variant(const gchar     *log_domain, GLogLevelFlags   log_level, GVariant        *fields);
void g_log_structured_array(GLogLevelFlags   log_level, const GLogField *fields, gsize            n_fields);
void g_log_structured(const gchar     *log_domain, GLogLevelFlags   log_level, ...);
GLogLevelFlags g_log_set_always_fatal(GLogLevelFlags  fatal_mask);
GLogLevelFlags g_log_set_fatal_mask(const gchar    *log_domain, GLogLevelFlags  fatal_mask);
void g_logv(const gchar    *log_domain, GLogLevelFlags  log_level, const gchar    *format, va_list         args);
void g_log(const gchar    *log_domain, GLogLevelFlags  log_level, const gchar    *format, ...);
GLogFunc g_log_set_default_handler(GLogFunc      log_func, gpointer      user_data);
void g_log_default_handler(const gchar    *log_domain, GLogLevelFlags  log_level, const gchar    *message, gpointer        unused_data);
void g_log_remove_handler(const gchar    *log_domain, guint           handler_id);
guint g_log_set_handler_full(const gchar    *log_domain, GLogLevelFlags  log_levels, GLogFunc        log_func, gpointer        user_data, GDestroyNotify  destroy);
guint g_log_set_handler(const gchar    *log_domain, GLogLevelFlags  log_levels, GLogFunc        log_func, gpointer        user_data);
gsize g_printf_string_upper_bound(const gchar* format, va_list	  args);
void g_mem_profile(void);
gboolean g_mem_is_system_malloc(void);
void g_mem_set_vtable(GMemVTable	*vtable);
gpointer g_steal_pointer(gpointer pp);
gpointer g_try_realloc_n(gpointer	 mem, gsize	 n_blocks, gsize	 n_block_bytes);
gpointer g_try_malloc0_n(gsize	 n_blocks, gsize	 n_block_bytes);
gpointer g_try_malloc_n(gsize	 n_blocks, gsize	 n_block_bytes);
gpointer g_realloc_n(gpointer	 mem, gsize	 n_blocks, gsize	 n_block_bytes);
gpointer g_malloc0_n(gsize	 n_blocks, gsize	 n_block_bytes);
gpointer g_malloc_n(gsize	 n_blocks, gsize	 n_block_bytes);
gpointer g_try_realloc(gpointer	 mem, gsize	 n_bytes);
gpointer g_try_malloc0(gsize	 n_bytes);
gpointer g_try_malloc(gsize	 n_bytes);
gpointer g_realloc(gpointer	 mem, gsize	 n_bytes);
gpointer g_malloc0(gsize	 n_bytes);
gpointer g_malloc(gsize	 n_bytes);
void g_clear_pointer(gpointer      *pp, GDestroyNotify destroy);
void g_free(gpointer	 mem);
gboolean g_markup_collect_attributes(const gchar         *element_name, const gchar        **attribute_names, const gchar        **attribute_values, GError             **error, GMarkupCollectType   first_type, const gchar         *first_attr, ...);
gchar  * g_markup_vprintf_escaped(const char *format, va_list     args);
gchar  * g_markup_printf_escaped(const char *format, ...);
gchar * g_markup_escape_text(const gchar *text, gssize       length);
gpointer g_markup_parse_context_get_user_data(GMarkupParseContext *context);
void g_markup_parse_context_get_position(GMarkupParseContext *context, gint                *line_number, gint                *char_number);
const GSList  * g_markup_parse_context_get_element_stack(GMarkupParseContext *context);
const gchar  * g_markup_parse_context_get_element(GMarkupParseContext *context);
gboolean g_markup_parse_context_end_parse(GMarkupParseContext *context, GError             **error);
gpointer g_markup_parse_context_pop(GMarkupParseContext *context);
void g_markup_parse_context_push(GMarkupParseContext *context, const GMarkupParser *parser, gpointer             user_data);
gboolean g_markup_parse_context_parse(GMarkupParseContext *context, const gchar         *text, gssize               text_len, GError             **error);
void g_markup_parse_context_free(GMarkupParseContext *context);
void g_markup_parse_context_unref(GMarkupParseContext *context);
GMarkupParseContext  * g_markup_parse_context_ref(GMarkupParseContext *context);
GMarkupParseContext  * g_markup_parse_context_new(const GMarkupParser *parser, GMarkupParseFlags    flags, gpointer             user_data, GDestroyNotify       user_data_dnotify);
GQuark g_markup_error_quark(void);
void g_mapped_file_free(GMappedFile  *file);
void g_mapped_file_unref(GMappedFile  *file);
GMappedFile  * g_mapped_file_ref(GMappedFile  *file);
GBytes  * g_mapped_file_get_bytes(GMappedFile  *file);
gchar        * g_mapped_file_get_contents(GMappedFile  *file);
gsize g_mapped_file_get_length(GMappedFile  *file);
GMappedFile  * g_mapped_file_new_from_fd(gint          fd, gboolean      writable, GError      **error);
GMappedFile  * g_mapped_file_new(const gchar  *filename, gboolean      writable, GError      **error);
void g_main_context_invoke(GMainContext   *context, GSourceFunc     function, gpointer        data);
void g_main_context_invoke_full(GMainContext   *context, gint            priority, GSourceFunc     function, gpointer        data, GDestroyNotify  notify);
gboolean g_idle_remove_by_data(gpointer        data);
guint g_idle_add_full(gint            priority, GSourceFunc     function, gpointer        data, GDestroyNotify  notify);
guint g_idle_add(GSourceFunc     function, gpointer        data);
guint g_child_watch_add(GPid            pid, GChildWatchFunc function, gpointer        data);
guint g_child_watch_add_full(gint            priority, GPid            pid, GChildWatchFunc function, gpointer        data, GDestroyNotify  notify);
guint g_timeout_add_seconds(guint           interval, GSourceFunc     function, gpointer        data);
guint g_timeout_add_seconds_full(gint            priority, guint           interval, GSourceFunc     function, gpointer        data, GDestroyNotify  notify);
guint g_timeout_add(guint           interval, GSourceFunc     function, gpointer        data);
guint g_timeout_add_full(gint            priority, guint           interval, GSourceFunc     function, gpointer        data, GDestroyNotify  notify);
void g_clear_handle_id(guint           *tag_ptr, GClearHandleFunc clear_func);
gboolean g_source_remove_by_funcs_user_data(GSourceFuncs  *funcs, gpointer       user_data);
gboolean g_source_remove_by_user_data(gpointer       user_data);
gboolean g_source_remove(guint          tag);
gint64 g_get_real_time(void);
gint64 g_get_monotonic_time(void);
void g_get_current_time(GTimeVal       *result);
GSource  * g_timeout_source_new_seconds(guint interval);
GSource  * g_timeout_source_new(guint interval);
GSource  * g_child_watch_source_new(GPid pid);
GSource  * g_idle_source_new(void);
gint64 g_source_get_time(GSource        *source);
void g_source_get_current_time(GSource        *source, GTimeVal       *timeval);
void g_source_remove_child_source(GSource        *source, GSource        *child_source);
void g_source_add_child_source(GSource        *source, GSource        *child_source);
void g_source_remove_poll(GSource        *source, GPollFD        *fd);
void g_source_add_poll(GSource        *source, GPollFD        *fd);
void g_source_set_callback_indirect(GSource              *source, gpointer              callback_data, GSourceCallbackFuncs *callback_funcs);
GIOCondition g_source_query_unix_fd(GSource        *source, gpointer        tag);
void g_source_remove_unix_fd(GSource        *source, gpointer        tag);
void g_source_modify_unix_fd(GSource        *source, gpointer        tag, GIOCondition    new_events);
gpointer g_source_add_unix_fd(GSource        *source, gint            fd, GIOCondition    events);
gint64 g_source_get_ready_time(GSource        *source);
void g_source_set_ready_time(GSource        *source, gint64          ready_time);
void g_source_set_name_by_id(guint           tag, const char     *name);
const char  * g_source_get_name(GSource        *source);
void g_source_set_name(GSource        *source, const char     *name);
gboolean g_source_is_destroyed(GSource        *source);
void g_source_set_funcs(GSource        *source, GSourceFuncs   *funcs);
void g_source_set_callback(GSource        *source, GSourceFunc     func, gpointer        data, GDestroyNotify  notify);
GMainContext  * g_source_get_context(GSource       *source);
guint g_source_get_id(GSource        *source);
gboolean g_source_get_can_recurse(GSource        *source);
void g_source_set_can_recurse(GSource        *source, gboolean        can_recurse);
gint g_source_get_priority(GSource        *source);
void g_source_set_priority(GSource        *source, gint            priority);
void g_source_destroy(GSource        *source);
guint g_source_attach(GSource        *source, GMainContext   *context);
void g_source_unref(GSource        *source);
GSource  * g_source_ref(GSource        *source);
GSource  * g_source_new(GSourceFuncs   *source_funcs, guint           struct_size);
GMainContext  * g_main_loop_get_context(GMainLoop    *loop);
gboolean g_main_loop_is_running(GMainLoop    *loop);
void g_main_loop_unref(GMainLoop    *loop);
GMainLoop  * g_main_loop_ref(GMainLoop    *loop);
void g_main_loop_quit(GMainLoop    *loop);
void g_main_loop_run(GMainLoop    *loop);
GMainLoop  * g_main_loop_new(GMainContext *context, gboolean      is_running);
GMainContext  * g_main_context_ref_thread_default(void);
GMainContext  * g_main_context_get_thread_default(void);
void g_main_context_pop_thread_default(GMainContext *context);
void g_main_context_push_thread_default(GMainContext *context);
GSource  * g_main_current_source(void);
gint g_main_depth(void);
void g_main_context_remove_poll(GMainContext *context, GPollFD      *fd);
void g_main_context_add_poll(GMainContext *context, GPollFD      *fd, gint          priority);
GPollFunc g_main_context_get_poll_func(GMainContext *context);
void g_main_context_set_poll_func(GMainContext *context, GPollFunc     func);
void g_main_context_dispatch(GMainContext *context);
gboolean g_main_context_check(GMainContext *context, gint          max_priority, GPollFD      *fds, gint          n_fds);
gint g_main_context_query(GMainContext *context, gint          max_priority, gint         *timeout_, GPollFD      *fds, gint          n_fds);
gboolean g_main_context_prepare(GMainContext *context, gint         *priority);
gboolean g_main_context_wait(GMainContext *context, GCond        *cond, GMutex       *mutex);
gboolean g_main_context_is_owner(GMainContext *context);
void g_main_context_release(GMainContext *context);
gboolean g_main_context_acquire(GMainContext *context);
void g_main_context_wakeup(GMainContext *context);
GSource       * g_main_context_find_source_by_funcs_user_data(GMainContext *context, GSourceFuncs *funcs, gpointer      user_data);
GSource       * g_main_context_find_source_by_user_data(GMainContext *context, gpointer      user_data);
GSource       * g_main_context_find_source_by_id(GMainContext *context, guint         source_id);
gboolean g_main_context_pending(GMainContext *context);
gboolean g_main_context_iteration(GMainContext *context, gboolean      may_block);
GMainContext  * g_main_context_default(void);
void g_main_context_unref(GMainContext *context);
GMainContext  * g_main_context_ref(GMainContext *context);
GMainContext  * g_main_context_new(void);
gpointer g_list_nth_data(GList            *list, guint             n);
GList * g_list_sort_with_data(GList            *list, GCompareDataFunc  compare_func, gpointer          user_data);
GList * g_list_sort(GList            *list, GCompareFunc      compare_func);
void g_list_foreach(GList            *list, GFunc             func, gpointer          user_data);
guint g_list_length(GList            *list);
GList * g_list_first(GList            *list);
GList * g_list_last(GList            *list);
gint g_list_index(GList            *list, gconstpointer     data);
gint g_list_position(GList            *list, GList            *llink);
GList * g_list_find_custom(GList            *list, gconstpointer     data, GCompareFunc      func);
GList * g_list_find(GList            *list, gconstpointer     data);
GList * g_list_nth_prev(GList            *list, guint             n);
GList * g_list_nth(GList            *list, guint             n);
GList * g_list_copy_deep(GList            *list, GCopyFunc         func, gpointer          user_data);
GList * g_list_copy(GList            *list);
GList * g_list_reverse(GList            *list);
GList * g_list_delete_link(GList            *list, GList            *link_);
GList * g_list_remove_link(GList            *list, GList            *llink);
GList * g_list_remove_all(GList            *list, gconstpointer     data);
GList * g_list_remove(GList            *list, gconstpointer     data);
GList * g_list_concat(GList            *list1, GList            *list2);
GList * g_list_insert_before(GList            *list, GList            *sibling, gpointer          data);
GList * g_list_insert_sorted_with_data(GList            *list, gpointer          data, GCompareDataFunc  func, gpointer          user_data);
GList * g_list_insert_sorted(GList            *list, gpointer          data, GCompareFunc      func);
GList * g_list_insert(GList            *list, gpointer          data, gint              position);
GList * g_list_prepend(GList            *list, gpointer          data);
GList * g_list_append(GList            *list, gpointer          data);
void g_list_free_full(GList            *list, GDestroyNotify    free_func);
void g_list_free_1(GList            *list);
void g_list_free(GList            *list);
GList * g_list_alloc(void);
guint g_unix_fd_add(gint              fd, GIOCondition      condition, GUnixFDSourceFunc function, gpointer          user_data);
guint g_unix_fd_add_full(gint              priority, gint              fd, GIOCondition      condition, GUnixFDSourceFunc function, gpointer          user_data, GDestroyNotify    notify);
GSource  * g_unix_fd_source_new(gint         fd, GIOCondition condition);
guint g_unix_signal_add(gint        signum, GSourceFunc handler, gpointer    user_data);
guint g_unix_signal_add_full(gint           priority, gint           signum, GSourceFunc    handler, gpointer       user_data, GDestroyNotify notify);
GSource  * g_unix_signal_source_new(gint signum);
gboolean g_unix_set_fd_nonblocking(gint       fd, gboolean   nonblock, GError   **error);
gboolean g_unix_open_pipe(gint    *fds, gint     flags, GError **error);
GQuark g_unix_error_quark(void);
void g_autoptr_cleanup_gstring_free(GString *string);
void g_autoptr_cleanup_generic_gfree(void *p);
gboolean g_key_file_remove_group(GKeyFile             *key_file, const gchar          *group_name, GError              **error);
gboolean g_key_file_remove_key(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
gboolean g_key_file_remove_comment(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
gchar     * g_key_file_get_comment(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
gboolean g_key_file_set_comment(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *comment, GError              **error);
void g_key_file_set_integer_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gint                  list[], gsize                 length);
gdouble   * g_key_file_get_double_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gsize                *length, GError              **error);
void g_key_file_set_double_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gdouble               list[], gsize                 length);
gint      * g_key_file_get_integer_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gsize                *length, GError              **error);
void g_key_file_set_boolean_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gboolean              list[], gsize                 length);
gboolean  * g_key_file_get_boolean_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gsize                *length, GError              **error);
void g_key_file_set_locale_string_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *locale, const gchar * const   list[], gsize                 length);
gchar    ** g_key_file_get_locale_string_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *locale, gsize                *length, GError              **error);
void g_key_file_set_string_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar * const   list[], gsize                 length);
gchar    ** g_key_file_get_string_list(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gsize                *length, GError              **error);
void g_key_file_set_double(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gdouble               value);
gdouble g_key_file_get_double(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
void g_key_file_set_uint64(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, guint64               value);
guint64 g_key_file_get_uint64(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
void g_key_file_set_int64(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gint64                value);
gint64 g_key_file_get_int64(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
void g_key_file_set_integer(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gint                  value);
gint g_key_file_get_integer(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
void g_key_file_set_boolean(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, gboolean              value);
gboolean g_key_file_get_boolean(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
void g_key_file_set_locale_string(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *locale, const gchar          *string);
gchar     * g_key_file_get_locale_for_key(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *locale);
gchar     * g_key_file_get_locale_string(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *locale, GError              **error);
void g_key_file_set_string(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *string);
gchar     * g_key_file_get_string(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
void g_key_file_set_value(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, const gchar          *value);
gchar     * g_key_file_get_value(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
gboolean g_key_file_has_key(GKeyFile             *key_file, const gchar          *group_name, const gchar          *key, GError              **error);
gboolean g_key_file_has_group(GKeyFile             *key_file, const gchar          *group_name);
gchar    ** g_key_file_get_keys(GKeyFile             *key_file, const gchar          *group_name, gsize                *length, GError              **error);
gchar    ** g_key_file_get_groups(GKeyFile             *key_file, gsize                *length);
gchar     * g_key_file_get_start_group(GKeyFile             *key_file);
gboolean g_key_file_save_to_file(GKeyFile             *key_file, const gchar          *filename, GError              **error);
gchar     * g_key_file_to_data(GKeyFile             *key_file, gsize                *length, GError              **error);
gboolean g_key_file_load_from_data_dirs(GKeyFile             *key_file, const gchar          *file, gchar               **full_path, GKeyFileFlags         flags, GError              **error);
gboolean g_key_file_load_from_dirs(GKeyFile             *key_file, const gchar	  *file, const gchar	 **search_dirs, gchar		 **full_path, GKeyFileFlags         flags, GError              **error);
gboolean g_key_file_load_from_bytes(GKeyFile             *key_file, GBytes               *bytes, GKeyFileFlags         flags, GError              **error);
gboolean g_key_file_load_from_data(GKeyFile             *key_file, const gchar          *data, gsize                 length, GKeyFileFlags         flags, GError              **error);
gboolean g_key_file_load_from_file(GKeyFile             *key_file, const gchar          *file, GKeyFileFlags         flags, GError              **error);
void g_key_file_set_list_separator(GKeyFile             *key_file, gchar                 separator);
void g_key_file_free(GKeyFile             *key_file);
void g_key_file_unref(GKeyFile             *key_file);
GKeyFile  * g_key_file_ref(GKeyFile             *key_file);
GKeyFile  * g_key_file_new(void);
GQuark g_key_file_error_quark(void);
void g_io_channel_win32_set_debug(GIOChannel *channel, gboolean    flag);
GIOChannel  * g_io_channel_win32_new_stream_socket(gint socket);
GIOChannel  * g_io_channel_win32_new_socket(gint socket);
gint g_io_channel_win32_get_fd(GIOChannel *channel);
GIOChannel * g_io_channel_win32_new_fd(gint         fd);
GIOChannel  * g_io_channel_win32_new_messages(gsize hwnd);
gint g_io_channel_win32_poll(GPollFD    *fds, gint        n_fds, gint        timeout_);
void g_io_channel_win32_make_pollfd(GIOChannel   *channel, GIOCondition  condition, GPollFD      *fd);
gint g_io_channel_unix_get_fd(GIOChannel *channel);
GIOChannel * g_io_channel_unix_new(int         fd);
GIOChannelError g_io_channel_error_from_errno(gint en);
GQuark g_io_channel_error_quark(void);
GIOChannel * g_io_channel_new_file(const gchar  *filename, const gchar  *mode, GError      **error);
GIOStatus g_io_channel_seek_position(GIOChannel   *channel, gint64        offset, GSeekType     type, GError      **error);
GIOStatus g_io_channel_write_unichar(GIOChannel   *channel, gunichar      thechar, GError      **error);
GIOStatus g_io_channel_write_chars(GIOChannel   *channel, const gchar  *buf, gssize        count, gsize        *bytes_written, GError      **error);
GIOStatus g_io_channel_read_unichar(GIOChannel   *channel, gunichar     *thechar, GError      **error);
GIOStatus g_io_channel_read_chars(GIOChannel   *channel, gchar        *buf, gsize         count, gsize        *bytes_read, GError      **error);
GIOStatus g_io_channel_read_to_end(GIOChannel   *channel, gchar       **str_return, gsize        *length, GError      **error);
GIOStatus g_io_channel_read_line_string(GIOChannel   *channel, GString      *buffer, gsize        *terminator_pos, GError      **error);
GIOStatus g_io_channel_read_line(GIOChannel   *channel, gchar       **str_return, gsize        *length, gsize        *terminator_pos, GError      **error);
GIOStatus g_io_channel_flush(GIOChannel   *channel, GError      **error);
gboolean g_io_channel_get_close_on_unref(GIOChannel   *channel);
void g_io_channel_set_close_on_unref(GIOChannel   *channel, gboolean      do_close);
const gchar  * g_io_channel_get_encoding(GIOChannel   *channel);
GIOStatus g_io_channel_set_encoding(GIOChannel   *channel, const gchar  *encoding, GError      **error);
gboolean g_io_channel_get_buffered(GIOChannel   *channel);
void g_io_channel_set_buffered(GIOChannel   *channel, gboolean      buffered);
const gchar  * g_io_channel_get_line_term(GIOChannel   *channel, gint         *length);
void g_io_channel_set_line_term(GIOChannel   *channel, const gchar  *line_term, gint          length);
GIOFlags g_io_channel_get_flags(GIOChannel   *channel);
GIOStatus g_io_channel_set_flags(GIOChannel   *channel, GIOFlags      flags, GError      **error);
GIOCondition g_io_channel_get_buffer_condition(GIOChannel   *channel);
gsize g_io_channel_get_buffer_size(GIOChannel   *channel);
void g_io_channel_set_buffer_size(GIOChannel   *channel, gsize         size);
guint g_io_add_watch(GIOChannel      *channel, GIOCondition     condition, GIOFunc          func, gpointer         user_data);
GSource  * g_io_create_watch(GIOChannel      *channel, GIOCondition     condition);
guint g_io_add_watch_full(GIOChannel      *channel, gint             priority, GIOCondition     condition, GIOFunc          func, gpointer         user_data, GDestroyNotify   notify);
GIOStatus g_io_channel_shutdown(GIOChannel      *channel, gboolean         flush, GError         **err);
void g_io_channel_close(GIOChannel    *channel);
GIOError g_io_channel_seek(GIOChannel    *channel, gint64         offset, GSeekType      type);
GIOError g_io_channel_write(GIOChannel    *channel, const gchar   *buf, gsize          count, gsize         *bytes_written);
GIOError g_io_channel_read(GIOChannel    *channel, gchar         *buf, gsize          count, gsize         *bytes_read);
void g_io_channel_unref(GIOChannel    *channel);
GIOChannel  * g_io_channel_ref(GIOChannel    *channel);
void g_io_channel_init(GIOChannel    *channel);
gchar     * g_hostname_to_unicode(const gchar *hostname);
gchar     * g_hostname_to_ascii(const gchar *hostname);
gboolean g_hostname_is_ip_address(const gchar *hostname);
gboolean g_hostname_is_ascii_encoded(const gchar *hostname);
gboolean g_hostname_is_non_ascii(const gchar *hostname);
void g_hook_list_marshal_check(GHookList		*hook_list, gboolean		 may_recurse, GHookCheckMarshaller	 marshaller, gpointer		 marshal_data);
void g_hook_list_marshal(GHookList		*hook_list, gboolean		 may_recurse, GHookMarshaller	 marshaller, gpointer		 marshal_data);
void g_hook_list_invoke_check(GHookList		*hook_list, gboolean		 may_recurse);
void g_hook_list_invoke(GHookList		*hook_list, gboolean		 may_recurse);
gint g_hook_compare_ids(GHook			*new_hook, GHook			*sibling);
GHook * g_hook_next_valid(GHookList		*hook_list, GHook			*hook, gboolean		 may_be_in_call);
GHook * g_hook_first_valid(GHookList		*hook_list, gboolean		 may_be_in_call);
GHook * g_hook_find_func_data(GHookList		*hook_list, gboolean		 need_valids, gpointer		 func, gpointer		 data);
GHook * g_hook_find_func(GHookList		*hook_list, gboolean		 need_valids, gpointer		 func);
GHook * g_hook_find_data(GHookList		*hook_list, gboolean		 need_valids, gpointer		 data);
GHook * g_hook_find(GHookList		*hook_list, gboolean		 need_valids, GHookFindFunc		 func, gpointer		 data);
GHook * g_hook_get(GHookList		*hook_list, gulong			 hook_id);
void g_hook_insert_sorted(GHookList		*hook_list, GHook			*hook, GHookCompareFunc	 func);
void g_hook_insert_before(GHookList		*hook_list, GHook			*sibling, GHook			*hook);
void g_hook_prepend(GHookList		*hook_list, GHook			*hook);
void g_hook_destroy_link(GHookList		*hook_list, GHook			*hook);
gboolean g_hook_destroy(GHookList		*hook_list, gulong			 hook_id);
void g_hook_unref(GHookList		*hook_list, GHook			*hook);
GHook  * g_hook_ref(GHookList		*hook_list, GHook			*hook);
void g_hook_free(GHookList		*hook_list, GHook			*hook);
GHook * g_hook_alloc(GHookList		*hook_list);
void g_hook_list_clear(GHookList		*hook_list);
void g_hook_list_init(GHookList		*hook_list, guint			 hook_size);
gchar                * g_compute_hmac_for_bytes(GChecksumType  digest_type, GBytes        *key, GBytes        *data);
gchar                 * g_compute_hmac_for_string(GChecksumType  digest_type, const guchar  *key, gsize          key_len, const gchar   *str, gssize         length);
gchar                 * g_compute_hmac_for_data(GChecksumType  digest_type, const guchar  *key, gsize          key_len, const guchar  *data, gsize          length);
void g_hmac_get_digest(GHmac         *hmac, guint8        *buffer, gsize         *digest_len);
const gchar  * g_hmac_get_string(GHmac         *hmac);
void g_hmac_update(GHmac         *hmac, const guchar  *data, gssize         length);
void g_hmac_unref(GHmac         *hmac);
GHmac  * g_hmac_ref(GHmac         *hmac);
GHmac  * g_hmac_copy(const GHmac   *hmac);
GHmac  * g_hmac_new(GChecksumType  digest_type, const guchar  *key, gsize          key_len);
gboolean g_direct_equal(gconstpointer  v1, gconstpointer  v2);
guint g_direct_hash(gconstpointer  v);
guint g_double_hash(gconstpointer  v);
gboolean g_double_equal(gconstpointer  v1, gconstpointer  v2);
guint g_int64_hash(gconstpointer  v);
gboolean g_int64_equal(gconstpointer  v1, gconstpointer  v2);
guint g_int_hash(gconstpointer  v);
gboolean g_int_equal(gconstpointer  v1, gconstpointer  v2);
guint g_str_hash(gconstpointer  v);
gboolean g_str_equal(gconstpointer  v1, gconstpointer  v2);
void g_hash_table_unref(GHashTable     *hash_table);
GHashTable * g_hash_table_ref(GHashTable     *hash_table);
void g_hash_table_iter_steal(GHashTableIter *iter);
void g_hash_table_iter_replace(GHashTableIter *iter, gpointer        value);
void g_hash_table_iter_remove(GHashTableIter *iter);
GHashTable * g_hash_table_iter_get_hash_table(GHashTableIter *iter);
gboolean g_hash_table_iter_next(GHashTableIter *iter, gpointer       *key, gpointer       *value);
void g_hash_table_iter_init(GHashTableIter *iter, GHashTable     *hash_table);
gpointer  * g_hash_table_get_keys_as_array(GHashTable     *hash_table, guint          *length);
GList  * g_hash_table_get_values(GHashTable     *hash_table);
GList  * g_hash_table_get_keys(GHashTable     *hash_table);
guint g_hash_table_size(GHashTable     *hash_table);
guint g_hash_table_foreach_steal(GHashTable     *hash_table, GHRFunc         func, gpointer        user_data);
guint g_hash_table_foreach_remove(GHashTable     *hash_table, GHRFunc         func, gpointer        user_data);
gpointer g_hash_table_find(GHashTable     *hash_table, GHRFunc         predicate, gpointer        user_data);
void g_hash_table_foreach(GHashTable     *hash_table, GHFunc          func, gpointer        user_data);
gboolean g_hash_table_lookup_extended(GHashTable     *hash_table, gconstpointer   lookup_key, gpointer       *orig_key, gpointer       *value);
gboolean g_hash_table_contains(GHashTable     *hash_table, gconstpointer   key);
gpointer g_hash_table_lookup(GHashTable     *hash_table, gconstpointer   key);
void g_hash_table_steal_all(GHashTable     *hash_table);
gboolean g_hash_table_steal(GHashTable     *hash_table, gconstpointer   key);
void g_hash_table_remove_all(GHashTable     *hash_table);
gboolean g_hash_table_remove(GHashTable     *hash_table, gconstpointer   key);
gboolean g_hash_table_add(GHashTable     *hash_table, gpointer        key);
gboolean g_hash_table_replace(GHashTable     *hash_table, gpointer        key, gpointer        value);
gboolean g_hash_table_insert(GHashTable     *hash_table, gpointer        key, gpointer        value);
void g_hash_table_destroy(GHashTable     *hash_table);
GHashTable * g_hash_table_new_full(GHashFunc       hash_func, GEqualFunc      key_equal_func, GDestroyNotify  key_destroy_func, GDestroyNotify  value_destroy_func);
GHashTable * g_hash_table_new(GHashFunc       hash_func, GEqualFunc      key_equal_func);
const gchar  * g_dpgettext2(const gchar *domain, const gchar *context, const gchar *msgid);
const gchar  * g_dpgettext(const gchar *domain, const gchar *msgctxtid, gsize        msgidoffset);
const gchar  * g_dngettext(const gchar *domain, const gchar *msgid, const gchar *msgid_plural, gulong       n);
const gchar  * g_dcgettext(const gchar *domain, const gchar *msgid, gint         category);
const gchar  * g_dgettext(const gchar *domain, const gchar *msgid);
const gchar  * g_strip_context(const gchar *msgid, const gchar *msgval);
gchar  * g_path_get_dirname(const gchar *file_name);
gchar  * g_path_get_basename(const gchar *file_name);
gchar  * g_get_current_dir(void);
const gchar  * g_basename(const gchar *file_name);
const gchar  * g_path_skip_root(const gchar *file_name);
gboolean g_path_is_absolute(const gchar *file_name);
gint g_mkdir_with_parents(const gchar *pathname, gint         mode);
gchar    * g_build_filename_valist(const gchar  *first_element, va_list      *args);
gchar    * g_build_filenamev(gchar      **args);
gchar    * g_build_filename(const gchar *first_element, ...);
gchar    * g_build_pathv(const gchar  *separator, gchar       **args);
gchar    * g_build_path(const gchar *separator, const gchar *first_element, ...);
gchar    * g_dir_make_tmp(const gchar  *tmpl, GError      **error);
gint g_file_open_tmp(const gchar  *tmpl, gchar       **name_used, GError      **error);
gint g_mkstemp_full(gchar        *tmpl, gint          flags, gint          mode);
gint g_mkstemp(gchar        *tmpl);
gchar    * g_mkdtemp_full(gchar        *tmpl, gint          mode);
gchar    * g_mkdtemp(gchar        *tmpl);
gchar    * g_file_read_link(const gchar  *filename, GError      **error);
gboolean g_file_set_contents(const gchar *filename, const gchar *contents, gssize         length, GError       **error);
gboolean g_file_get_contents(const gchar  *filename, gchar       **contents, gsize        *length, GError      **error);
gboolean g_file_test(const gchar  *filename, GFileTest     test);
GFileError g_file_error_from_errno(gint err_no);
GQuark g_file_error_quark(void);
void g_propagate_prefixed_error(GError       **dest, GError        *src, const gchar   *format, ...);
void g_prefix_error(GError       **err, const gchar   *format, ...);
void g_clear_error(GError       **err);
void g_propagate_error(GError       **dest, GError        *src);
void g_set_error_literal(GError       **err, GQuark         domain, gint           code, const gchar   *message);
void g_set_error(GError       **err, GQuark         domain, gint           code, const gchar   *format, ...);
gboolean g_error_matches(const GError  *error, GQuark         domain, gint           code);
GError * g_error_copy(const GError  *error);
void g_error_free(GError        *error);
GError * g_error_new_valist(GQuark         domain, gint           code, const gchar   *format, va_list        args);
GError * g_error_new_literal(GQuark         domain, gint           code, const gchar   *message);
GError * g_error_new(GQuark         domain, gint           code, const gchar   *format, ...);
gchar  ** g_environ_unsetenv(gchar       **envp, const gchar  *variable);
gchar  ** g_environ_setenv(gchar       **envp, const gchar  *variable, const gchar  *value, gboolean      overwrite);
const gchar  * g_environ_getenv(gchar       **envp, const gchar  *variable);
gchar  ** g_get_environ(void);
gchar  ** g_listenv(void);
void g_unsetenv(const gchar  *variable);
gboolean g_setenv(const gchar  *variable, const gchar  *value, gboolean      overwrite);
const gchar  * g_getenv(const gchar  *variable);
void g_dir_close(GDir         *dir);
void g_dir_rewind(GDir         *dir);
const gchar  * g_dir_read_name(GDir         *dir);
GDir     * g_dir_open(const gchar  *path, guint         flags, GError      **error);
gchar  * g_date_time_format(GDateTime      *datetime, const gchar    *format);
GDateTime  * g_date_time_to_utc(GDateTime      *datetime);
GDateTime  * g_date_time_to_local(GDateTime      *datetime);
GDateTime  * g_date_time_to_timezone(GDateTime      *datetime, GTimeZone      *tz);
gboolean g_date_time_is_daylight_savings(GDateTime      *datetime);
const gchar  * g_date_time_get_timezone_abbreviation(GDateTime      *datetime);
GTimeSpan g_date_time_get_utc_offset(GDateTime      *datetime);
gboolean g_date_time_to_timeval(GDateTime      *datetime, GTimeVal       *tv);
gint64 g_date_time_to_unix(GDateTime      *datetime);
gdouble g_date_time_get_seconds(GDateTime      *datetime);
gint g_date_time_get_microsecond(GDateTime      *datetime);
gint g_date_time_get_second(GDateTime      *datetime);
gint g_date_time_get_minute(GDateTime      *datetime);
gint g_date_time_get_hour(GDateTime      *datetime);
gint g_date_time_get_day_of_year(GDateTime      *datetime);
gint g_date_time_get_day_of_week(GDateTime      *datetime);
gint g_date_time_get_week_of_year(GDateTime      *datetime);
gint g_date_time_get_week_numbering_year(GDateTime      *datetime);
gint g_date_time_get_day_of_month(GDateTime      *datetime);
gint g_date_time_get_month(GDateTime      *datetime);
gint g_date_time_get_year(GDateTime      *datetime);
void g_date_time_get_ymd(GDateTime      *datetime, gint           *year, gint           *month, gint           *day);
gboolean g_date_time_equal(gconstpointer   dt1, gconstpointer   dt2);
guint g_date_time_hash(gconstpointer   datetime);
GTimeSpan g_date_time_difference(GDateTime      *end, GDateTime      *begin);
gint g_date_time_compare(gconstpointer   dt1, gconstpointer   dt2);
GDateTime  * g_date_time_add_full(GDateTime      *datetime, gint            years, gint            months, gint            days, gint            hours, gint            minutes, gdouble         seconds);
GDateTime  * g_date_time_add_seconds(GDateTime      *datetime, gdouble         seconds);
GDateTime  * g_date_time_add_minutes(GDateTime      *datetime, gint            minutes);
GDateTime  * g_date_time_add_hours(GDateTime      *datetime, gint            hours);
GDateTime  * g_date_time_add_days(GDateTime      *datetime, gint            days);
GDateTime  * g_date_time_add_weeks(GDateTime      *datetime, gint            weeks);
GDateTime  * g_date_time_add_months(GDateTime      *datetime, gint            months);
GDateTime  * g_date_time_add_years(GDateTime      *datetime, gint            years);
GDateTime  * g_date_time_add(GDateTime      *datetime, GTimeSpan       timespan);
GDateTime  * g_date_time_new_utc(gint            year, gint            month, gint            day, gint            hour, gint            minute, gdouble         seconds);
GDateTime  * g_date_time_new_local(gint            year, gint            month, gint            day, gint            hour, gint            minute, gdouble         seconds);
GDateTime  * g_date_time_new(GTimeZone      *tz, gint            year, gint            month, gint            day, gint            hour, gint            minute, gdouble         seconds);
GDateTime  * g_date_time_new_from_iso8601(const gchar    *text, GTimeZone      *default_tz);
GDateTime  * g_date_time_new_from_timeval_utc(const GTimeVal *tv);
GDateTime  * g_date_time_new_from_timeval_local(const GTimeVal *tv);
GDateTime  * g_date_time_new_from_unix_utc(gint64          t);
GDateTime  * g_date_time_new_from_unix_local(gint64          t);
GDateTime  * g_date_time_new_now_utc(void);
GDateTime  * g_date_time_new_now_local(void);
GDateTime  * g_date_time_new_now(GTimeZone      *tz);
GDateTime  * g_date_time_ref(GDateTime      *datetime);
void g_date_time_unref(GDateTime      *datetime);
gsize g_date_strftime(gchar       *s, gsize        slen, const gchar *format, const GDate *date);
void g_date_order(GDate *date1, GDate *date2);
void g_date_clamp(GDate *date, const GDate *min_date, const GDate *max_date);
void g_date_to_struct_tm(const GDate *date, struct tm   *tm);
gint g_date_compare(const GDate *lhs, const GDate *rhs);
gint g_date_days_between(const GDate *date1, const GDate *date2);
guint8 g_date_get_sunday_weeks_in_year(GDateYear    year);
guint8 g_date_get_monday_weeks_in_year(GDateYear    year);
guint8 g_date_get_days_in_month(GDateMonth   month, GDateYear    year);
gboolean g_date_is_leap_year(GDateYear    year);
void g_date_subtract_years(GDate       *date, guint        n_years);
void g_date_add_years(GDate       *date, guint        n_years);
void g_date_subtract_months(GDate       *date, guint        n_months);
void g_date_add_months(GDate       *date, guint        n_months);
void g_date_subtract_days(GDate       *date, guint        n_days);
void g_date_add_days(GDate       *date, guint        n_days);
gboolean g_date_is_last_of_month(const GDate *date);
gboolean g_date_is_first_of_month(const GDate *date);
void g_date_set_julian(GDate       *date, guint32      julian_date);
void g_date_set_dmy(GDate       *date, GDateDay     day, GDateMonth   month, GDateYear    y);
void g_date_set_year(GDate       *date, GDateYear    year);
void g_date_set_day(GDate       *date, GDateDay     day);
void g_date_set_month(GDate       *date, GDateMonth   month);
void g_date_set_time(GDate       *date, GTime        time_);
void g_date_set_time_val(GDate       *date, GTimeVal    *timeval);
void g_date_set_time_t(GDate       *date, time_t       timet);
void g_date_set_parse(GDate       *date, const gchar *str);
void g_date_clear(GDate       *date, guint        n_dates);
guint g_date_get_iso8601_week_of_year(const GDate *date);
guint g_date_get_sunday_week_of_year(const GDate *date);
guint g_date_get_monday_week_of_year(const GDate *date);
guint g_date_get_day_of_year(const GDate *date);
guint32 g_date_get_julian(const GDate *date);
GDateDay g_date_get_day(const GDate *date);
GDateYear g_date_get_year(const GDate *date);
GDateMonth g_date_get_month(const GDate *date);
GDateWeekday g_date_get_weekday(const GDate *date);
gboolean g_date_valid_dmy(GDateDay     day, GDateMonth   month, GDateYear    year);
gboolean g_date_valid_julian(guint32 julian_date);
gboolean g_date_valid_weekday(GDateWeekday weekday);
gboolean g_date_valid_year(GDateYear  year);
gboolean g_date_valid_month(GDateMonth month);
gboolean g_date_valid_day(GDateDay     day);
gboolean g_date_valid(const GDate *date);
GDate * g_date_copy(const GDate *date);
void g_date_free(GDate       *date);
GDate * g_date_new_julian(guint32      julian_day);
GDate * g_date_new_dmy(GDateDay     day, GDateMonth   month, GDateYear    year);
GDate * g_date_new(void);
void g_dataset_foreach(gconstpointer    dataset_location, GDataForeachFunc func, gpointer         user_data);
gpointer g_dataset_id_remove_no_notify(gconstpointer    dataset_location, GQuark           key_id);
void g_dataset_id_set_data_full(gconstpointer    dataset_location, GQuark           key_id, gpointer         data, GDestroyNotify   destroy_func);
gpointer g_datalist_get_data(GData	 **datalist, const gchar *key);
gpointer g_dataset_id_get_data(gconstpointer    dataset_location, GQuark           key_id);
void g_dataset_destroy(gconstpointer    dataset_location);
guint g_datalist_get_flags(GData            **datalist);
void g_datalist_unset_flags(GData            **datalist, guint              flags);
void g_datalist_set_flags(GData            **datalist, guint              flags);
void g_datalist_foreach(GData            **datalist, GDataForeachFunc   func, gpointer           user_data);
gpointer g_datalist_id_remove_no_notify(GData            **datalist, GQuark             key_id);
gboolean g_datalist_id_replace_data(GData            **datalist, GQuark             key_id, gpointer           oldval, gpointer           newval, GDestroyNotify     destroy, GDestroyNotify    *old_destroy);
gpointer g_datalist_id_dup_data(GData            **datalist, GQuark             key_id, GDuplicateFunc     dup_func, gpointer           user_data);
void g_datalist_id_set_data_full(GData            **datalist, GQuark             key_id, gpointer           data, GDestroyNotify     destroy_func);
gpointer g_datalist_id_get_data(GData            **datalist, GQuark             key_id);
void g_datalist_clear(GData            **datalist);
void g_datalist_init(GData            **datalist);
gchar  ** g_uri_list_extract_uris(const gchar *uri_list);
gchar  * g_filename_display_basename(const gchar *filename);
gboolean g_get_filename_charsets(const gchar ***charsets);
gchar  * g_filename_display_name(const gchar *filename);
gchar  * g_filename_to_uri(const gchar *filename, const gchar *hostname, GError     **error);
gchar  * g_filename_from_uri(const gchar *uri, gchar      **hostname, GError     **error);
gchar * g_filename_from_utf8(const gchar  *utf8string, gssize        len, gsize        *bytes_read, gsize        *bytes_written, GError      **error);
gchar * g_filename_to_utf8(const gchar  *opsysstring, gssize        len, gsize        *bytes_read, gsize        *bytes_written, GError      **error);
gchar * g_locale_from_utf8(const gchar  *utf8string, gssize        len, gsize        *bytes_read, gsize        *bytes_written, GError      **error);
gchar * g_locale_to_utf8(const gchar  *opsysstring, gssize        len, gsize        *bytes_read, gsize        *bytes_written, GError      **error);
gchar * g_convert_with_fallback(const gchar  *str, gssize        len, const gchar  *to_codeset, const gchar  *from_codeset, const gchar  *fallback, gsize        *bytes_read, gsize        *bytes_written, GError      **error);
gchar * g_convert_with_iconv(const gchar  *str, gssize        len, GIConv        converter, gsize        *bytes_read, gsize        *bytes_written, GError      **error);
gchar * g_convert(const gchar  *str, gssize        len, const gchar  *to_codeset, const gchar  *from_codeset, gsize        *bytes_read, gsize        *bytes_written, GError      **error);
gint g_iconv_close(GIConv        converter);
gsize g_iconv(GIConv        converter, gchar       **inbuf, gsize        *inbytes_left, gchar       **outbuf, gsize        *outbytes_left);
GIConv g_iconv_open(const gchar  *to_codeset, const gchar  *from_codeset);
GQuark g_convert_error_quark(void);
gchar                 * g_compute_checksum_for_bytes(GChecksumType    checksum_type, GBytes          *data);
gchar                 * g_compute_checksum_for_string(GChecksumType    checksum_type, const gchar     *str, gssize           length);
gchar                 * g_compute_checksum_for_data(GChecksumType    checksum_type, const guchar    *data, gsize            length);
void g_checksum_get_digest(GChecksum       *checksum, guint8          *buffer, gsize           *digest_len);
const gchar  * g_checksum_get_string(GChecksum       *checksum);
void g_checksum_update(GChecksum       *checksum, const guchar    *data, gssize           length);
void g_checksum_free(GChecksum       *checksum);
GChecksum  * g_checksum_copy(const GChecksum *checksum);
void g_checksum_reset(GChecksum       *checksum);
GChecksum  * g_checksum_new(GChecksumType    checksum_type);
gssize g_checksum_type_get_length(GChecksumType    checksum_type);
gchar  ** g_get_locale_variants(const gchar *locale);
const gchar  * const * g_get_language_names(void);
gchar  * g_get_codeset(void);
gboolean g_get_charset(const char **charset);
gint g_bytes_compare(gconstpointer   bytes1, gconstpointer   bytes2);
gboolean g_bytes_equal(gconstpointer   bytes1, gconstpointer   bytes2);
guint g_bytes_hash(gconstpointer   bytes);
GByteArray  * g_bytes_unref_to_array(GBytes         *bytes);
gpointer g_bytes_unref_to_data(GBytes         *bytes, gsize          *size);
void g_bytes_unref(GBytes         *bytes);
GBytes  * g_bytes_ref(GBytes         *bytes);
gsize g_bytes_get_size(GBytes         *bytes);
gconstpointer g_bytes_get_data(GBytes         *bytes, gsize          *size);
GBytes  * g_bytes_new_from_bytes(GBytes         *bytes, gsize           offset, gsize           length);
GBytes  * g_bytes_new_with_free_func(gconstpointer   data, gsize           size, GDestroyNotify  free_func, gpointer        user_data);
GBytes  * g_bytes_new_static(gconstpointer   data, gsize           size);
GBytes  * g_bytes_new_take(gpointer        data, gsize           size);
GBytes  * g_bytes_new(gconstpointer   data, gsize           size);
gboolean g_bookmark_file_move_item(GBookmarkFile  *bookmark, const gchar    *old_uri, const gchar    *new_uri, GError        **error);
gboolean g_bookmark_file_remove_item(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
gboolean g_bookmark_file_remove_application(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *name, GError        **error);
gboolean g_bookmark_file_remove_group(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *group, GError        **error);
gchar  ** g_bookmark_file_get_uris(GBookmarkFile  *bookmark, gsize          *length);
gint g_bookmark_file_get_size(GBookmarkFile  *bookmark);
gboolean g_bookmark_file_has_item(GBookmarkFile  *bookmark, const gchar    *uri);
time_t g_bookmark_file_get_visited(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
void g_bookmark_file_set_visited(GBookmarkFile  *bookmark, const gchar    *uri, time_t          visited);
time_t g_bookmark_file_get_modified(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
void g_bookmark_file_set_modified(GBookmarkFile  *bookmark, const gchar    *uri, time_t          modified);
time_t g_bookmark_file_get_added(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
void g_bookmark_file_set_added(GBookmarkFile  *bookmark, const gchar    *uri, time_t          added);
gboolean g_bookmark_file_get_icon(GBookmarkFile  *bookmark, const gchar    *uri, gchar         **href, gchar         **mime_type, GError        **error);
void g_bookmark_file_set_icon(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *href, const gchar    *mime_type);
gboolean g_bookmark_file_get_is_private(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
void g_bookmark_file_set_is_private(GBookmarkFile  *bookmark, const gchar    *uri, gboolean        is_private);
gboolean g_bookmark_file_get_app_info(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *name, gchar         **exec, guint          *count, time_t         *stamp, GError        **error);
gboolean g_bookmark_file_set_app_info(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *name, const gchar    *exec, gint            count, time_t          stamp, GError        **error);
gchar  ** g_bookmark_file_get_applications(GBookmarkFile  *bookmark, const gchar    *uri, gsize          *length, GError        **error);
gboolean g_bookmark_file_has_application(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *name, GError        **error);
void g_bookmark_file_add_application(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *name, const gchar    *exec);
gchar  ** g_bookmark_file_get_groups(GBookmarkFile  *bookmark, const gchar    *uri, gsize          *length, GError        **error);
gboolean g_bookmark_file_has_group(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *group, GError        **error);
void g_bookmark_file_add_group(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *group);
void g_bookmark_file_set_groups(GBookmarkFile  *bookmark, const gchar    *uri, const gchar   **groups, gsize           length);
gchar  * g_bookmark_file_get_mime_type(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
void g_bookmark_file_set_mime_type(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *mime_type);
gchar  * g_bookmark_file_get_description(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
void g_bookmark_file_set_description(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *description);
gchar  * g_bookmark_file_get_title(GBookmarkFile  *bookmark, const gchar    *uri, GError        **error);
void g_bookmark_file_set_title(GBookmarkFile  *bookmark, const gchar    *uri, const gchar    *title);
gboolean g_bookmark_file_to_file(GBookmarkFile  *bookmark, const gchar    *filename, GError        **error);
gchar  * g_bookmark_file_to_data(GBookmarkFile  *bookmark, gsize          *length, GError        **error);
gboolean g_bookmark_file_load_from_data_dirs(GBookmarkFile  *bookmark, const gchar    *file, gchar         **full_path, GError        **error);
gboolean g_bookmark_file_load_from_data(GBookmarkFile  *bookmark, const gchar    *data, gsize           length, GError        **error);
gboolean g_bookmark_file_load_from_file(GBookmarkFile  *bookmark, const gchar    *filename, GError        **error);
void g_bookmark_file_free(GBookmarkFile  *bookmark);
GBookmarkFile  * g_bookmark_file_new(void);
GQuark g_bookmark_file_error_quark(void);
void g_pointer_bit_unlock(volatile void *address, gint           lock_bit);
gboolean g_pointer_bit_trylock(volatile void *address, gint           lock_bit);
void g_pointer_bit_lock(volatile void *address, gint           lock_bit);
void g_bit_unlock(volatile gint *address, gint           lock_bit);
gboolean g_bit_trylock(volatile gint *address, gint           lock_bit);
void g_bit_lock(volatile gint *address, gint           lock_bit);
guchar  * g_base64_decode_inplace(gchar        *text, gsize        *out_len);
guchar  * g_base64_decode(const gchar  *text, gsize        *out_len);
gsize g_base64_decode_step(const gchar  *in, gsize         len, guchar       *out, gint         *state, guint        *save);
gchar * g_base64_encode(const guchar *data, gsize         len);
gsize g_base64_encode_close(gboolean      break_lines, gchar        *out, gint         *state, gint         *save);
gsize g_base64_encode_step(const guchar *in, gsize         len, gboolean      break_lines, gchar        *out, gint         *state, gint         *save);
void g_on_error_stack_trace(const gchar *prg_name);
void g_on_error_query(const gchar *prg_name);
gint g_atomic_int_exchange_and_add(volatile gint  *atomic, gint            val);
gsize g_atomic_pointer_xor(volatile void  *atomic, gsize           val);
gsize g_atomic_pointer_or(volatile void  *atomic, gsize           val);
gsize g_atomic_pointer_and(volatile void  *atomic, gsize           val);
gssize g_atomic_pointer_add(volatile void  *atomic, gssize          val);
gboolean g_atomic_pointer_compare_and_exchange(volatile void  *atomic, gpointer        oldval, gpointer        newval);
void g_atomic_pointer_set(volatile void  *atomic, gpointer        newval);
gpointer g_atomic_pointer_get(const volatile void *atomic);
guint g_atomic_int_xor(volatile guint *atomic, guint           val);
guint g_atomic_int_or(volatile guint *atomic, guint           val);
guint g_atomic_int_and(volatile guint *atomic, guint           val);
gint g_atomic_int_add(volatile gint  *atomic, gint            val);
gboolean g_atomic_int_compare_and_exchange(volatile gint  *atomic, gint            oldval, gint            newval);
gboolean g_atomic_int_dec_and_test(volatile gint  *atomic);
void g_atomic_int_inc(volatile gint  *atomic);
void g_atomic_int_set(volatile gint  *atomic, gint            newval);
gint g_atomic_int_get(const volatile gint *atomic);
gpointer g_async_queue_timed_pop_unlocked(GAsyncQueue      *queue, GTimeVal         *end_time);
gpointer g_async_queue_timed_pop(GAsyncQueue      *queue, GTimeVal         *end_time);
void g_async_queue_push_front_unlocked(GAsyncQueue      *queue, gpointer          item);
void g_async_queue_push_front(GAsyncQueue      *queue, gpointer          item);
gboolean g_async_queue_remove_unlocked(GAsyncQueue      *queue, gpointer          item);
gboolean g_async_queue_remove(GAsyncQueue      *queue, gpointer          item);
void g_async_queue_sort_unlocked(GAsyncQueue      *queue, GCompareDataFunc  func, gpointer          user_data);
void g_async_queue_sort(GAsyncQueue      *queue, GCompareDataFunc  func, gpointer          user_data);
gint g_async_queue_length_unlocked(GAsyncQueue      *queue);
gint g_async_queue_length(GAsyncQueue      *queue);
gpointer g_async_queue_timeout_pop_unlocked(GAsyncQueue      *queue, guint64           timeout);
gpointer g_async_queue_timeout_pop(GAsyncQueue      *queue, guint64           timeout);
gpointer g_async_queue_try_pop_unlocked(GAsyncQueue      *queue);
gpointer g_async_queue_try_pop(GAsyncQueue      *queue);
gpointer g_async_queue_pop_unlocked(GAsyncQueue      *queue);
gpointer g_async_queue_pop(GAsyncQueue      *queue);
void g_async_queue_push_sorted_unlocked(GAsyncQueue      *queue, gpointer          data, GCompareDataFunc  func, gpointer          user_data);
void g_async_queue_push_sorted(GAsyncQueue      *queue, gpointer          data, GCompareDataFunc  func, gpointer          user_data);
void g_async_queue_push_unlocked(GAsyncQueue      *queue, gpointer          data);
void g_async_queue_push(GAsyncQueue      *queue, gpointer          data);
void g_async_queue_unref_and_unlock(GAsyncQueue      *queue);
void g_async_queue_ref_unlocked(GAsyncQueue      *queue);
void g_async_queue_unref(GAsyncQueue      *queue);
GAsyncQueue  * g_async_queue_ref(GAsyncQueue      *queue);
void g_async_queue_unlock(GAsyncQueue      *queue);
void g_async_queue_lock(GAsyncQueue      *queue);
GAsyncQueue  * g_async_queue_new_full(GDestroyNotify item_free_func);
GAsyncQueue  * g_async_queue_new(void);
void g_byte_array_sort_with_data(GByteArray       *array, GCompareDataFunc  compare_func, gpointer          user_data);
void g_byte_array_sort(GByteArray       *array, GCompareFunc      compare_func);
GByteArray * g_byte_array_remove_range(GByteArray       *array, guint             index_, guint             length);
GByteArray * g_byte_array_remove_index_fast(GByteArray       *array, guint             index_);
GByteArray * g_byte_array_remove_index(GByteArray       *array, guint             index_);
GByteArray * g_byte_array_set_size(GByteArray       *array, guint             length);
GByteArray * g_byte_array_prepend(GByteArray       *array, const guint8     *data, guint             len);
GByteArray * g_byte_array_append(GByteArray       *array, const guint8     *data, guint             len);
void g_byte_array_unref(GByteArray       *array);
GByteArray  * g_byte_array_ref(GByteArray       *array);
GBytes * g_byte_array_free_to_bytes(GByteArray       *array);
guint8 * g_byte_array_free(GByteArray       *array, gboolean          free_segment);
GByteArray * g_byte_array_sized_new(guint             reserved_size);
GByteArray * g_byte_array_new_take(guint8           *data, gsize             len);
GByteArray * g_byte_array_new(void);
gboolean g_ptr_array_find_with_equal_func(GPtrArray     *haystack, gconstpointer  needle, GEqualFunc     equal_func, guint         *index_);
gboolean g_ptr_array_find(GPtrArray        *haystack, gconstpointer     needle, guint            *index_);
void g_ptr_array_foreach(GPtrArray        *array, GFunc             func, gpointer          user_data);
void g_ptr_array_sort_with_data(GPtrArray        *array, GCompareDataFunc  compare_func, gpointer          user_data);
void g_ptr_array_sort(GPtrArray        *array, GCompareFunc      compare_func);
void g_ptr_array_insert(GPtrArray        *array, gint              index_, gpointer          data);
void g_ptr_array_add(GPtrArray        *array, gpointer          data);
GPtrArray  * g_ptr_array_remove_range(GPtrArray        *array, guint             index_, guint             length);
gboolean g_ptr_array_remove_fast(GPtrArray        *array, gpointer          data);
gboolean g_ptr_array_remove(GPtrArray        *array, gpointer          data);
gpointer g_ptr_array_remove_index_fast(GPtrArray        *array, guint             index_);
gpointer g_ptr_array_remove_index(GPtrArray        *array, guint             index_);
void g_ptr_array_set_size(GPtrArray        *array, gint              length);
void g_ptr_array_set_free_func(GPtrArray        *array, GDestroyNotify    element_free_func);
void g_ptr_array_unref(GPtrArray        *array);
GPtrArray * g_ptr_array_ref(GPtrArray        *array);
gpointer * g_ptr_array_free(GPtrArray        *array, gboolean          free_seg);
GPtrArray * g_ptr_array_new_full(guint             reserved_size, GDestroyNotify    element_free_func);
GPtrArray * g_ptr_array_sized_new(guint             reserved_size);
GPtrArray * g_ptr_array_new_with_free_func(GDestroyNotify    element_free_func);
GPtrArray * g_ptr_array_new(void);
void g_array_set_clear_func(GArray           *array, GDestroyNotify    clear_func);
void g_array_sort_with_data(GArray           *array, GCompareDataFunc  compare_func, gpointer          user_data);
void g_array_sort(GArray           *array, GCompareFunc      compare_func);
GArray * g_array_remove_range(GArray           *array, guint             index_, guint             length);
GArray * g_array_remove_index_fast(GArray           *array, guint             index_);
GArray * g_array_remove_index(GArray           *array, guint             index_);
GArray * g_array_set_size(GArray           *array, guint             length);
GArray * g_array_insert_vals(GArray           *array, guint             index_, gconstpointer     data, guint             len);
GArray * g_array_prepend_vals(GArray           *array, gconstpointer     data, guint             len);
GArray * g_array_append_vals(GArray           *array, gconstpointer     data, guint             len);
guint g_array_get_element_size(GArray           *array);
void g_array_unref(GArray           *array);
GArray  * g_array_ref(GArray           *array);
gchar * g_array_free(GArray           *array, gboolean          free_segment);
GArray * g_array_sized_new(gboolean          zero_terminated, gboolean          clear_, guint             element_size, guint             reserved_size);
GArray * g_array_new(gboolean          zero_terminated, gboolean          clear_, guint             element_size);
