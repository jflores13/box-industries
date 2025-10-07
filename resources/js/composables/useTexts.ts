import { computed, ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';

type LanguageTexts = Record<string, Record<string, string>>;

let textsModulePromise: Promise<typeof import('@/data/TextsByLang')> | null = null;

async function loadTextsModule() {
  if (!textsModulePromise) {
    textsModulePromise = import('@/data/TextsByLang');
  }

  return textsModulePromise;
}

export function useTexts(sectionKey: string) {
  const page = usePage();
  const lang = computed(() => (page.props.lang as string | undefined) ?? 'en');
  const sectionTexts = ref<Record<string, string>>({});

  watchEffect(() => {
    const currentLang = lang.value;

    loadTextsModule().then(({ Texts }) => {
      const allTexts = Texts as unknown as LanguageTexts;
      const fallbackLanguage = allTexts['en'] ?? {};
      const languageTexts = allTexts[currentLang] ?? fallbackLanguage;
      sectionTexts.value = languageTexts[sectionKey] ?? fallbackLanguage[sectionKey] ?? {};
    });
  });

  return {
    lang,
    texts: computed(() => sectionTexts.value),
  };
}

