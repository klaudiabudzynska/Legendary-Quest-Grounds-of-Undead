export class HttpRequest {
  constructor(url) {
    this.url = url;
    this.data;
  }

  send() {
    let xhr = new XMLHttpRequest;
    xhr.open('POST', this.url);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.send();
  }
}