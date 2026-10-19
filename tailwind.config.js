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
                "serif-jawa": ['"Cormorant Garamond"', "serif"],
                sans: ["Inter", "sans-serif"],
            },
            colors: {
                harjuna: {
                    dark: "#1B4332", // Hijau tua logo
                    medium: "#2D6A4F", // Hijau daun
                    gold: "#D4A017", // Emas keraton
                    cream: "#F5EFE6", // Krem gading background
                    wood: "#7F5539", // Coklat kayu
                },
            },
        },
    },

    plugins: [forms],
};
