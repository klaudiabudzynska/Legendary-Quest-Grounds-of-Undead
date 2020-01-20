import { levelLoader } from './loaders.js';
import Timer from './Timer.js';
import { createHuman } from './characters.js';
import MouseDetector from './MouseDetector.js';
import { HttpRequest } from './ajax.js'

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

  const input = new MouseDetector();
  input.listen(canvas, (pos) => {
    human.dest.set(pos.x, pos.y);
    let humanMoveRequest = new HttpRequest(`https://localhost:8000/game/move/123/${pos.x}/${pos.y}`);
    humanMoveRequest.send();
    console.log(pos);
    human.walk.start(human.dest);
  });

  const timer = new Timer();
  timer.update = function update(deltaTime){
    level.scene.draw(ctx);
    level.update(deltaTime);
  }

  timer.start();

})