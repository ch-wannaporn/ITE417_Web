<!DOCTYPE html>
<html>
<head>
	<title>Shopping History</title>
</head>
<body>

	<div id="content"></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$.ajax({
		type: "GET",
		url: '<?php echo base_url('Cart/orderHistory'); ?>',
		success: function(data){
			var json_obj = jQuery.parseJSON(data)
			
			for (var i=0; i<json_obj.length; i++)
			{	
				var order_id = json_obj[i].order_id
				var order_date = json_obj[i].order_date
				var order_status = json_obj[i].status
				var order_total = json_obj[i].total

				var content = document.getElementById('content')

				var div = document.createElement('div')
				div.id = "div_" + order_id
				content.appendChild(div)

				var o_id = document.createElement('button')
				o_id.textContent = order_id
				o_id.onclick = function(){

				var order_id = this.textContent
				var order_url = "Cart/orderData/" + order_id
				var order_url_link = '<?php echo base_url("' + order_url + '"); ?>'

					$.ajax({
						type: "GET",
						url: order_url_link,
						success: function(data){
							var o_obj = jQuery.parseJSON(data)

							for (var i=0; i<o_obj.length; i++)
							{
								var item_id = o_obj[i].product_id
								var item_name = o_obj[i].product_name
								var item_price = o_obj[i].item_price
								var item_qty = o_obj[i].item_qty

								var subdiv = document.getElementById("subdiv_" + order_id)
								subdiv.innerHTML = ""

								var i_id = document.createElement('p')
								i_id.textContent = "item id : " + item_id
								subdiv.appendChild(i_id)

								var i_name = document.createElement('p')
								i_name.textContent = item_name
								subdiv.appendChild(i_name)

								var i_price = document.createElement('p')
								i_price.textContent = item_price + " Baht"
								subdiv.appendChild(i_price)

								var i_qty = document.createElement('p')
								i_qty.textContent = item_qty + " Piece(s)"
								subdiv.appendChild(i_qty)								
							}
						}  
					});
				}
				div.appendChild(o_id)

				var o_date = document.createElement('p')
				o_date.textContent = order_date
				div.appendChild(o_date)

				var subdiv = document.createElement('div')
				subdiv.id = "subdiv_" + order_id
				div.appendChild(subdiv)

				var o_total = document.createElement('p')
				o_total.textContent = "Total " + order_total + " Baht"
				div.appendChild(o_total)

				var o_status = document.createElement('p')
				o_status.textContent = order_status
				div.appendChild(o_status)

				if (order_status != 'Cancelled')
				{
					var url = "Cart/cancelOrder/" + order_id
					var url_link = '<?php echo base_url("' + url + '"); ?>'
					console.log(url_link)

					var cancelLink = document.createElement('a')
					cancelLink.textContent = "Cancel this order"
					cancelLink.href = url_link
					div.appendChild(cancelLink)
				}
			}
		}
	});
	
	</script>
</body>
</html>