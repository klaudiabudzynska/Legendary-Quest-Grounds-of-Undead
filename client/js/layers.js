export function createBackgroundLayer(background, level) {
  const buffer = document.createElement('canvas');
  buffer.width = canvas.width;
  buffer.height = canvas.height;

  const bufferCtx = buffer.getContext('2d');

  bufferCtx.fillStyle = "#89d27c";
  bufferCtx.fillRect(0, 0, canvas.width, canvas.height);

  level.tiles.loopOver((tile, x, y) => {
    background.draw(tile.name, bufferCtx, x, y);
  })

  return function drawLayer(ctx) {
    ctx.drawImage(buffer, 0, 0);
  }
}

export function createCharacterLayer(characters) {
  return function drawLayer(ctx) {
    characters.forEach(character => {
      character.draw(ctx);
    })
  }
}