import { send } from './requests.js'

export default class Player {
  constructor(id){
    this.id = id;
    this.characters = [];
    this.currentCharacter;
    this.canPlay = false;
  }

  init(characters){
    characters.forEach(character => {
      this.characters.push(character);
    })
  }

  turn(){
    this.currentCharacter = this.characters[0];
    console.log(this.characters[0]);
    this.canPlay = true;
  }

  moveCharacter(dest){
    this.currentCharacter.dest.set(dest.x, dest.y);
    send(`game/move/${this.currentCharacter.id}/${dest.x}/${dest.y}`);
    this.currentCharacter.walk.start(dest);
    console.log(this.characters.indexOf(this.currentCharacter));
    if(this.characters.indexOf(this.currentCharacter) < this.characters.length - 1){
      this.currentCharacter = this.characters[this.characters.indexOf(this.currentCharacter) + 1];
    } else {
      console.log('end');
      send(`game/end/${this.id}`)
      this.canPlay = false;
    }
  }

}