function validate (){
		var ctr = 0 ;
		document.getElementById('errAll').innerHTML = "";
		document.getElementById('errFname').innerHTML = "";
		document.getElementById('errLname').innerHTML = "";
		document.getElementById('errNum').innerHTML = "";
		document.getElementById('errProv').innerHTML = "";
		document.getElementById('errCity').innerHTML = "";
		document.getElementById('errBrgy').innerHTML = "";
		document.getElementById('errComp').innerHTML = "";
		var f = document.forms['form']['fname'].value;
		var l = document.forms['form']['lname'].value;
		var n = document.forms['form']['number'].value;
		var p = document.forms['form']['prov'].value;
		var c = document.forms['form']['city'].value;
		var b = document.forms['form']['brgy'].value;
		var ca = document.forms['form']['compadd'].value;

		if (f == "" || l == "" || n == "" || p == "" || c == "" || b == "" || ca == "") {
			if (f == "") {
				adderror('fname');
			}
			if (l == "") {
				adderror('lname');
			}
			if (n == "") {
				adderror('number');
			}
			if (p == "") {
				adderror('prov');
			}
			if (c == "") {
				adderror('city');
			}
			if (b == "") {
				adderror('brgy');
			}
			if (ca == "") {
				adderror('compadd');
			}
			document.getElementById('errAll').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Field/s must be filled out!</div>';
			ctr = 1;
		}

		if (f.length > 16) {
			adderror('fname');
			document.getElementById('errFname').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maximum of 16 characters!</div>';
			ctr = 1 ;
		}
		if (l.length > 16) {
			adderror('lname');
			document.getElementById('errLname').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maximum of 16 characters!</div>';
			ctr = 1 ;
		}
		if (n.length > 1 && n.length < 11 || n.length > 11) {
			adderror('number');
			document.getElementById('errNum').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Enter a valid mobile number!</div>';
			ctr = 1 ;
		}
		if (p.length > 16) {
			adderror('prov');
			document.getElementById('errProv').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maximum of 16 characters!</div>';
			ctr = 1 ;
		}
		if (c.length > 16) {
			adderror('city');
			document.getElementById('errCity').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maximum of 16 characters!</div>';
			ctr = 1 ;
		}
		if (b.length > 16) {
			adderror('brgy');
			document.getElementById('errBrgy').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maximum of 16 characters!</div>';
			ctr = 1 ;
		}
		if (ca.length > 50) {
			adderror('compadd');
			document.getElementById('errComp').innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maximum of 50 characters!</div>';
			ctr = 1 ;
		}


		if (ctr == 1) {
			return false; 
		} else {
			return true;
		}

	}

function adderror(n) {
		var x = document.querySelector("#"+n);
		x.classList.add("has-error");
		document.activeElement.blur();
}

function removeError(n) {
		var x = document.querySelector("#"+n);
		x.classList.remove("has-error");
}