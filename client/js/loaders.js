import Level from './Level.js';
import { createBackgroundLayer, createCharacterLayer } from './layers.js';
import { loadBackground } from './spriteSheet.js';

const LEVEL = new Level;

function createMapTiles(level, backgrounds){
  backgrounds.forEach(background => {
    console.log(background);
    background.coordinates.forEach(coord => {
      const x = coord.split(';')[0];
      const y = coord.split(';')[1];
      level.tiles.set(x, y, {
        name: background.name,
        weight: background.weight,
      });
    })
  })
}

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
    const level = LEVEL;

    createMapTiles(level, levelSpec);

    const backgroundLayer = createBackgroundLayer(background, level);
    level.scene.layers.push(backgroundLayer);

    const characterLayer = createCharacterLayer(level.characters);
    level.scene.layers.push(characterLayer);

    return level;
  })
}

export function getTilesMatrix() {
  return LEVEL.tiles;
}


