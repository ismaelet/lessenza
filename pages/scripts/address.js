$(document).ready(function () {
	/*
	 * Filter inputs
	 */
	//trigger on keyup and input
	$('input[name="phone"], input[name="cpf"], input[name="cep"]').on('keyup input', function (e) {
		const name = this.attributes['name'].value

		this.value = this.value.replace(/[^0-9\.]/g, '')

		filter_inputs(e, name)
	})

	//filter function
	function filter_inputs(e, name) {
		let input = document.getElementsByName(name)[0]
		let string = input.value
		let newString = string.replace(/\D/g, '')

		//phone number
		if (name == 'phone') {
			if (newString.length) {
				newString = '(' + newString
			}

			if (newString.length > 3) {
				newString = newString.substring(0, 3) + ') ' + newString.substring(3)
			}

			if (newString.length > 9) {
				newString = newString.substring(0, 9) + '-' + newString.substring(9)
			}

			//CPF
		} else if (name == 'cpf') {
			if (newString.length > 3) {
				newString = newString.substring(0, 3) + '.' + newString.substring(3)
			}

			if (newString.length > 7) {
				newString = newString.substring(0, 7) + '.' + newString.substring(7)
			}

			if (newString.length > 11) {
				newString = newString.substring(0, 11) + '-' + newString.substring(11)
			}

			//CEP
		} else if (name == 'cep') {
			if (newString.length > 5) {
				newString = newString.substring(0, 5) + '-' + newString.substring(5)
			}
		}

		input.value = newString
	}
})
