import { imageLoader } from './loaders.js';
import Sprites from './Sprites.js';

export function loadBackground(){
  return imageLoader('../img/TilesetGraveyard.png')
  .then(img => {
    console.log('Tileset loaded ', img);
    const background = new Sprites(img, 16);
    background.define('rock-1', 0, 0);
    return background;
    
  })
}

export function loadCharacter(){
  return imageLoader('../img/Human/human_regular_hair.png')
  .then( img => {
    console.log('Character loaded', img);
    const human = new Sprites(img, 20);
    human.define('idle', 1, 0);
    return human;
  })
}