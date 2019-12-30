export default class Sprites {

  constructor(url, size){
    this.url = url;
    this.size = size;
    this.defaultSize = 32;
    this.tiles = new Map();
  }

  define(name, x, y){
    const buffer = document.createElement('canvas');
    buffer.width = this.defaultSize;
    buffer.height = this.defaultSize;
    const bufferCtx = buffer.getContext('2d');
    bufferCtx.drawImage(
        this.url,
        x * this.size,
        y * this.size,
        this.size,
        this.size,
        0, 0,
        this.defaultSize,
        this.defaultSize
    );
    bufferCtx.rect(0, 0, buffer.width, buffer.height);
    bufferCtx.stroke();
    this.tiles.set(name, buffer);  
  }

  draw(name, ctx, x, y){
    const buffer = this.tiles.get(name);
    ctx.drawImage(buffer, x * this.defaultSize, y * this.defaultSize);
  }
}