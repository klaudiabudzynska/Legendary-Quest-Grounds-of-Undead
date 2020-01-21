export default class TileResolver {
  constructor(matrix){ 
    this.matrix = matrix;
  }

  matchByIndex(x, y){
    const tile = this.matrix.get(x, y);
    if(tile) {
      return {
        tile,
      }
    }
  }

}