import { levelLoader, playerLoader, charactersLoader } from './loaders.js';
import Timer from './Timer.js';
import { createCharacter } from './characters.js';
import MouseDetector from './MouseDetector.js';
import Player from './Player.js';
import { getLastPosition } from './requests.js';


const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

Promise.all([
  levelLoader(),
  playerLoader(),
  charactersLoader(),
  createCharacter('human'),
  createCharacter('pig'),
  createCharacter('skeleton'),
  createCharacter('troll'),
])
.then(([
  level,
  playerData,
  characters,
  human,
  pig,
  skeleton,
  troll,
]) => {
  const player = new Player(playerData.id);
  console.log(playerData, characters);

  player.init(characters.filter(character => character.ownerId === playerData.id))

  console.log(player.characters);

  human.pos.set(1,1);
  pig.pos.set(21, 1);
  skeleton.pos.set(21, 21);
  troll.pos.set(1, 21);

  level.characters.add(human);
  level.characters.add(pig);
  level.characters.add(skeleton);
  level.characters.add(troll);

  player.moveCharacter(human, human.pos);
  player.moveCharacter(pig, pig.pos);
  player.moveCharacter(skeleton, skeleton.pos);
  player.moveCharacter(troll, troll.pos);

  
  const input = new MouseDetector();
  input.listen(canvas, (pos) => {
    player.moveCharacter(human, pos);
  });

  const timer = new Timer();
  timer.update = function update(deltaTime){
    level.scene.draw(ctx);
    level.update(deltaTime);
  }

  const requests = new Timer(1);
  requests.update = function update(){
    // getLastPosition().then(res => console.log(res));
  }

  timer.start();
  requests.start();

})