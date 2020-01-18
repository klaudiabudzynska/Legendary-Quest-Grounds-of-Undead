import Character from './Character.js';
import Walk from './movements/Walk.js';
import Velocity from './movements/Velocity.js';
import { loadCharacter } from './spriteSheet.js';

export function createHuman() {
  return loadCharacter()
  .then(sprite =>{
    const human = new Character();

    human.draw = function drawHuman(ctx){
      sprite.draw('idle', ctx, this.pos.x, this.pos.y);
    }
  
    human.addMovement(new Velocity);
    human.addMovement(new Walk);
    
    human.track = function trackHuman(map, destX, destY){
      let tracks = [];
      // for(let i = 0; i < )
    }
    return human;
  })
}