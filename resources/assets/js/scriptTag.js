let checkoutForm = document.querySelector('.product-form.product-form-product-template');
if (checkoutForm) {

	let xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			let response = JSON.parse(this.responseText);
			if (response.visible) {
				buildStyles();
				buildElements(checkoutForm);
			}
		}
	};
	xhttp.open("GET", 'https://app.seezerapps.com/client/check/' + meta.product.id + '\?t=' + Date.now(), false);
	xhttp.send();


}

function buildStyles() {
	let head = document.head;

	let style = document.createElement('style');
	head.appendChild(style);
	style = style.sheet;
	style.type = 'text/css';
	style.insertRule('#hw-button {margin-bottom: .5rem; background-color: #363636; border-color: transparent; color: #f5f5f5; border-width: 1px; cursor: pointer; justify-content: center; padding-bottom: calc(.375em - 1px); padding-left: .75em; padding-right: .75em; padding-top: calc(.375em - 1px); text-align: center; white-space: nowrap; border-radius: 4px; box-shadow: none; display: inline-flex; font-size: 1rem; height: 2.25em; line-height: 1.5; position: relative; vertical-align: top; user-select: none;}', 0);
	style.insertRule('#hw-button:hover {background-color: #2f2f2f; border-color: transparent; color: #f5f5f5;}', 1);
	style.insertRule('#hw-frame {height: 0; width: 100%; transition: height 1s; display: block}', 2);
	style.insertRule('#hw-frame.open {height: 400px;}', 3)
}

function buildElements(checkoutForm) {
	let openButton = document.createElement('button');
	openButton.id = 'hw-button';
	openButton.innerText = 'Calculate weight and height';
	let iframe = document.createElement('iframe');
	iframe.id = 'hw-frame';
	iframe.src = 'https://app.seezerapps.com/client/' + meta.product.id;
	iframe.style.border = 'none';
	iframe.scrolling = 'no';
	iframe.allowtransparency = "true";
	openButton.addEventListener('click', toggleForm);
	checkoutForm.insertAdjacentElement('afterend', openButton);
	openButton.insertAdjacentElement('afterend', iframe);
}

function toggleForm() {
	document.querySelector('#hw-frame').classList.toggle('open');
}