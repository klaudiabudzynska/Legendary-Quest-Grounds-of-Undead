import TileResolver from './TileResolver.js';

export default class TileCollider {
  constructor(tileMatrix){
    this.tiles = new TileResolver(tileMatrix);
  }

  checkCollision(pos) {
    const match = this.tiles.matchByIndex(pos.x, pos.y);
    let collided = 0;
    if(!match){ //puste miejsca na których jest kościół
      collided = 1;
    } else {
     [
       'fence_vertical', 
       'fence_horizontal', 
       'Pole', 
       'Church',
      ].forEach(element => {
        if(match.tile.name === element) {
          collided = 1;
        }
      })
    }
    return collided;
  }

  test(coords){
    const match = this.tiles.matchByIndex(coords.x, coords.y);
    if(match) {
      console.log('matched tile: ', match, match.tile )
    }
    return this.checkCollision(coords);
  }
}