//Funcionalidad del slide revolution
const slides = document.querySelectorAll(".slide");
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");

let index = 0;

prev.addEventListener("click", function(){
  prevSlide();
});

next.addEventListener("click", function(){
  nextSlide();
});

function prevSlide(){
  if (index == 0){
    index = slides.length - 1;
  }
  else{
    index--;
  }
  changeSlide();
}

function nextSlide(){
  if(index == slides.length - 1){
    index = 0;
  }
  else{
    index ++;
  }
  changeSlide();
}

function changeSlide(){
  slides.forEach(function(item){
    item.classList.remove("active")
  })
  slides[index].classList.add("active");

  //codigo para monstrar el punto en real concordando con el indicador
  let indicators = document.querySelectorAll(".indicatorContainer > div")
  indicators.forEach(function(indicator){
    indicator.classList.remove("active");
  })

  indicators[index].classList.add("active");
  resetAutoplay();
}

//Puntos indicadores (para en caso de que se quieran agregar)Inicio----

const indicatorContainer = document.querySelector(".indicatorContainer");

function buildIndicators(){
  for(let i = 0; i < slides.length; i++){
    let element = document.createElement("div");
    element.dataset.i = i + 1;
    element.setAttribute("onclick", "gotoSlide(this)");

    //Hacer que el primer punto este activo por defecto
    if(i == 0){
      element.classList.add("active");
    }

    indicatorContainer.appendChild(element)
  }
}

buildIndicators();
//Puntos indicadores (para en caso de que se quieran agregar)Final----

//gotoSlide function
function gotoSlide(element){
  let k = element.dataset.i
  index = k-1;
  changeSlide();
}

//Autoplay de los slides
let timer = setInterval(nextSlide, 4000);
//1000 = 1 segundo, 4000 = 4 segundos

function resetAutoplay(){
  clearInterval(timer); //Detiene el timer
  timer = setInterval(nextSlide, 4000); // inicia el timer otra vez
}

//-----------Final funcionalidad del Slide revolution-------------

//Funcionalidad del contador regresivo
jQuery(document).ready(function () {
  $('#countdown_dashboard').countDown({
    targetDate: {
      'day': 02,
      'month': 12,
      'year': 2023,
      'hour': 06,
      'min': 0,
      'sec': 0
    },
    omitWeeks: true
  });
});

//Funcionalidad del formulario de la invitacion
function submitForm() {

  let form = document.getElementById("form");
  let success = document.getElementById("success");
  let oops = document.getElementById("oops");

  let nombre = document.getElementById("nombre");
  let si = document.getElementById("si");
  let no = document.getElementById("no");
  let acompanantes = document.getElementById("acompañantes");
  let mensaje = document.getElementById("mensaje");


  form.style.display = "none";

  var post = "nombre=" + encodeURIComponent(nombre.value);
  if(si.checked) {
    post += "&assist=y";
  } 
  else {
    post += "&assist=n";
  }

  post += "&acompañantes=" + encodeURIComponent(acompanantes.value);
  post += "&mensaje=" + encodeURIComponent(mensaje.value);

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    console.log(this.responseText);
    if(this.responseText == "success") {
      success.style.display = "block";
      form.style.display = "none";
      oops.style.display = "none";
    } else {
      success.style.display = "none";
      form.style.display = "block";
      oops.style.display = "block";
    }
  }
  xhttp.onerror = function() {
    success.style.display = "none";
    form.style.display = "block";
    oops.style.display = "block";
  }
  xhttp.open("POST", "mailer.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(post);
}

