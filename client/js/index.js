import { loadBackground, loadCharacter } from './spriteSheet.js';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

ctx.scale(3,3);

Promise.all([
  loadBackground(), 
  loadCharacter(),
])
.then(([
  background, 
  character,
]) => {
  ctx.fillStyle = "#89d27c";
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  background.draw('rock-1', ctx, 0, 0);
  character.draw('idle', ctx, 1, 0);
})