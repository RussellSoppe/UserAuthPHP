console.log("script.js is reporting for duty");

let newEmail = document.getElementById('new-email');
let submitNewEmail = document.getElementById('new-email-submit');

newEmail.addEventListener("input", (event) =>{

	console.log(event.target.value);
	if(event.target.value){
		submitNewEmail.disabled = false;
	}else if(event.target.value == ""){
		submitNewEmail.disabled = true;
	}

})

let currentPassword = document.getElementById('current-password');
let newPassword = document.getElementById('new-password');
let newPasswordRepeat = document.getElementById('new-password-repeat');
let submitNewPassword = document.getElementById('new-password-submit');

let currentPasswordCheck = "";
let newPasswordCheck = "";
let newPasswordRepeatCheck = "";

const updatePasswordCheck = (input)=>{
	currentPasswordCheck = input;
}

const updateNewPasswordCheck = (input)=>{
	newPasswordCheck = input;
}

const updateNewPasswordRepeatCheck = (input)=>{
	newPasswordRepeatCheck = input;
}

const checkPasswordFieldsStatus = () => {
	if (currentPasswordCheck !="" && newPasswordCheck !="" && newPasswordRepeatCheck !=""){

		submitNewPassword.disabled = false;
		console.log("current, new, new repeat: ", false);

	}else if(currentPasswordCheck == "" && newPasswordCheck == "" && newPasswordRepeatCheck == ""){

		submitNewPassword.disabled = true;
		console.log("current, new, new repeat: ", true);
	}
}

currentPassword.addEventListener("input", (event)=>{
	updatePasswordCheck(event.target.value);
	checkPasswordFieldsStatus();
});

newPassword.addEventListener("input", (event)=>{
	updateNewPasswordCheck(event.target.value);
	checkPasswordFieldsStatus();
});

newPasswordRepeat.addEventListener("input", (event)=>{
	updateNewPasswordRepeatCheck(event.target.value);
	checkPasswordFieldsStatus();
});

