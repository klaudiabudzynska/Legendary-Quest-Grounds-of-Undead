import { imageLoader } from './loaders.js';
import Sprites from './Sprites.js';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

canvas.width = 500;
canvas.height = 400;

imageLoader('../img/TilesetGraveyard.png')
.then(img => {
  const background = new Sprites(img, ctx);
  background.define('rock-1', 0, 0)
  background.draw('rock-1', 0, 0);
})

