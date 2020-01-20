import { HttpRequest } from './ajax.js'

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
    let characterMoveRequest = new HttpRequest(`https://localhost:8000/game/move/123/${dest.x}/${dest.y}`);
    characterMoveRequest.send();
    console.log(dest);
    character.walk.start(character.dest);
  }

}