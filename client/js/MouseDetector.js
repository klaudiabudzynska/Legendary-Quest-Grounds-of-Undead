import { Vector } from './math.js';

export default class MouseDetector {
  constructor(){
    this.tileWidth = 32;
    this.tileCoords = new Vector(0, 0);
  }

  calculatePosition(coord){
    return Math.floor(coord / this.tileWidth)
  }

  handleClick = (event) => {
    this.tileCoords.set(
      this.calculatePosition(event.offsetX), 
      this.calculatePosition(event.offsetY) 
    )
  }

  listen(canvas, callback) {
    canvas.addEventListener('click', event => {
      this.handleClick(event);
      callback(this.tileCoords);
    });
  }
}