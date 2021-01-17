<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>

	<p>Search : </p>
	<input type="text" id="keyword">
	<p>Category : </p>
	<input type="text" id="category">
	
	<button id="search" onclick="search()">Go!</button>

	<div id="content"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

	$.ajax({
		type: "GET",
		url: '<?php echo base_url('Cart/showData'); ?>',
		success: function(data){
			var json_obj = jQuery.parseJSON(data)
			for (var i=0; i<json_obj.length; i++)
			{
				var product_id = json_obj[i].product_id
				var product_name = json_obj[i].product_name
				var product_price = json_obj[i].price
				var product_img = json_obj[i].img
				var product_category = json_obj[i].category_name

				var content = document.getElementById('content')

				var div = document.createElement('div')
				content.appendChild(div)
				
				var p_img = document.createElement('img')
				p_img.src = product_img
				p_img.style.width = '200px'
				div.appendChild(p_img)

				var p_name = document.createElement('p')
				p_name.textContent = product_name
				div.appendChild(p_name)
				
				var p_price = document.createElement('p')
				p_price.textContent = product_price + " Baht"
				div.appendChild(p_price)

				var p_ctgr = document.createElement('p')
				p_ctgr.textContent = "Category : " + product_category
				div.appendChild(p_ctgr)

				var url = "Cart/addCart/" + product_id
				var url_link = '<?php echo base_url("' + url + '"); ?>'
				console.log(url_link)

				var addLink = document.createElement('a')
				addLink.textContent = "Add to cart"
				addLink.href = url_link
				div.appendChild(addLink)
			}
		}
	});
	
	function search() {
		var keyword = document.getElementById("keyword")
		var category =document.getElementById("category")
		var url = "Cart/showData/" + keyword.value + "/" + category.value
		var url_link = '<?php echo base_url("' + url + '"); ?>'

		var content = document.getElementById("content")
		content.innerHTML = ""

		$.ajax({
		type: "GET",
		url: url_link,
		success: function(data){
			var json_obj = jQuery.parseJSON(data)
			for (var i=0; i<json_obj.length; i++)
			{
				var product_id = json_obj[i].product_id
				var product_name = json_obj[i].product_name
				var product_price = json_obj[i].price
				var product_img = json_obj[i].img
				var product_category = json_obj[i].category_name

				var content = document.getElementById('content')

				var div = document.createElement('div')
				content.appendChild(div)
				
				var p_img = document.createElement('img')
				p_img.src = product_img
				p_img.style.width = '200px'
				div.appendChild(p_img)

				var p_name = document.createElement('p')
				p_name.textContent = product_name
				div.appendChild(p_name)
				
				var p_price = document.createElement('p')
				p_price.textContent = product_price + " Baht"
				div.appendChild(p_price)

				var p_ctgr = document.createElement('p')
				p_ctgr.textContent = "Category : " + product_category
				div.appendChild(p_ctgr)

				var url = "Cart/addCart/" + product_id
				var url_link = '<?php echo base_url("' + url + '"); ?>'
				console.log(url_link)

				var addLink = document.createElement('a')
				addLink.textContent = "Add to cart"
				addLink.href = url_link
				div.appendChild(addLink)
			}
		}
	});
	}

</script>

</body>
</html>