function changestatus() {
    var x = document.getElementById("change");
    if (x.innerHTML === "NO") {
      x.innerHTML = "YES";
      x.className = "text-success"
    } else {
      x.innerHTML = "NO";
      x.className = "text-danger"
    }

    var y = document.getElementById("changebutton");
    if(y.innerHTML === "Clock In") {
        y.innerHTML = "Clock Out"
        y.className = "bg-danger"
    } else{
        y.innerHTML = "Clock In"
        y.className = "bg-success"
    }
  }
