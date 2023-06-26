var Reg = new RegExp(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);
var Pwd = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/);


document.getElementById("mail").addEventListener('input', function(e){
  if(Reg.test(e.target.value)){
    e.target.classList.remove('error');
  }
  else{
    e.target.classList.add('error');
  }
})

document.getElementById("password").addEventListener('input', function(e){

  console.log(Pwd.test(e.target.value));

  if(Pwd.test(e.target.value)){
    e.target.classList.remove('error');
  }
  else{
    e.target.classList.add('error');
  }
})