

const helloWorld = ()=>{
	console.log('Hello World');
}

const fetchTest = ()=>{
	fetch('http://localhost/webdev/projects/UserAuth/src/inc/api.php',{
		method: 'get'
	})
	.then(function(response) {
    if (response.status >= 200 && response.status < 300) {
        return response.text()
    }
    throw new Error(response.statusText);
  })
  .then(function(response) {

  	document.getElementById("jstophptest").innerHTML = response;
  	
  	return response;

    // document.write(response);
  })
	// .then(function(data){

	// 	console.log(data);
	// 	console.log("Fetch test .then here, something went right?");
	// 	return data.text();
	// })
	.catch(function(){
			console.log("Fetch test catch here, something went wrong?");
	});
}

// fetch('https://immense-journey-57497.herokuapp.com/imageurl', {
//       method: 'post',
//       headers: {'Content-Type': 'application/json'},
//       body: JSON.stringify({
//         input: this.state.input
//       })
//     })
//     .then (response => response.json())