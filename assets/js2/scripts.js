/*!
* Start Bootstrap - Blog Home v5.0.5 (https://startbootstrap.com/template/blog-home)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-blog-home/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

function showUserPass() {
    var x = document.getElementById("userPass");
    console.log("test");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }