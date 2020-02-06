class data {
  function ajaxRequest(p, q) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        alert("Done.");
        window.location = p;
      }
    }
    ajax.open('GET', p + q, true);
    ajax.send(null);
  }
  function empty(arr) {
    var arrLen = arr.length;
    var i; var c = 0;
    for (i = 0; i < arrLen; i++) {
      if (arr[i] == "") {
        c++;
      }
    }
    if (c > 0) {
      return false;
    } else {return true;}
  }
}
