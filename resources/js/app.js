import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
import 'tailwindcss/tailwind.css';

// Importar la función del corazón
import { toggleHeart } from './components/guardarCorazon';

// Hacer accesible la función desde el HTML
window.toggleHeart = toggleHeart;