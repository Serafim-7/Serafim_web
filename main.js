function showpassword() {
  var x = document.getElementById("pa1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

const box1= document.querySelector(".box1");
const navMenu= document.querySelector(".nav-menu");
box1.addEventListener("click",() => {
  box1.classList.toggle("active");
  navMenu.classList.toggle("active");
})
document.querySelectorAll(".nav-link").forEach(n=>n.addEventListener("click",  () =>{
  box1.classList.remove("active");
  navMenu.classList.remove("active");
}))
