import { Movement } from '../Character.js';
import { Vector } from '../math.js';

export default class Velocity extends Movement{
  constructor(){
    super('walk');

    this.dest = new Vector(0, 0);
  }

  start(destPos){
    this.dest.set(destPos.x, destPos.y);
  }

  update(character, deltaTime){
    character.pos.x = this.dest.x;
    character.pos.y = this.dest.y;
  }
}