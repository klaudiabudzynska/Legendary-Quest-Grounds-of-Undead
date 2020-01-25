export function sendPosition(url) {
  let xhr = new XMLHttpRequest;
  xhr.open('GET', url);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.send();
}

export async function getLastPosition() {
   return await fetch("https://localhost:8000/game/last")
    .then(res => res.json());
}