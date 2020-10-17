$(document).ready(function (){
	$('#callback_form').on('submit',function (event){
		event.preventDefault();
		let form = $(this);
		let resultWrapper = form.find('.thank-you');
		let data = {
			name: form.find('input[name=name]').val(),
			phone: form.find('input[name=phone]').val(),
			text: form.find('textarea[name=text]').val(),
			recaptcha_token: window.recaptcha.getToken()
		}
		resultWrapper.find('h2').text('');
		resultWrapper.find('p').text('');
		$.ajax({
			type: "POST",
			url: '/api/callback/',
			data: data,
			success: function (response)
			{
				let result = JSON.parse(response);
				if (result.status==='S'){
					resultWrapper.find('h2').text('Спасибо!')
					resultWrapper.first('p').append('<p style="color:#00b92c">'+result.message+'</p>')
					form.find('.form-line').remove();
					form.find('.submit-block').remove();
				}else{
					resultWrapper.find('h2').text('Внимание!')
					resultWrapper.first('p').append('<p style="color:#e91e63">'+result.message+'</p>')
					if (result.errors.length>0){
						result.errors.forEach(function (error){
							resultWrapper.first('p').append('<p style="color:#e91e63">'+error+'</p>')
						});
					}
				}
				resultWrapper.show();
			}
		});
	});
});
