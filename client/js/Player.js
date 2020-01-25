import { sendPosition } from './requests.js'

export default class Player {
  constructor(id){
    this.id = id;
    this.characters = new Set();
    this.currentCharacter;
  }

  init(characters){
    characters.forEach(character => {
      this.characters.add(character);
    })
  }

  moveCharacter(character, dest){
    this.currentCharacter = character;
    character.dest.set(dest.x, dest.y);
    sendPosition(`https://localhost:8000/game/move/${this.id}/${dest.x}/${dest.y}`);
    console.log(dest);
    character.walk.start(character.dest);
  }

}