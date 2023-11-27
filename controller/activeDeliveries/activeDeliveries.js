
function hideBid(x) {
    
    var bidForm = document.getElementsByClassName("bidForm")[x];
    var body = document.body;

    if (bidForm.classList.contains("hide")) {
        bidForm.classList.remove("hide");
        bidForm.style.top = window.scrollY + 'px';
        body.classList.add("no-scroll"); // Disable scrolling on body
    } else {
        bidForm.classList.add("hide");
        body.classList.remove("no-scroll"); // Enable scrolling on body
    }
}
