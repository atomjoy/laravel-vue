<template>
    <div class="change_locale">
        <select v-model="locale" class="locale_select">
            <option
                v-for="lang in availableLocales"
                :key="`locale-${lang}`"
                :value="lang"
            >
                {{ t(lang) }}
            </option>
        </select>
    </div>
</template>

<script setup>
import axios from "axios";
import { useI18n } from "vue-i18n";
import { watch, onMounted } from "vue";

const { t, locale, availableLocales, fallbackLocale } = useI18n({
    useScope: "global",
});

const props = defineProps({
    locale_url: { default: "/web/api/locale/" },
});

onMounted(() => {
    locale.value =
        localStorage.getItem("locale-xxx-locale") ??
        fallbackLocale.value ??
        "en";
    console.log("Change locale", locale.value, availableLocales);
});

watch(
    () => locale.value,
    (lang) => {
        localStorage.setItem("locale-xxx-locale", lang);
        changeLocale(lang);
    }
);

async function changeLocale(locale) {
    if (props.locale_url) {
        try {
            await axios.get(props.locale_url + locale);
        } catch (err) {
            console.log("Change locale error", err);
        }
    }
}
</script>

<style scoped>
.change_locale {
    float: right;
    width: auto;
    height: 44px;
    margin: 5px;
    background: var(--bg-1);
    border-radius: var(--border-radius);
    border: 0px solid var(--divider);
}
.change_locale .locale_select {
    box-sizing: border-box;
    min-width: 60px;
    height: 42px;
    float: left;
    border: 0px;
    cursor: pointer;
    text-align: center;
    padding: 0px;
    font-size: 14px;
    font-weight: 500;
    background: var(--bg-1);
    border-radius: var(--border-radius);
}
.change_locale .locale_select option,
.change_locale .locale_select > * {
    background: var(--bg-1);
    color: var(--text-1);
}
.change_locale .locale_select:focus {
    border: none;
    box-shadow: none;
}
</style>

<!--
import { createI18n } from 'vue-i18n'

const lang = {
  // Allow compositions api (required)
  allowComposition: true,
  globalInjection: true,
  legacy: false,

  // Locales
  locale: 'en',
  fallbackLocale: 'en',
  availableLocales: ['en', 'pl'],
  messages: {
    en: { en: "English", pl: "Polish" },
    pl: { en: "Angielski", pl: "Polski" },
  },
}

const i18n = createI18n(lang)
app.use(i18n)
-->
