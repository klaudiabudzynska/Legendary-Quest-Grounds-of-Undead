import { send, get } from './requests.js'
import Timer from './Timer.js';
import { Vector } from './math.js';

export default class Player {
  constructor(id){
    this.id = id;
    this.characters = [];
    this.enemyCharacters = [];
    this.currentCharacter;
    this.canPlay = false;
    this.whoseTurn;
    this.requests = new Timer(5);
    this.theEnd = new Vector(9, 13);
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

  enemyInit(characters){
    characters.forEach(character => {
      this.enemyCharacters.push(character);
    })
  }

  playerTurn(){
    this.currentCharacter = this.characters[0];
    console.log(this.characters[0]);
    this.canPlay = true;
  }

  enemyTurn(){
    get('game/last').then(res => {
      console.log("ruch wykonał", res[0].user);

      const coords = res[0].position.split(';');
      const move = new Vector(coords[0], coords[1]);

      this.moveEnemy(res[0].user, move);

    });
    get('game/next').then(res => {console.log(res); this.whoseTurn = res.id});
  }

  moveCharacter(dest){
    this.currentCharacter.dest.set(dest.x, dest.y);

    send(`game/move/${this.currentCharacter.id}/${dest.x}/${dest.y}`);

    this.currentCharacter.walk.start(dest);

    console.log(dest);
    if(dest === this.theEnd){
      console.log('%c the end ', 'background: green; color: #fff');
    }
    
    if(this.characters.indexOf(this.currentCharacter) < this.characters.length - 1){
      this.currentCharacter = this.characters[this.characters.indexOf(this.currentCharacter) + 1];
    } else {
      console.log('end');
      send(`game/end/${this.id}`)
      this.canPlay = false;

      this.timer();
    }
  }

  moveEnemy(id, dest){
    const character = this.enemyCharacters.filter(character => id === character.id)[0];
    character.walk.start(dest);
  }

  timer(){
    this.requests.update = (deltaTime) => {
      this.enemyTurn();
      console.log("whose turn", this.whoseTurn);
      if(this.whoseTurn === this.id){
        this.playerTurn();
        this.requests.stop();
      }
    }
    this.requests.start();
  }
}