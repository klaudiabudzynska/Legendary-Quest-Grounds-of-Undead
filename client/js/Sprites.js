export default class Sprites {

  constructor(url, ctx, size){
    this.url = url;
    this.ctx = ctx;
    this.size = size;
    this.defaultSize = 16;
    this.tiles = new Map();
  }

  define(name, x, y){
    const buffer = document.createElement('canvas');
    buffer.width = this.size;
    buffer.height = this.size;
    buffer
      .getContext('2d')
      .drawImage(
        this.url,
        x * this.size,
        y * this.size,
        this.size,
        this.size,
        0, 0,
        this.defaultSize,
        this.defaultSize
      );
    this.tiles.set(name, buffer);  
  }

  draw(name, x, y){
    const buffer = this.tiles.get(name);
    this.ctx.drawImage(buffer, x * this.defaultSize, y * this.defaultSize);
  }
}