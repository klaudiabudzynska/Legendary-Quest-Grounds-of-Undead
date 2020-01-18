import { loadBackground } from './spriteSheet.js';
import { mapLoader } from './loaders.js';
import { createBackgroundLayer, createCharacterLayer } from './layers.js';
import Scene from './Scene.js';
import Timer from './Timer.js';
import { createHuman } from './characters.js';
import MouseDetector from './MouseDetector.js';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');



Promise.all([
  loadBackground(), 
  mapLoader(),
  createHuman(),
])
.then(([
  background, 
  mapData,
  human, 
]) => {
  const scene = new Scene();

  const backgroundLayer = createBackgroundLayer(background, mapData);
  scene.layers.push(backgroundLayer);

  human.pos.set(1, 1);
  human.vel.set(3, 0);

  const input = new MouseDetector();
  input.listen(canvas, (pos) => {
    console.log(pos);
    human.walk.start(pos);
  });

  const characterLayer = createCharacterLayer(human);
  scene.layers.push(characterLayer);

  const timer = new Timer();
  timer.update = function update(deltaTime){
    scene.draw(ctx);
    human.update(deltaTime);
  }

  timer.start();

})