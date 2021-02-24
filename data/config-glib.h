typedef struct _GHook GHook;
typedef struct _GHookList GHookList;
typedef struct _GIOFuncs GIOFuncs;
typedef struct _GList GList;
typedef struct _GSourceCallbackFuncs GSourceCallbackFuncs;
typedef struct _GSource GSource;
/*typedef struct _GSourcePrivate          GSourcePrivate;*/
typedef struct _GNode GNode;
/*typedef struct _GData GData;*/
typedef struct _GSList GSList;
typedef struct _GString GString;
typedef struct _GError GError;
typedef struct _GScannerConfig	GScannerConfig;
/*
typedef void            (*GDestroyNotify)       (gpointer       data);
typedef void            (*GFunc)                (gpointer       data,
                                                 gpointer       user_data);
*/
typedef struct _GLogField GLogField;
typedef struct _GTrashStack GTrashStack;
/*typedef struct _GVariant        GVariant;*/
/*typedef gpointer (*GThreadFunc) (gpointer data);*/
typedef enum _GThreadPriority GThreadPriority;
/*
typedef gchar*          (*GCompletionFunc)      (gpointer);
typedef gboolean (*GSourceFunc)       (gpointer user_data);
typedef void		(*GHookFinalizeFunc)	(GHookList      *hook_list,
						 GHook          *hook);
*/
typedef struct _GPollFD GPollFD;
typedef enum _GIOStatus GIOStatus;
typedef struct _GIOChannel	GIOChannel;
typedef enum _GSeekType GSeekType;
typedef enum _GIOCondition GIOCondition;
typedef enum _GIOFlags GIOFlags;
typedef struct _GScanner	GScanner;
/*
typedef gint (*GCompletionStrncmpFunc) (const gchar *s1,
                                        const gchar *s2,
                                        gsize        n);
*/
//typedef void (*GSourceDummyMarshal) (void);
typedef union  _GTokenValue     GTokenValue;
/*typedef struct _GHashTable  GHashTable;*/
/*
typedef void		(*GScannerMsgFunc)	(GScanner      *scanner,
						 gchar	       *message,
						 gboolean	error);
*/
/*typedef struct _GVariantType GVariantType;*/
typedef struct _GSourceFuncs            GSourceFuncs;
/*typedef struct _GMainContext            GMainContext;*/


typedef union  _GMutex          GMutex;
union _GMutex
{
  gpointer p;
  guint i[2];
};
typedef struct
{
  GMutex *mutex;
} GStaticMutex;
typedef struct _GCond           GCond;
typedef unsigned long int pthread_t;
typedef struct _GTimeVal                GTimeVal;
typedef struct _GPrivate        GPrivate;

typedef struct _GHashTableIter GHashTableIter;
