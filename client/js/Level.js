import Scene from './Scene.js';
import { Matrix } from './math.js';

export default class Level {
  constructor(){
    this.scene = new Scene();
    this.characters = new Set();
    this.tiles = new Matrix();

  }

  update(deltaTime){
    this.characters.forEach(character => {
      character.update(deltaTime);
    })
  }

  getTiles(){
    return this.tiles;
  }
}