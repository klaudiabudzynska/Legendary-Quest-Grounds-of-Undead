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
  level.characters.add(human);

  const input = new MouseDetector();
  input.listen(canvas, (pos) => {
    let humanMoveRequest = new HttpRequest(`https://localhost:8000/game/move/123/${pos.x}/${pos.y}`);
    humanMoveRequest.send();
    console.log(pos);
    human.walk.start(pos);
  });

  const timer = new Timer();
  timer.update = function update(deltaTime){
    level.scene.draw(ctx);
    level.update(deltaTime);
  }

  timer.start();

})