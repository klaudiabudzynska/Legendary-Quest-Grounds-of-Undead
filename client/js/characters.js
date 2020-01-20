import Character from './Character.js';
import Walk from './movements/Walk.js';
import Velocity from './movements/Velocity.js';
import { loadHuman } from './spriteSheet.js';

export function createHuman() {
  return loadHuman()
  .then(humanSprite =>{
    const human = new Character;

    human.draw = function drawHuman(ctx){
      humanSprite.draw('idle', ctx, this.pos.x, this.pos.y);
    }
  
    human.addMovement(new Velocity);
    human.addMovement(new Walk);
    human.range = 2;
    
    return human;
  })
}