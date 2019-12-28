export default class Scene {
  constructor(){
    this.layers = [];
  }

  draw(ctx){
    this.layers.forEach(layer => {
      layer(ctx);
    });
  }
}