import { levelLoader } from './loaders.js';
import Timer from './Timer.js';
import { createHuman } from './characters.js';
import MouseDetector from './MouseDetector.js';
import Player from './Player.js';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

Promise.all([
  levelLoader(),
  createHuman(),
])
.then(([
  level,
  human, 
]) => {

  human.pos.set(1,1);
  human.dest.set(1,1);

  level.characters.add(human);
  human.walk.start(human.pos);

  const player = new Player(123);
  const input = new MouseDetector();
  input.listen(canvas, (pos) => {
    player.moveCharacter(human, pos);
  });

  const timer = new Timer();
  timer.update = function update(deltaTime){
    level.scene.draw(ctx);
    level.update(deltaTime);
  }

  timer.start();

})