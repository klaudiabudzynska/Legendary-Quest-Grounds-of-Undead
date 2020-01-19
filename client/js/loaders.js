import Level from './Level.js';
import { createBackgroundLayer, createCharacterLayer } from './layers.js';
import { loadBackground } from './spriteSheet.js';

export function imageLoader(url) {
  return new Promise(resolve => {
    const img = new Image();
    img.addEventListener('load', () => {
      resolve(img);
    })
    img.src = url;
  })
}

export function levelLoader() {
  return Promise.all([
    fetch('https://localhost:8000/game/map')
    .then(res => res.json()),
    loadBackground()
  ]).then(([levelSpec, background]) => {
    const level = new Level;

    const backgroundLayer = createBackgroundLayer(background, levelSpec);
    level.scene.layers.push(backgroundLayer);

    const characterLayer = createCharacterLayer(level.characters);
    level.scene.layers.push(characterLayer);

    return level;
  })
}