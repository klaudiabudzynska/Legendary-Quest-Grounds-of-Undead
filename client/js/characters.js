import Character from './Character.js';
import { loadCharacter } from './spriteSheet.js';

export function createHuman() {
  return loadCharacter()
  .then(sprite =>{
    const human = new Character();

    human.draw = function drawHuman(ctx){
      sprite.draw('idle', ctx, this.pos.x, this.pos.y);
    }
  
    human.update = function updateHuman(deltaTime){
      this.pos.x += this.vel.x * deltaTime;
      this.pos.y += this.vel.y * deltaTime;
    }
    return human;
  })
}