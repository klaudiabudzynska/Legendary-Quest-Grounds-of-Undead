export default class MouseDetector {
  constructor(){
    this.tileWidth = 32;
  }

  calculatePosition(coord){
    console.log(Math.floor(coord / this.tileWidth));
  }

  handleEvent = (event) => {
    this.calculatePosition(event.offsetX); 
    this.calculatePosition(event.offsetY);
  }
}