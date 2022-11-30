var fixedbutton = document.getElementById("fixedbutton");

fixedbutton.style.display = "none";
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30)
        fixedbutton.style.display = "block";
    else 
        fixedbutton.style.display = "none";
}