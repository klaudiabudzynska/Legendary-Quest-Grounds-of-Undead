import Scene from './Scene.js';

export default class Level {
  constructor(){
    this.scene = new Scene();
    this.characters = new Set();
  }

  update(deltaTime){
    this.characters.forEach(character => {
      character.update(deltaTime);
    })
  }
}