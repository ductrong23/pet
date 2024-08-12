// ===========================CHUYỂN ĐỘNG BANNER TRANG CHỦ=====================================

const banner_index = document.getElementsByClassName("banner_index");

let i = 0;
setInterval(() => {
  let currentActive = document.querySelector(".active");
  currentActive.classList.remove("active");
  i++;
  if (i === 3) {
    i = 0;
  }
  banner_index[i].classList.add("active");
}, 3000);


// ===========================CHUYỂN ĐỘNG CONTAINER US TRANG CHỦ=====================================

window.onload = function () {
  // Transform about us
  let slideUs = 0;
  let slideUsWidth = 492;
  var usGroup = document.querySelector(".container__us-group");
  var usItems = document.querySelectorAll(".container__us-group-item");
  let numberOfUsSlide = usItems.length - 2;

  function prevUs() {
    if (slideUs == 0) {
      slideUs = numberOfUsSlide;
    }
    slideUs--;
    var translateXValue = -slideUs * slideUsWidth;
    usGroup.style.transform = `translateX(${translateXValue}px)`;
  }

  function nextUs() {
    slideUs++;
    if (slideUs == numberOfUsSlide) {
      slideUs = 0;
    }
    var translateXValue = -slideUs * slideUsWidth;
    usGroup.style.transform = `translateX(${translateXValue}px)`;
  }

  setInterval(nextUs, 3000);
};

