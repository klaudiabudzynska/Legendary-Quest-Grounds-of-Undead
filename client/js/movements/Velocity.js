import { Movement } from '../Character.js';

export default class Velocity extends Movement{
  constructor(){
    super('velocity');
  }

  update(character, deltaTime){
    character.pos.x += character.vel.x * deltaTime;
    character.pos.y += character.vel.y * deltaTime;
  }
}