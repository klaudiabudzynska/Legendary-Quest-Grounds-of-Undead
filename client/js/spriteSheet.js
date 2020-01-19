import { imageLoader } from './loaders.js';
import Sprites from './Sprites.js';

export function loadBackground(){
  return imageLoader('../img/TilesetGraveyard.png')
  .then(img => {

    const background = new Sprites(img, 16);
    background.define('Pole', 0, 11, 1, 1);
    background.define('fence_vertical', 3, 10, 1, 1);
    background.define('fence_horizontal', 12, 10, 1, 1);
    background.define('Church', 8, 0, 4, 4);
    background.define('Path', 0, 5, 1, 1);
    background.define('Swamp', 4, 5, 1, 1);
    console.log(background);
    return background;
    
  })
}

export function loadHuman(){
  return imageLoader('../img/Human/human_regular_hair.png')
  .then( img => {
    console.log('Character loaded', img);
    const human = new Sprites(img, 20);
    human.define('idle', 1, 0, 1, 1);
    return human;
  })
}