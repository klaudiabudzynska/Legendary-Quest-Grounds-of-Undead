const IP = '192.168.43.56';

export function send(url) {
  let xhr = new XMLHttpRequest;
  xhr.open('GET', `http://${IP}:8000/${url}`);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.send();
}

export async function get(url) {
   return await fetch(`http://${IP}:8000/${url}`)
    .then(res => res.json());
}