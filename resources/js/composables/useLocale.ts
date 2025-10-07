import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const SUPPORTED_LANGS = ['en', 'es'] as const;

type SupportedLang = typeof SUPPORTED_LANGS[number];

function normalizePath(path: string) {
  const normalized = path.startsWith('/') ? path : `/${path}`;
  return normalized === '/' ? '' : normalized;
}

export function useLocale() {
  const page = usePage();
  const lang = computed<SupportedLang>(() => {
    const value = page.props.lang as string | undefined;
    return (SUPPORTED_LANGS.find((supported) => supported === value) ?? 'en') as SupportedLang;
  });

  const localizedPath = (path = ''): string => {
    if (!path) {
      return `/${lang.value}`;
    }

    return `/${lang.value}${normalizePath(path)}`;
  };

  const pathForLanguage = (targetLang: SupportedLang): string => {
    const [path, query] = page.url.split('?');
    const strippedPath = path.replace(/^\/(en|es)/, '');
    const querySuffix = query ? `?${query}` : '';

    return `/${targetLang}${strippedPath || ''}${querySuffix}`;
  };

  return {
    lang,
    localizedPath,
    pathForLanguage,
  };
}

