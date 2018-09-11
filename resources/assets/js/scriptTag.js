//let url = 'https://heightweight.test';
let url = 'https://app.seezerapps.com';
let embedTag = document.querySelector('#height-weight');
let checkoutForm = document.querySelector('.product-form, #AddToCartForm, .product__form, .product-form-inline, .shopify-product-form');


if (checkoutForm || embedTags) {
	let xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			let response = JSON.parse(this.responseText);
			if (response.visible) {
				buildStyles(response.button);
				buildElements(checkoutForm, response.button);
			}
		}
	};
	xhttp.open("GET", `${url}/client/check/${meta.product.id}\?t=${Date.now()}`, false);
	xhttp.withCredentials = true;
	xhttp.send();

}

function buildStyles(button) {
	let head = document.head;

	let style = document.createElement('style');
	head.appendChild(style);
	style = style.sheet;
	style.type = 'text/css';
	style.insertRule(`#hw-button {margin-bottom: .5rem; background-color: ${button.background}; border-color: transparent; color: ${button.color}; border-width: 2px; cursor: pointer; justify-content: center; padding-bottom: calc(.375em - 1px); padding-left: .75em; padding-right: .75em; padding-top: calc(.375em - 1px); text-align: center; white-space: nowrap; border-radius: 8px; box-shadow: none; display: inline-flex; font-size: 1rem; height: 2.25em; line-height: 1.5; position: relative; vertical-align: top; user-select: none;}`, 0);
	style.insertRule(`#hw-button:hover {background-color: ${button.background}; border-color: ${button.border}; color: ${button.color};}`, 1);
	style.insertRule('#hw-frame {height: 0; width: 100%; transition: height 1s; display: block; max-width: 480px}', 2);
	style.insertRule('#hw-frame.open {height: 340px;}', 3)
}

function buildElements(checkoutForm, button) {
	let openButton = document.createElement('button');
	openButton.id = 'hw-button';
	openButton.innerText = button.text;
	openButton.type = 'button';
	let iframe = document.createElement('iframe');
	iframe.id = 'hw-frame';
	iframe.src = `${url}/client/${meta.product.id}`;
	iframe.style.border = 'none';
	iframe.scrolling = 'no';
	iframe.allowtransparency = "true";
	openButton.addEventListener('click', toggleForm);
	if (embedTag) {
		embedTag.appendChild(openButton);
		embedTag.appendChild(iframe);
	} else if (checkoutForm) {
		checkoutForm.insertAdjacentElement('afterend', openButton);
		openButton.insertAdjacentElement('afterend', iframe);
	}
	window.addEventListener("message", sizeCalculated, false);
}

function toggleForm() {
	document.querySelector('#hw-frame').classList.toggle('open');
}

function sizeCalculated(event) {
	if (event.data.suggestedSize) {
		let suggestedSize = event.data.suggestedSize;
		let element = document.querySelector(`option[value='${suggestedSize}']`);
		element.parentElement.value = suggestedSize;
		element = document.querySelector(`input[value='${suggestedSize}']`);
		element.checked = true;
	}
}