import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		 './vendor/laravel/jetstream/**/*.blade.php',
		 './storage/framework/views/*.php',
		 './resources/views/**/*.blade.php',
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],

    daisyui: {
        themes: [
          {
            aqua: {
              "color-scheme": "dark",
              "primary": "#09ecf3",
              "secondary": "#966fb3",
              "accent": "#ffe999",
              "neutral": "#3b8ac4",
              "base-100": "#345da7",
            },
          },
          {
            black: {
              "color-scheme": "dark",
              "primary": "#373737",
              "secondary": "#373737",
              "accent": "#373737",
              "neutral": "#373737",
              "base-100": "#000000",
            },
          },
          {
            bumblebee: {
              "color-scheme": "light",
              "primary": "oklch(89.51% 0.2132 96.61)",
              "secondary": "oklch(80.39% 0.194 70.76)",
              "accent": "oklch(81.27% 0.157 56.52)",
              "neutral": "oklch(12.75% 0.075 281.99)",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            cmyk: {
              "color-scheme": "light",
              "primary": "#45AEEE",
              "secondary": "#E8488A",
              "accent": "#FFF232",
              "neutral": "#1a1a1a",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            corporate: {
              "color-scheme": "light",
              "primary": "oklch(60.39% 0.228 269.1)",
              "secondary": "#7b92b2",
              "accent": "#67cba0",
              "neutral": "#181a2a",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            cupcake: {
              "color-scheme": "light",
              "primary": "#65c3c8",
              "secondary": "#ef9fbc",
              "accent": "#eeaf3a",
              "neutral": "#291334",
              "base-100": "#faf7f5",
            },
          },
          {
            cyberpunk: {
              "color-scheme": "light",
              "primary": "oklch(74.22% 0.209 6.35)",
              "secondary": "oklch(83.33% 0.184 204.72)",
              "accent": "oklch(71.86% 0.2176 310.43)",
              "neutral": "oklch(23.04% 0.065 269.31)",
              "base-100": "oklch(94.51% 0.179 104.32)",
            },
          },
          {
            dark: {
              "color-scheme": "dark",
              "primary": "oklch(65.69% 0.196 275.75)",
              "secondary": "oklch(74.8% 0.26 342.55)",
              "accent": "oklch(74.51% 0.167 183.61)",
              "neutral": "#2a323c",
              "base-100": "#1d232a",
            },
          },
          {
            dracula: {
              "color-scheme": "dark",
              "primary": "#ff79c6",
              "secondary": "#bd93f9",
              "accent": "#ffb86c",
              "neutral": "#414558",
              "base-100": "#282a36",
            },
          },
          {
            emerald: {
              "color-scheme": "light",
              "primary": "#66cc8a",
              "secondary": "#377cfb",
              "accent": "#f68067",
              "neutral": "#333c4d",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            fantasy: {
              "color-scheme": "light",
              "primary": "oklch(37.45% 0.189 325.02)",
              "secondary": "oklch(53.92% 0.162 241.36)",
              "accent": "oklch(75.98% 0.204 56.72)",
              "neutral": "#1f2937",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            forest: {
              "color-scheme": "dark",
              "primary": "#1eb854",
              "secondary": "#1DB88E",
              "accent": "#1DB8AB",
              "neutral": "#19362D",
              "base-100": "#171212",
            },
          },
          {
            garden: {
              "color-scheme": "light",
              "primary": "oklch(62.45% 0.278 3.8363600743192197)",
              "secondary": "#8E4162",
              "accent": "#5c7f67",
              "neutral": "#291E00",
              "base-100": "#e9e7e7",
            },
          },
          {
            halloween: {
              "color-scheme": "dark",
              "primary": "oklch(77.48% 0.204 60.62)",
              "secondary": "oklch(45.98% 0.248 305.03)",
              "accent": "oklch(64.8% 0.223 136.07347934356451)",
              "neutral": "#2F1B05",
              "base-100": "#212121",
            },
          },
          {
            light: {
              "color-scheme": "light",
              "primary": "oklch(49.12% 0.3096 275.75)",
              "secondary": "oklch(69.71% 0.329 342.55)",
              "accent": "oklch(76.76% 0.184 183.61)",
              "neutral": "#2B3440",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            lofi: {
              "color-scheme": "light",
              "primary": "#0D0D0D",
              "secondary": "#1A1919",
              "accent": "#262626",
              "neutral": "#000000",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            luxury: {
              "color-scheme": "dark",
              "primary": "oklch(100% 0 0)",
              "secondary": "#152747",
              "accent": "#513448",
              "neutral": "#331800",
              "base-100": "#09090b",
            },
          },
          {
            pastel: {
              "color-scheme": "light",
              "primary": "#d1c1d7",
              "secondary": "#f6cbd1",
              "accent": "#b4e9d6",
              "neutral": "#70acc7",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            retro: {
              "color-scheme": "light",
              "primary": "#ef9995",
              "secondary": "#a4cbb4",
              "accent": "#DC8850",
              "neutral": "#2E282A",
              "base-100": "#ece3ca",
            },
          },
          {
            synthwave: {
              "color-scheme": "dark",
              "primary": "#e779c1",
              "secondary": "#58c7f3",
              "accent": "oklch(88.04% 0.206 93.72)",
              "neutral": "#221551",
              "base-100": "#1a103d",
            },
          },
          {
            valentine: {
              "color-scheme": "light",
              "primary": "#e96d7b",
              "secondary": "#a991f7",
              "accent": "#66b1b3",
              "neutral": "#af4670",
              "base-100": "#fae7f4",
            },
          },
          {
            wireframe: {
              "color-scheme": "light",
              "primary": "#b8b8b8",
              "secondary": "#b8b8b8",
              "accent": "#b8b8b8",
              "neutral": "#ebebeb",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            autumn: {
              "color-scheme": "light",
              "primary": "#8C0327",
              "secondary": "#D85251",
              "accent": "#D59B6A",
              "neutral": "#826A5C",
              "base-100": "#f1f1f1",
            },
          },
          {
            business: {
              "color-scheme": "dark",
              "primary": "#1C4E80",
              "secondary": "#7C909A",
              "accent": "#EA6947",
              "neutral": "#23282E",
              "base-100": "#202020",
            },
          },
          {
            acid: {
              "color-scheme": "light",
              "primary": "oklch(71.9% 0.357 330.7595734057481)",
              "secondary": "oklch(73.37% 0.224 48.25087840015526)",
              "accent": "oklch(92.78% 0.264 122.96295065960891)",
              "neutral": "oklch(21.31% 0.128 278.68)",
              "base-100": "#fafafa",
            },
          },
          {
            lemonade: {
              "color-scheme": "light",
              "primary": "oklch(58.92% 0.199 134.6)",
              "secondary": "oklch(77.75% 0.196 111.09)",
              "accent": "oklch(85.39% 0.201 100.73)",
              "neutral": "oklch(30.98% 0.075 108.6)",
              "base-100": "oklch(98.71% 0.02 123.72)",
            },
          },
          {
            night: {
              "color-scheme": "dark",
              "primary": "#38bdf8",
              "secondary": "#818CF8",
              "accent": "#F471B5",
              "neutral": "#1E293B",
              "base-100": "#0F172A",
            },
          },
          {
            coffee: {
              "color-scheme": "dark",
              "primary": "#DB924B",
              "secondary": "#263E3F",
              "accent": "#10576D",
              "neutral": "#120C12",
              "base-100": "#20161F",
            },
          },
          {
            winter: {
              "color-scheme": "light",
              "primary": "oklch(56.86% 0.255 257.57)",
              "secondary": "#463AA2",
              "accent": "#C148AC",
              "neutral": "#021431",
              "base-100": "oklch(100% 0 0)",
            },
          },
          {
            dim: {
              "color-scheme": "dark",
              "primary": "#9FE88D",
              "secondary": "#FF7D5C",
              "accent": "#C792E9",
              "neutral": "#1c212b",
              "base-100": "#2A303C",
            },
          },
          {
            nord: {
              "color-scheme": "light",
              "primary": "#5E81AC",
              "secondary": "#81A1C1",
              "accent": "#88C0D0",
              "neutral": "#4C566A",
              "base-100": "#ECEFF4",
            },
          },
          {
            sunset: {
              "color-scheme": "dark",
              "primary": "#FF865B",
              "secondary": "#FD6F9C",
              "accent": "#B387FA",
              "neutral": "oklch(26% 0.019 237.69)",
              "base-100": "oklch(22% 0.019 237.69)",
            },
          },
        ],
      },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
		forms,
		typography,
		require("daisyui")
	],
};
