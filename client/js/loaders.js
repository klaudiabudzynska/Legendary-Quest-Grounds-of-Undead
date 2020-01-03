export function imageLoader(url){
  return new Promise(resolve => {
    const img = new Image();
    img.addEventListener('load', () => {
      resolve(img);
    })
    img.src = url;
  })
}

export function mapLoader () {
  return fetch('https://localhost:8000/game/map')
  .then(res => res.json())
}