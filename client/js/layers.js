export function createBackgroundLayer(background, mapData) {
  const buffer = document.createElement('canvas');
  buffer.width = canvas.width;
  buffer.height = canvas.height;



  buffer.getContext('2d').fillStyle = "#89d27c";
  buffer.getContext('2d').fillRect(0, 0, canvas.width, canvas.height);

  mapData.forEach(element => {
    console.log(element);
    for (var i = 0; i < element.coordinates.length; ++i) {
      let x = element.coordinates[i].split(';')[0];
      let y = element.coordinates[i].split(';')[1];
      background.draw(element.name, buffer.getContext('2d'), x, y);
    }
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