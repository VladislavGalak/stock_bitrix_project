<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
                    <form action="/api/callback/" id="callback_form">
                        <div class="thank-you" style="display: <?=$_SESSION['ASKARON_CALLBACK_SENT']==='Y'?'block':'none'?>">
                            <i></i>
                            <h2>Спасибо!</h2>
                            <p>Вы уже оставили заявку на звонок, нет необходимости делать это снова, ждите звонка!</p>
                        </div>
                        <?if($_SESSION['ASKARON_CALLBACK_SENT']!=='Y'):?>
                            <div class="form-line">
                                <input type="text" name='name' placeholder="Ваше имя">
                            </div>
                            <div class="form-line">
                                <input type="text" name="phone" class="masked-phone" placeholder="+7 (___) ___ __-__">
                            </div>
                            <div class="form-line">
                                <textarea name="text" id="" cols="30" rows="10" placeholder="Сообщение"></textarea>
                            </div>
                            <div class="form-line privacy-line">
                                <div class="styled-checkbox">
                                    <label for="privacy01">
                                        <span>Нажимая на кнопку &laquo;Отправить&raquo;, вы даете <a href="">согласие на обработку персональных данных</a> в соответсвии с 152-ФЗ.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="submit-block">
                                <button class="button">Отправить</button>
                            </div>
                        <?endif;?>
                    </form>
<script async>
	var captchaLoaded = false;
	var siteKeyGR = '<?=\Bitrix\Main\Config\Option::get(askaronReCaptcha\Module::id(), 'site_key_'. SITE_ID);?>';
	function LoadCaptcha(){
		if (!captchaLoaded){
			[
				'https://www.google.com/recaptcha/api.js?render='+siteKeyGR,
				'/bitrix/js/askaron.recaptcha/script.js'
			].forEach(function(src) {
				var script = document.createElement('script');
				script.src = src;
				document.head.appendChild(script);
			});
			window.recaptcha = { siteKey: siteKeyGR, tokenLifeTime: 100 };
			setTimeout(function (){window.recaptcha.reloadToken();}, 1000);
			captchaLoaded=true;
		}else{
			return;
		}
	};
	window.onmousemove=function (){LoadCaptcha();}
	window.onscroll=function (){LoadCaptcha();}
</script>