document.onclick = function(event){
  //  console.log(event);
  // console.log(event.target.className);


  if (event.target.className == 'navbar-toggler-icon'){
    let name = document.querySelector('.container');
    name.classList.toggle('menu-burger');
  }
  else if (event.target.className == 'navbar-toggler collapsed'){
    let name = document.querySelector('.container');
    name.classList.remove('menu-burger');
  }
  else if (event.target.className == 'navbar-toggler'){
    let name = document.querySelector('.container');
    name.classList.add('menu-burger');
  }
  else if (event.target.className == 'not-show-btn'){
    event.target.classList.remove("not-show-btn");
    event.target.classList.add('show-btn');
  }
  else if (event.target.className == 'show-btn'){
    event.target.classList.remove("show-btn");
    event.target.classList.add('not-show-btn');
  }
  else if ((event.target.className != 'not-show-btn') && (event.target.className != 'show-btn')){
    console.log(event.target.className);
    let name = document.querySelector('.show-btn');
    name.classList.remove("show-btn");
    name.classList.add("not-show-btn");
  }

}

let name = document.querySelector('#lostitem-text');
name.oninput = function(){
  this.value = this.value.substr(0, 255);
}
