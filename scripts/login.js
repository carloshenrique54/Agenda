const light = document.querySelector("#light")

document.addEventListener("mousemove", (event) => {
    light.style.left = event.clientX + "px";
    light.style.top = event.clientY + "px";
});