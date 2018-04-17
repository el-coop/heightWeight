let checkoutForm = document.querySelector('.product-form.product-form-product-template');
if (checkoutForm) {

	let xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			let response = JSON.parse(this.responseText);
			if (response.visible) {
				buildElement(checkoutForm);
			}
		}
	};
	xhttp.open("GET", 'https://heightweight.test/client/check/' + meta.product.id + '\?t=' + Date.now(), false);
	xhttp.send();


}

function buildElement(checkoutForm) {
	let iframe = document.createElement('iframe');
	iframe.src = 'https://heightweight.test/client/' + meta.product.id;
	iframe.style.height = '50px';
	iframe.style.width = '100%';
	iframe.style.border = 'none';
	iframe.scrolling = 'no';
	checkoutForm.insertAdjacentElement('afterend', iframe);
}