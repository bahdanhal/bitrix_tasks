BX.ready(function(){
	BX.bindDelegate(
		document.body, 'click', {className: 'ajax-report'},
		function(e){
			if(!e) {
				e = window.event;
			}
			var get = {};
			get['REPORT'] = "Y";
			node = BX('ajax-report-text');
			if (!!node) {
				BX.ajax.get(
					location.href,
					get,
					function (data) {
						var result = JSON.parse(data);
						if(!result["ID"]){
							node.innerText = data;//'Ошибка';
						} else {
							node.innerText = 'Жалоба принята, №' + result["ID"];
						}
					}
				);
			}
			return BX.PreventDefault(e);
		}
	);
}); 