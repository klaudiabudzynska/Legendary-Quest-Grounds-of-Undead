export function sendPosition(url) {
  let xhr = new XMLHttpRequest;
  xhr.open('GET', url);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.send();
}