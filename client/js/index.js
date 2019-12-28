import { imageLoader } from './loaders.js';
import Sprites from './Sprites.js';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

ctx.scale(3,3);

function loadBackground(){
  return imageLoader('../img/TilesetGraveyard.png')
  .then(img => {
    console.log('Tileset loaded ', img);
    const background = new Sprites(img, ctx, 16);
    background.define('rock-1', 0, 0);
    return background;
    
  })
}

function loadCharacter(){
  return imageLoader('../img/Human/human_regular_hair.png')
  .then( img => {
    console.log('Character loaded', img);
    const human = new Sprites(img, ctx, 20);
    human.define('idle', 1, 0);
    return human;
  })
}

Promise.all([
  loadBackground(), 
  loadCharacter(),
])
.then(([
  background, 
  character,
]) => {
  ctx.fillStyle = "#89d27c";
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  background.draw('rock-1', 0, 0);
  character.draw('idle', 1, 0);
})



