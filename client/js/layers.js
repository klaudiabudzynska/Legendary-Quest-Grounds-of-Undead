export function createBackgroundLayer(background) {
  const buffer = document.createElement('canvas');
  buffer.width = canvas.width;
  buffer.height = canvas.height;

  buffer.getContext('2d').fillStyle = "#89d27c";
  buffer.getContext('2d').fillRect(0, 0, canvas.width, canvas.height);
  background.draw('Pole', buffer.getContext('2d'), 0, 0);

  return function drawLayer(ctx){
    ctx.drawImage(buffer, 0, 0);
  }
}

export function createCharacterLayer(character) {
  return function drawLayer(ctx){
    character.draw(ctx);
  }
}