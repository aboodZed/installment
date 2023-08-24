var tag_header = document.querySelectorAll(".link_hover");
for (let i = 0; i < tag_header.length; i++) {
  var chekd = tag_header[i];
  chekd.addEventListener("click", function () {
    for (let i = 0; i < tag_header.length; i++) {
      tag_header[i].classList.remove("link_active");
    }
    this.classList.add("link_active");
  });
}

var button_border = document.querySelectorAll(".button_border");
var boolean = true;

button_border.forEach((element) => {
  element.addEventListener("click", () => {
    if (boolean == true) {
      element.style.backgroundColor = "#E17020";
      element.style.color = "white";
      boolean = false;
    } else {
      element.style.backgroundColor = "#ffffffad";
      element.style.color = "#E17020";
      boolean = true;
    }
  });
});

const radioButtons = document.querySelectorAll('input[name="slider"]');
const imageGroups = document.querySelectorAll(".card");
let currentIndex = 0;
function changeSlide() {
  radioButtons[currentIndex].checked = false;
  imageGroups[currentIndex].classList.remove("active");

  currentIndex = (currentIndex + 1) % radioButtons.length;

  radioButtons[currentIndex].checked = true;
  imageGroups[currentIndex].classList.add("active");
}
setInterval(changeSlide, 3000);

var btn = document.getElementById("btn");

// btn.onclick = () => {
//   var div_total = document.getElementById("div_total");
//   div_total.style.display = "flex";
// };

AOS.init({
  duration: 450,
  easing: "ease-in-quad",
});