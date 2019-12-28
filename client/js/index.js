import { loadBackground, loadCharacter } from './spriteSheet.js';
import { createBackgroundLayer, createCharacterLayer } from './layers.js';
import Scene from './Scene.js';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
ctx.scale(3,3);

Promise.all([
  loadBackground(), 
  loadCharacter(),
])
.then(([
  background, 
  character,
]) => {
  const scene = new Scene();

  const backgroundLayer = createBackgroundLayer(background);
  scene.layers.push(backgroundLayer);

  const pos = {
    x: 1,
    y: 0,
  };

  const characterLayer = createCharacterLayer(character, pos);
  scene.layers.push(characterLayer);

  function update(){
    scene.draw(ctx);
    pos.x += 0.1;
    //pos.y += 0.1;
    requestAnimationFrame(update);
  }

  update();

})