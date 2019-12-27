export default class Sprites {

  constructor(url, ctx){
    this.url = url;
    this.ctx = ctx;
    this.width = 16;
    this.height = 16;
    this.tiles = new Map();
  }

  define(name, x, y){
    const buffer = document.createElement('canvas');
    buffer.width = this.width;
    buffer.height = this.height;
    buffer
      .getContext('2d')
      .drawImage(
        this.url,
        x * this.width,
        y * this.height,
        this.width,
        this.height,
        0, 0,
        this.width,
        this.height
      );
    this.tiles.set(name, buffer);  
  }

  draw(name, x, y){
    const buffer = this.tiles.get(name);
    this.ctx.drawImage(buffer, x * this.width, y * this.height);
  }
}