<footer class="section-footer">
	<!--##SOME_FOOTER##-->
</footer>
<script async>
	var addContentLoaded = false;
	var siteKeyGR = '<?=\Bitrix\Main\Config\Option::get(askaronReCaptcha\Module::id(), 'site_key_'. SITE_ID);?>';
	function LoadAddContent(){
		if (!addContentLoaded){
			[
				// 'https://www.google.com/recaptcha/api.js?render='+siteKeyGR,
				// '/bitrix/js/askaron.recaptcha/script.js'
			].forEach(function(src) {
				var script = document.createElement('script');
				script.src = src;
				document.head.appendChild(script);
			});
			addContentLoaded=true;
		}else{
			return;
		}
	};
	window.onmousemove=function (){LoadAddContent();}
	window.onscroll=function (){LoadAddContent();}
	BX.showWait = function(node, msg) {};//убираем стандартный прелоадер
	BX.closeWait = function(node, obMsg) {};//убираем стандартный прелоадер
</script>
</body>
</html>