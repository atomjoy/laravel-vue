import { ref, computed } from "vue";
import { defineStore } from "pinia";

export const useThemeStore = defineStore("theme", () => {
    // State
    const color = ref("light");

    // Getters
    const getColor = computed(() => color.value);

    // Actions
    function toggle() {
        color.value = color.value == "light" ? "dark" : "light";
        update();
    }

    function update() {
        document
            .querySelector("body")
            .setAttribute("color-scheme", color.value);
    }

    // Export
    return { color, getColor, toggle, update };
});
