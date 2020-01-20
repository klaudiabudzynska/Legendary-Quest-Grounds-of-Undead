export class Vector {
  constructor(x, y){
    this.set(x, y);
  }
  set(x, y){
    this.x = x;
    this.y = y;
  }
}

export class Matrix {
  constructor(){
    this.grid = [];
  }

  loopOver(callback){
    this.grid.forEach((col, x) => {
      col.forEach((data, y) => {
        callback(data, x, y);
      })
    })
  }

  set(x, y, data){
    if(!this.grid[x]){
      this.grid[x] = [];
    }

    this.grid[x][y] = data;
  }

  get(x, y){
    const col = this.grid[x];
    if(col) {
      return col[y];
    }
    return undefined;
  }
}