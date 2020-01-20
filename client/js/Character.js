import { Vector } from './math.js';

export class Movement {
  constructor(name){
    this.name = name;
  }

  update(){
    console.warn('error');
  }
}

export default class Character {
  constructor() {
    this.pos = new Vector(0, 0);
    this.vel = new Vector(0, 0);
    this.range;

    this.movements = [];
  }
  
  addMovement(movement){
    this.movements.push(movement);
    this[movement.name] = movement;
  }

  

  update(deltaTime) {
    this.movements.forEach(movement => {
      movement.update(this, deltaTime);
    })
  }
}