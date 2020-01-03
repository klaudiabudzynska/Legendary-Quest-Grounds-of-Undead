import { loadBackground } from './spriteSheet.js';
import { mapLoader } from './loaders.js';
import { createBackgroundLayer, createCharacterLayer } from './layers.js';
import Scene from './Scene.js';
import Timer from './Timer.js';
import { createHuman } from './characters.js';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
ctx.scale(1.5, 1.5);

Promise.all([
  loadBackground(), 
  mapLoader(),
  createHuman(),
])
.then(([
  background, 
  map,
  human, 
]) => {
  const scene = new Scene();

  const backgroundLayer = createBackgroundLayer(background);
  scene.layers.push(backgroundLayer);

  human.pos.set(1, 0);
  human.vel.set(3, 0);

  console.log(map);

  const characterLayer = createCharacterLayer(human);
  scene.layers.push(characterLayer);

  const timer = new Timer();
  timer.update = function update(deltaTime){
    scene.draw(ctx);
    human.update(deltaTime);
  }

  timer.start();

})