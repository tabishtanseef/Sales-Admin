// FETCH DATA
fetch('http://digigoodluck.com/goodluck_sales/server.php').then((res) => res.json())
.then(response => {
	console.log(response);
	let output = '';
	for(let i in response){
		output += `<tr>
			<td>${response[i].city_id}</td>
			<td>${response[i].city_name}</td>
			<td>${response[i].state}</td>
		</tr>`;
	}

	document.querySelector('.tbody').innerHTML = output;
}).catch(error => console.log(error));

// DATA TABLES
$(document).ready(function(){
	$('.table').DataTable();
})