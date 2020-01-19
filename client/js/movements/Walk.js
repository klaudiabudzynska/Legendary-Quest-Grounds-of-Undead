import { Movement } from '../Character.js';
import { Vector } from '../math.js';
import TileCollider from '../TileCollider.js';
import Level from '../Level.js';
import { getTilesMatrix } from '../loaders.js';

export default class Walk extends Movement{
  constructor(){
    super('walk');

    this.dest = new Vector(0, 0);
    this.level = new Level;
    this.tileCollider = new TileCollider(getTilesMatrix());
  }

  start(destPos){
    //jeśli nie zaszła kolizja
    if(!this.tileCollider.test(destPos)){
      this.dest.set(destPos.x, destPos.y);
    }
  }

  update(character, deltaTime){
    character.pos.x = this.dest.x;
    character.pos.y = this.dest.y;
  }
}