<?php

namespace App\Livewire;

use Livewire\Component;

class ThemeSelector extends Component
{
    public $selectedTheme = 'dark'; // Tema predeterminado

    public $themes = [
        'aqua' => ['dark', '#09ecf3', '#966fb3', '#ffe999', '#3b8ac4', '#345da7'],
        'black' => ['dark', '#373737', '#373737', '#373737', '#373737', '#000000'],
        'bumblebee' => ['light', 'oklch(89.51% 0.2132 96.61)', 'oklch(80.39% 0.194 70.76)', 'oklch(81.27% 0.157 56.52)', 'oklch(12.75% 0.075 281.99)', 'oklch(100% 0 0)'],
        'cmyk' => ['light', '#45AEEE', '#E8488A', '#FFF232', '#1a1a1a', 'oklch(100% 0 0)'],
        'corporate' => ['light', 'oklch(60.39% 0.228 269.1)', '#7b92b2', '#67cba0', '#181a2a', 'oklch(100% 0 0)'],
        'cupcake' => ['light', '#65c3c8', '#ef9fbc', '#eeaf3a', '#291334', '#faf7f5'],
        'cyberpunk' => ['light', 'oklch(74.22% 0.209 6.35)', 'oklch(83.33% 0.184 204.72)', 'oklch(71.86% 0.2176 310.43)', 'oklch(23.04% 0.065 269.31)', 'oklch(94.51% 0.179 104.32)'],
        'dark' => ['dark', 'oklch(65.69% 0.196 275.75)', 'oklch(74.8% 0.26 342.55)', 'oklch(74.51% 0.167 183.61)', '#2a323c', '#1d232a'],
        'dracula' => ['dark', '#ff79c6', '#bd93f9', '#ffb86c', '#414558', '#282a36'],
        'emerald' => ['light', '#66cc8a', '#377cfb', '#f68067', '#333c4d', 'oklch(100% 0 0)'],
        'fantasy' => ['light', 'oklch(37.45% 0.189 325.02)', 'oklch(53.92% 0.162 241.36)', 'oklch(75.98% 0.204 56.72)', '#1f2937', 'oklch(100% 0 0)'],
        'forest' => ['dark', '#1eb854', '#1DB88E', '#1DB8AB', '#19362D', '#171212'],
        'garden' => ['light', 'oklch(62.45% 0.278 3.8363600743192197)', '#8E4162', '#5c7f67', '#291E00', '#e9e7e7'],
        'halloween' => ['dark', 'oklch(77.48% 0.204 60.62)', 'oklch(45.98% 0.248 305.03)', 'oklch(64.8% 0.223 136.07347934356451)', '#2F1B05', '#212121'],
        'light' => ['light', 'oklch(49.12% 0.3096 275.75)', 'oklch(69.71% 0.329 342.55)', 'oklch(76.76% 0.184 183.61)', '#2B3440', 'oklch(100% 0 0)'],
        'lofi' => ['light', '#0D0D0D', '#1A1919', '#262626', '#000000', 'oklch(100% 0 0)'],
        'luxury' => ['dark', 'oklch(100% 0 0)', '#152747', '#513448', '#331800', '#09090b'],
        'pastel' => ['light', '#d1c1d7', '#f6cbd1', '#b4e9d6', '#70acc7', 'oklch(100% 0 0)'],
        'retro' => ['light', '#ef9995', '#a4cbb4', '#DC8850', '#2E282A', '#ece3ca'],
        'synthwave' => ['dark', '#e779c1', '#58c7f3', 'oklch(88.04% 0.206 93.72)', '#221551', '#1a103d'],
        'valentine' => ['light', '#e96d7b', '#a991f7', '#66b1b3', '#af4670', '#fae7f4'],
        'wireframe' => ['light', '#b8b8b8', '#b8b8b8', '#b8b8b8', '#ebebeb', 'oklch(100% 0 0)'],
        'autumn' => ['light', '#8C0327', '#D85251', '#D59B6A', '#826A5C', '#f1f1f1'],
        'business' => ['dark', '#1C4E80', '#7C909A', '#EA6947', '#23282E', '#202020'],
        'acid' => ['light', 'oklch(71.9% 0.357 330.7595734057481)', 'oklch(73.37% 0.224 48.25087840015526)', 'oklch(92.78% 0.264 122.96295065960891)', 'oklch(21.31% 0.128 278.68)', '#fafafa'],
        'lemonade' => ['light', 'oklch(58.92% 0.199 134.6)', 'oklch(77.75% 0.196 111.09)', 'oklch(85.39% 0.201 100.73)', 'oklch(30.98% 0.075 108.6)', 'oklch(98.71% 0.02 123.72)'],
        'night' => ['dark', '#38bdf8', '#818CF8', '#F471B5', '#1E293B', '#0F172A'],
        'coffee' => ['dark', '#DB924B', '#263E3F', '#10576D', '#120C12', '#20161F'],
        'winter' => ['light', 'oklch(56.86% 0.255 257.57)', '#463AA2', '#C148AC', '#021431', 'oklch(100% 0 0)'],
        'dim' => ['dark', '#9FE88D', '#FF7D5C', '#C792E9', '#1c212b', '#2A303C'],
        'nord' => ['light', '#5E81AC', '#81A1C1', '#88C0D0', '#4C566A', '#ECEFF4'],
        'sunset' => ['dark', '#FF865B', '#FD6F9C', '#B387FA', 'oklch(26% 0.019 237.69)', 'oklch(22% 0.019 237.69)'],
    ];



    public function updateSelectedTheme($theme)
    {
        $this->selectedTheme = $theme;
        session(['theme' => $this->selectedTheme]);
    }

    public function render()
    {
        return view('livewire.theme-selector');
    }
}
