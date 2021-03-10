$(document).foundation();

function daySelect(id) {
  var all = "all";
  var clicked = id.getAttribute("data-value");
  var container = document.querySelector("#days");
  var matches = container.querySelectorAll("div.day");
  matches.forEach((element) => {
    element.classList.remove("hidden");
    element.classList.remove("show");
    if (clicked == all) {
      element.classList.add("show");
    } else if (element.id == clicked) {
      element.classList.add("show");
    } else {
      element.classList.add("hidden");
    }
  });
}

$(function () {
  $("#daySelect").on("click", function () {
    $("html, body").animate(
      {
        scrollTop: 400,
      },
      1000
    );
  });
});

function myFunction() {
  var d = new Date();
  var weekday = new Array(7);
  weekday[1] = "monday";
  weekday[2] = "tuesday";
  weekday[3] = "wednesday";
  weekday[4] = "thursday";
  weekday[5] = "friday";
  var n = weekday[d.getDay()];
  var clicked = n;
  var container = document.querySelector("#days");
  var matches = container.querySelectorAll("div.day");
  matches.forEach((element) => {
    element.classList.remove("hidden");
    element.classList.remove("show");
    if (clicked == all) {
      element.classList.add("show");
    } else if (element.id == clicked) {
      element.classList.add("show");
    } else {
      element.classList.add("hidden");
    }
  });
}

function setHeaderHeight() {
  const headerHeight = document.querySelector(
    "body > header > div.grid-container"
  ).offsetHeight;
  document.querySelector("body > header").style.top = `-${headerHeight}px`;
  const imageHeight = document.querySelector(
    "#post-303 > div:nth-child(2) > div > div"
  ).offsetHeight;
  document.querySelector(
    "#post-303 > div:nth-child(2) > div > div > p > img"
  ).style.height = `${imageHeight}px`;
}

window.onresize = setHeaderHeight;
setHeaderHeight();
