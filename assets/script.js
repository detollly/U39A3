function hamburgerMenu() {
  var x = document.getElementById("Top");
  if (x.className === "nav") {
    x.className += " responsive";
  } else {
    x.className = "nav";
  }
}
