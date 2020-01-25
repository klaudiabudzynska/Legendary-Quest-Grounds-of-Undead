import Character from './Character.js';
import Walk from './movements/Walk.js';
import Velocity from './movements/Velocity.js';
import { loadCharacter } from './spriteSheet.js';

export function createCharacter(name) {
  return loadCharacter(name)
  .then(characterSprite =>{
    const character = new Character;

    character.draw = function drawCharacter(ctx){
      characterSprite.draw('idle', ctx, this.pos.x, this.pos.y);
    }
  
    character.addMovement(new Velocity);
    character.addMovement(new Walk);
    character.range = 3;
    
    return character;
  })
}