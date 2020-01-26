import { send, get } from './requests.js'
import Timer from './Timer.js';

export default class Player {
  constructor(id){
    this.id = id;
    this.characters = [];
    this.currentCharacter;
    this.canPlay = false;
    this.whoseTurn;
    this.requests = new Timer(2);
  }

  init(characters, startPlayer){
    characters.forEach(character => {
      this.characters.push(character);
    })

    this.whoseTurn = startPlayer;

    if(this.id === startPlayer){
      this.playerTurn();
    } else {
      this.timer();
    }
  }

  playerTurn(){
    this.currentCharacter = this.characters[0];
    console.log(this.characters[0]);
    this.canPlay = true;
  }

  enemyTurn(){
    get('game/last').then(res => console.log(res));
    get('game/next').then(res => {console.log(res); this.whoseTurn = res.id});
  }

  moveCharacter(dest){
    this.currentCharacter.dest.set(dest.x, dest.y);

    send(`game/move/${this.currentCharacter.id}/${dest.x}/${dest.y}`);

    this.currentCharacter.walk.start(dest);
    
    if(this.characters.indexOf(this.currentCharacter) < this.characters.length - 1){
      this.currentCharacter = this.characters[this.characters.indexOf(this.currentCharacter) + 1];
    } else {
      console.log('end');
      send(`game/end/${this.id}`)
      this.canPlay = false;

      this.timer();
    }
  }

  timer(){
    this.requests.update = (deltaTime) => {
      this.enemyTurn();
      if(this.whoseTurn === this.id){
        this.requests.stop(); 
        this.playerTurn()     
      }
    }
    this.requests.start();
    
  }
}