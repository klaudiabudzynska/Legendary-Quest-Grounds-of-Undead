import { Movement } from '../Character.js';
import { Vector, Matrix } from '../math.js';
import TileCollider from '../TileCollider.js';
import Level from '../Level.js';
import { getTilesMatrix } from '../loaders.js';

export default class Walk extends Movement {
  constructor() {
    super('walk');

    this.dest = new Vector(0, 0);
    this.level = new Level;
    this.map = getTilesMatrix()
    this.tileCollider = new TileCollider(this.map);
  }

  start(destPos) {
    //jeśli nie zaszła kolizja
    if (!this.tileCollider.test(destPos)) {
      this.dest.set(destPos.x, destPos.y);
    }
  }

  update(character, deltaTime) {
    character.pos.x = this.dest.x;
    character.pos.y = this.dest.y;
    if(this.dest === character.pos){
      console.log('where are you going');
      const path = this.dijkstraPath(character.pos, this.dest);
      console.log(path);
    }
  }

  dijkstraPath(start, end) {
    let lookingForFinish = true;
    let path = [];
    let chosenOnes = [[start]];

    for (let i = 0; i < this.map.grid.length * this.map.grid.length; i++) {
      path[i] = [];
    }

    for (let k = 1; lookingForFinish; k++) {
      chosenOnes.push([]);
      console.log("array", k, chosenOnes);

      for (let i = 0; i < chosenOnes[i].length; i++) {
          let chosenX = chosenOnes[k - 1].x;
          let chosenY = chosenOnes[k - 1].y;

          //aby el nie wyszedł przed tablicę
          if (chosenX > 0) {
              //jeśli trafi na metę
              if (chosenY == end.y && chosenX - 1 == end.x) {
                  lookingForFinish == false;
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[chosenY * this.map.grid.length + chosenX - 1].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[chosenY * this.map.grid.length + chosenX - 1].push(new Vector(chosenX, chosenY));
                  return path[chosenY * this.map.grid.length + chosenX - 1];
              }
              //jeśli jest wolne miejsce
              if (!this.tileCollider.test({x: chosenX - 1, y: chosenY})) {
                  //ścieżka
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[chosenY * this.map.grid.length + chosenX - 1].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[chosenY * this.map.grid.length + chosenX - 1].push(new Vector(chosenX, chosenY));
                  //wybrany element
                  chosenOnes[chosenOnes.length - 1].push(new Vector(chosenX - 1, chosenY));
              }
          }
          if (chosenX < this.map.grid.length - 1) {
              if (chosenY == end.y && chosenX + 1 == end.x) {
                  lookingForFinish == false;
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[chosenY * this.map.grid.length + chosenX + 1].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[chosenY * this.map.grid.length + chosenX + 1].push(new Vector(chosenX, chosenY));
                  return path[chosenY * this.map.grid.length + chosenX + 1];
              }
              if (!this.tileCollider.test({x: chosenX + 1, y: chosenY})) {
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[chosenY * this.map.grid.length + chosenX + 1].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[chosenY * this.map.grid.length + chosenX + 1].push(new Vector(chosenX, chosenY));
                  chosenOnes[chosenOnes.length - 1].push(new Vector(chosenX + 1, chosenY))
              }
          }
          if (chosenY > 0) {
              if (chosenX = end.x && chosenY - 1 == end.y) {
                  lookingForFinish == false;
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[(chosenY - 1) * this.map.grid.length + chosenX].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[(chosenY - 1) * this.map.grid.length + chosenX].push(new Vector(chosenX, chosenY));
                  return path[(chosenY - 1) * this.map.grid.length + chosenX];
              }
              if (!this.tileCollider.test({x: chosenX, y: chosenY - 1})) {
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[(chosenY - 1) * this.map.grid.length + chosenX].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[(chosenY - 1) * this.map.grid.length + chosenX].push(new Vector(chosenX, chosenY));
                  chosenOnes[chosenOnes.length - 1].push(new Vector(chosenX, chosenY - 1))
              }
          }
          if (chosenY < this.map.grid.length - 1) {
              if (chosenX = end.x && chosenY + 1 == end.y) {
                  lookingForFinish == false;
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[(chosenY + 1) * this.map.grid.length + chosenX].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[(chosenY + 1) * this.map.grid.length + chosenX].push(new Vector(chosenX, chosenY));
                  return path[(chosenY + 1) * this.map.grid.length + chosenX];
              }
              if (!this.tileCollider.test({x: chosenX, y: chosenY + 1})) {
                  for (let j = 0; j < path[chosenY * this.map.grid.length + chosenX].length; j++) {
                      path[(chosenY + 1) * this.map.grid.length + chosenX].push(path[chosenY * this.map.grid.length + chosenX][j]);
                  }
                  path[(chosenY + 1) * this.map.grid.length + chosenX].push(new Vector(chosenX, chosenY));
                  chosenOnes[chosenOnes.length - 1].push(new Vector(chosenX, chosenY))
              }
          }
      }
      if (k > this.map.grid.length * this.map.grid.length) {
          return [];
      }
  }
  };
  
  

}