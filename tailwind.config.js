import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    light: "#6366f1",
                    DEFAULT: "#4f46e5",
                    dark: "#4338ca",
                },
                secondary: {
                    light: "#f59e0b",
                    DEFAULT: "#d97706",
                    dark: "#b45309",
                },
            },
        },
    },
    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },

    plugins: [forms],
};
