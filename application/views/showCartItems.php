<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
</head>
<body>

	<div id="content"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
		
		$.ajax({
		type: "GET",
		url: '<?php echo base_url('Cart/showCartData'); ?>',
		success: function(data){
		if(data=="[]") {}
		else {
			var json_obj = jQuery.parseJSON(data)
			var total = json_obj[0].sum_total
			var content = document.getElementById('content')

			for (var i=0; i<json_obj.length; i++)
			{
				var product_id = json_obj[i].product_id
				var product_name = json_obj[i].product_name
				var product_price = json_obj[i].price
				var product_img = json_obj[i].img
				var product_qty = json_obj[i].qty

				var div = document.createElement('div')
				div.id = "div_" + String(i)
				content.appendChild(div)

				var p_id = document.createElement('p')
				p_id.id = "p_id_" + String(i)
				p_id.textContent = product_id
				div.appendChild(p_id)
				
				var p_img = document.createElement('img')
				p_img.id = "p_img_" + String(i)
				p_img.src = product_img
				p_img.style.width = '200px'
				div.appendChild(p_img)

				var p_name = document.createElement('p')
				p_name.id = "p_name_" + String(i)
				p_name.textContent = product_name
				div.appendChild(p_name)
				
				var p_price = document.createElement('p')
				p_price.id = "p_price_" + String(i)
				p_price.textContent = product_price + " Baht"
				div.appendChild(p_price)

				var p_qty = document.createElement('input')
				p_qty.id = "p_qty_" + String(i)
				p_qty.value = product_qty
				p_qty.onchange = function(){

					var product_qty = this.value
					var idAll = this.id	
					var str = idAll.split("_")
					var index = str[2]
					var product = document.getElementById("p_id_" + index)
					product_id = product.textContent
					var container = document.getElementById("div_" + index)
					console.log(product_id)

					$.ajax({
						type: "GET",
						url: '<?php echo base_url('Cart/editCart') ?>',
						data: {'product_id' : product_id, 'qty' : product_qty},
						success: function(data) {
							if(data == "invalid")
							{
								container.innerHTML = ""
							}
							else
							{
								var p_obj = jQuery.parseJSON(data)
								console.log(p_obj)

								var sum_r = document.getElementById("p_sum_" + index)
								sum_r.textContent = p_obj.sum_row

								var total_r = document.getElementById("total")
								total_r.textContent = p_obj.sum_total
							}
						}
					});
				}
				div.appendChild(p_qty)

				var p_sum = document.createElement('p')
				p_sum.textContent = product_qty * product_price
				p_sum.id = "p_sum_" + String(i)
				div.appendChild(p_sum)

				var url = "Cart/deleteCart/" + product_id
				var url_link = '<?php echo base_url("' + url + '"); ?>'
				console.log(url_link)

				var deleteLink = document.createElement('a')
				deleteLink.textContent = "Delete form cart"
				deleteLink.href = url_link
				div.appendChild(deleteLink)
			}

			var cart_total = document.createElement('p')
			cart_total.textContent = total
			cart_total.id = "total"
			content.appendChild(cart_total)
			console.log(cart_total.textContent)

			var checkout = document.createElement('a')
			checkout.textContent = "Check out"
			checkout.href = '<?php echo base_url('Cart/checkout'); ?>'
			content.appendChild(checkout)
		}
		}
	});

</script>

</body>
</html>